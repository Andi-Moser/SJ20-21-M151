# Übung 2.2 #

> Vorbereitung wie bei jeder anderen Übung.

## Datenbankverbindung herstellen ##

1. Erstellen Sie wie immer eine Datei `index.php` im Ordner dieser Übung und starten Sie dort den PHP Webserver
    
    > In Zukunft wird dieser Schritt nicht mehr explizit aufgelistet. Sofern nichts anderes angegeben ist wird davon ausgegangen dass der Code
    > in einer Datei namens `index.php` ist und der Webserver gestartet wird.

1. Mit folgendem Code wird eine Verbindung via PDO zum MySQL Server hergestellt. Fügen Sie diesen in Ihre `index.php` und passen Sie die Zugangsdaten an.

```php
<?php
$servername = "localhost";
$username = "username";
$password = "password";
$database = "database";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>
```

### Aufgaben ###

- [ ] Was bedeutet das `mysql:` Zeile 8?
- [ ] Was bewirkt die Zeile 10?

## Daten auslesen und ausgeben ##

1. Studieren Sie [dieses Tutorial](https://www.php-einfach.de/mysql-tutorial/crashkurs-pdo/) und bauen Sie die gelernten Funktionen in Ihren Code ein.

- [ ] Passen Sie die Seite so an, dass alle Kunden (Tabelle `customers`) in einer HTML Tabelle dargestellt werden.