# Übung 1.1 #

## Vorbereitung ##

1. Erstellen Sie im Home Directory einen Ordner `M151`.
In diesem Ordner werden alle PHP Dateien vom Modul abgelegt. Ich empfehle ausserdem diesen Ordner in ein GIT Repository abzulegen.

1. Erstellen Sie einen Ordner für alle Übungen, `Uebungen`, und darin einen Ordner für diese Übung `Uebung1-1`

> Diesen Schritt sollten Sie für alle kommenden Übungen wiederholen. So sind alle Übungsdateien an einem Ort übersichtlich abgelegt.

> Da wir mit der Konsole arbeiten sollten Sie möglichst keine Umlaute oder Punkte als Ordner- und Dateinamen verwenden.

## Der erste Webserver ##

1. Erstellen Sie im Ordner zu dieser Übung eine Datei namens `index.php`. Fügen Sie in dieser Datei folgenden Inhalt ein:
        
    ```php
    <?php
        phpinfo();
    ?>
    ```

1. Öffnen Sie eine Konsole und starten Sie mit folgenden Befehlen den integrierten Webserver:

    ```shell script
    cd ~/m151/Uebungen/Uebung1-1
    php -S 0.0.0.0:8000
    ```

1. Öffnen Sie die URL `127.0.0.1:8000` in einem Browser.

> Den Server können Sie mit `Ctrl+C` beenden.

## Fragen / Aufgaben ##

- [ ] Was sehen Sie?
- [ ] Was bedeutet das -S vom PHP Befehl?
- [ ] Ersetzen Sie den PHP Code im `index.php` durch anderen PHP Code und kontrollieren Sie ob die Ausgabe im Browser übereinstimmt.