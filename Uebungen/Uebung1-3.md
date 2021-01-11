# Übung 1.3 #

> Wie immer wird für die Übung ein eigener Ordner erstellt.

## Vorbereitung ##

Erstellen Sie eine Datei namens `index.php` und starten sie den Webserver im Ordner der Übung

```shell script
php -S 0.0.0.0:8000
```

## Session Handling ##

1. Nehmen Sie als Grundlage der Übung PHP Datei die `index.php` von der Übung 1.2.
Dort ersetzen Sie die erste Zeile (in welcher `$anzahl_aufrufe` gesetzt wird) durch folgenden Code:

    ```php
        session_start();
    
        $anzahl_aufrufe = 1;
        if (isset($_SESSION['anzahl_aufrufe'])) {
            $anzahl_aufrufe = $_SESSION['anzahl_aufrufe'];
        }
    ```

1. Öffnen Sie die Seite mehrmals im Browser und achten sich auf den Counter.

### Fragen ###

- [ ] Gehen Sie den Code durch und überlegen Sie Sich was auf jeder Zeile geschieht.
- [ ] Was bewirkt die Funktion `session_start()`?
- [ ] Überprüfen Sie mit dem Inspector ob Sie ein Session Cookie erhalten haben.

## Alle Session Variablen ausgeben ##

1. Erstellen Sie eine zweite Datei `session.php`. Fügen Sie in dieser folgenden Inhalt ein:

    ```php
    <?php
        var_dump($_SESSION);
    ?>
    ```

1. Öffnen Sie die Datei im Browser.

> `index.php` ist die Standard Datei wenn keine andere angegeben wird. Um die Datei `session.php` zu öffnen,
> verwenden Sie folgende Adresszeile: `http://127.0.0.1:8000/session.php`

### Aufgaben ###

- [ ] Was wird ausgegeben?
- [ ] Warum ist die Anzahl der Aufrufe nicht sichtbar?
- [ ] Passen Sie die Datei an sodass die `$_SESSION` Konstante die Anzahl der Aufrufe enthält.

> Tipp: Vergleichen Sie die beiden Dateien nochmal!