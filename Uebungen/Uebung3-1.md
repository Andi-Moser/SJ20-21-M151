# Übung 3.1 #

## Abstrahierung ##

### Problemstellung ###

Nehmen wir nun an, wir haben folgenden Code:

```php
function getConnection() {
    $servername = "localhost";
    $username = "username";
    $password = "password";
    $database = "database";

    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $conn;
}

function confirmOrder() {
    $c = $this->getConnection();

    $c->exec("START TRANSACTION");

    try {
        // Stelle die Bestellung auf bestätigt
        $stmt = $c->prepare("UPDATE orders SET status = :status WHERE id = :id");
        $stmt->execute(array([
            ":status" => "confirmed",
            ":id" => $this->getId()
        ]));

        // Passe die Lagerbestände der Produkte an
        foreach ($this->getProducts() as $product) {
            $stmt = $c->prepare("UPDATE products SET stock = stock - :quantity WHERE id = :id");
            $stmt->execute(array([
                ":quantity" => $product->getAmount(),
                ":id" => $product->getId()
            ]));
        }

        $c->exec("COMMIT");
    }
    catch (\Exception $e) {
        $c->exec("ROLLBACK");
        throw $e;
    }
}

function cancelOrder() {
    $c = $this->getConnection();

    $c->exec("START TRANSACTION");

    try {
        // Stelle die Bestellung auf bestätigt
        $stmt = $c->prepare("UPDATE orders SET status = :status WHERE id = :id");
        $stmt->execute(array([
            ":status" => "cancelled",
            ":id" => $this->getId()
        ]));

        // Passe die Lagerbestände der Produkte an
        foreach ($this->getProducts() as $product) {
            $stmt = $c->prepare("UPDATE products SET stock = stock + :quantity WHERE id = :id");
            $stmt->execute(array([
                ":quantity" => $product->getAmount(),
                ":id" => $product->getId()
            ]));
        }

        $c->exec("COMMIT");
    }
    catch (\Exception $e) {
        $c->exec("ROLLBACK");
        throw $e;
    }
}
```

Hier sind nur 2 Methoden der `Order` Klasse beschrieben und es sind bereits über 70 Zeilen Code.

Dies ist aus folgenden Gründen unschön:

- Wird ein `COMMIT` vergessen, so werden die Änderungen an der Datenbank nicht gespeichert.
- Es werden 2 einzelne Datenbankverbindungen aufgebaut
- An 4 Stellen wird ein Statement vorbereitet
- An 4 Stellen wird das Statement ausgeführt

**Zusammengefasst:** Der Code verstösst gegen das DRY (Don't Repeat Yourself) Prinzip.

### Wunschlösung ###

Der Code könnte viel schmaller sein - wenn wir die Datenbank abstrahieren.

Viele Frameworks enthalten bereits eine solche Abstraktion. Wir wollen nun eine eigene kleine Abstraktion erstellen
mit welcher obiger Code neu so aussehen kann:

```php
function confirmOrder() {
    $db = DB::get();
    
    try {
        $db->startTransaction();

        $db->execute("UPDATE orders SET status = :status WHERE id = :id", [":status" => "confirmed", ":id" => $this->getId()]);
        
        foreach ($this->getProducts() as $product) {
            $db->execute("UPDATE products SET stock = stock - :quantity WHERE id = :id", [":quantity" => $product->getQuantity(), ":id" => $product->getId()]);
        }
        
        $db->commit();
    }
    catch (\Exception $e) {
        $db->rollback();
        throw $e;
    }
}

function cancelOrder() {
    $db = DB::get();

    try {
        $db->startTransaction();

        $db->execute("UPDATE orders SET status = :status WHERE id = :id", [":status" => "cancelled", ":id" => $this->getId()]);

        foreach ($this->getProducts() as $product) {
            $db->execute("UPDATE products SET stock = stock + :quantity WHERE id = :id", [":quantity" => $product->getQuantity(), ":id" => $product->getId()]);
        }

        $db->commit();
    }
    catch (\Exception $e) {
        $db->rollback();
        throw $e;
    }
}
```

Natürlich könnten wir den Code noch weiter abstrahieren, z.B. das Ändern des Status in eine eigene
Methode auslagern.
Aus Sicht der Datenbank ist dies jedoch schonmal ein grosser Unterschied. Muss man z.B. in einer neueren Version
der Datenbank Transactions nicht mehr mit `START TRANSACTION` beginnen, muss diese Änderung nur an einem Ort ausgeführt werden.

## Datenbank Abstrahierung ##

Die *Magie* im gezeigten Code findet in der Klasse `DB` statt. In der nächsten Übung werden wir diese Klasse
entwickeln damit wir sie bei folgenden Übungen verwenden können.