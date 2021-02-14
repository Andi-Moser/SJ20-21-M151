# Übung 3.2 #

## Datenbankklasse erstellen ##

Wir erstellen nun eine Klasse `DB` mit welcher wir auf die Datenbank zugreifen können.

Das Grundgerüst der Klasse sieht wie folgt aus:

```php
class DB
{
    protected static $instance;
    
    protected $pdo;
    
    private function __construct()
    {
        $servername = "localhost";
        $username = "username";
        $password = "password";
        $database = "database";

        $this->pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    
    public static function get() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        
        return self::$instance;
    }
}
```

Folgende Funktionen sind hier schon eingebaut:

### Singleton ###

Das Singleton Pattern verhindert dass eine Klasse mehrfach erstellt werden kann. Es gibt ja keinen Sinn,
immer wieder neue Datenbankverbindungen herzustellen - eine reicht komplett.

Dies wird erreicht indem der Konstruktor der Klasse `private` ist. Folgender Code ist also **nicht** ausführbar:

```php
$db = new DB();
```

Stattdessen erhalten wir eine Datenbankverbindung mit:

```php
$db = DB::get();
```

### Verbindung herstellen ###

Ebenfalls wird im Konstruktor bereits die Verbindung hergestellt und in `$this->pdo` hinterlegt. So können wir in dieser
Klasse aus allen Methoden Queries ausführen.

## Weitere Funktionen ##

Bauen Sie nun folgende Funktionen in diese Klasse ein:

**startTransaction()**

Startet eine Transaktion

**commitTransaction()**

Commitet eine Transaktion

**rollbackTransaction()**

Rollt eine Transaktion zurück

> Stellen Sie dabei sicher, dass zu jeder Zeit nur eine Transaktion offen ist (MySQL unterstützt nur jeweils eine laufende Transaktion).
> 
> Sie können z.B. in einer private Proberty (`private $hasRunningTransaction`) hinterlegen wenn eine geöffnet wurde.
> 
> Soll eine zweite Transaktion geöffnet werden werfen Sie einen Fehler (`throw new Exception("Multiple Transactions are not supported");`)

**query($sql, $params)**

Bereitet das Query in `$sql` vor und führt es anschliessend mit den Parametern von `$params` aus.

> Diese Funktion soll keinen Rückgabewert haben. Sie wird verwendet um Daten einzufügen, zu verändern oder zu löschen.

**select($sql, $params)**

Ist gleich aufgebaut wie die `query` Methode, nur soll diese Funktion die ausgelesenen Werte in einem Array zurückgeben.

> Das Array sollte wie folgt aufgebaut sein:

```php
$returnValue = [
    0 => ["id" => 1, "name" => "Markus"],
    1 => ["id" => 2, "name" => "Fabian"],
    2 => ["id" => 3, "name" => "Maria"],
    3 => ["id" => 4, "name" => "Hans"]
]
```

## Letzter Schliff ##

Wenn wir an Übung 3.1 zurückdenken war ein Kritikpunkt dass es schnell vergessen geht die Transaktion zu committen.

Dank dieser Klasse können wir dies nun abfangen. PHP ruft bei allen Klassen nach der Ausführung des Scripts den Dekonstruktor auf.
Bauen Sie diesen Dekonstruktor ein und committen Sie dort die Transaktion, falls noch eine geöffnet sein sollte.

> Der Dekonstruktor ist wie folgt aufgebaut:

```php
public function __destruct()
{
}
```