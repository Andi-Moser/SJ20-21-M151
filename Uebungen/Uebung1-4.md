# Übung 1.4 #

> Wie immer wird für die Übung ein eigener Ordner erstellt.

## Vorbereitung ##

Erstellen Sie wie immer einen neuen Ordner für diese Übung den Sie
dann im Browser öffnen können (z.B. http://m151.test/Uebung1-4/)

## Parameter auslesen ##

1. Fügen Sie folgenden Code in die `index.php` ein:

    ```php
    <?php
        $username = $_GET['username'];
        
        echo "Hallo {$username}!<br />";
    
        if ($_GET['age']) {
            $age = $_GET['age'];
            echo "Du bist {$age} Jahre alt.";
        }
    ?>
    ```

1. Rufen Sie diese Datei mit folgender URL auf: `http://127.0.0.1:8000/index.php?username=BENUTZERNAME`

### Aufgaben ###

- [ ] Rufen Sie die Datei so auf dass auch das Alter ausgegeben wird.
- [ ] Fangen Sie den Fall ab dass die Datei ohne Benutzernamen-Parameter aufgerufen wird.


## Rechner ##

Erstellen Sie eine PHP Datei (`calc.php`) welche mit 2 Zahlen rechnen kann. Die Datei soll mit folgenden Parametern aufrufbar sein:

| Parametername | Funktion | Mögliche Werte |
| --- | --- | --- |
| x | Die erste Zahl | beliebige Integer Werte |
| y | Die erste Zahl | beliebige Integer Werte |
| mode | Der Modus der Operation | `plus` x + y <br /> `minus` -> x - y <br /> `mal` -> x * y <br /> `div` -> x / y |

> Tipp: Parameter werden immer als `string` übergeben. Um ein Parameter in eine Zahl zu konvertieren
> kann die Funktion `intval()` verwendet werde:
> ```php
> $x = intval($x);
> ```