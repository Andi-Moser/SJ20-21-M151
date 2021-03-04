# Übung 4.1 #

## Neue Verzeichnisstruktur ##

In dieser Übung werden Sie das Laravel Framework installieren. Die weiteren Übungen werden
innerhalb von Laravel ausgeführt.

Bei der Installation von Laravel wird ein neuer Ordner erstellt in welchem das Projekt gespeichert ist.
Alle weiteren Übungen sowie das Projekt wird in diesem Ordner umgesetzt.

> Wichtig: Es gibt weiterhin jede Woche einen Punkt für die Commits.

## Installation Laravel ##

### Systemvoraussetzungen ###

Um Laravel zu installieren, muss `composer` installiert sein. Composer ist ein Paketmanagement-Tool
mit dessen Sie diverse Frameworks und Applikationen installieren können.

- [Installation von Composer auf Ubuntu/Mac](https://getcomposer.org/download/)
- [Installation von Composer auf Windows](https://getcomposer.org/doc/00-intro.md#installation-windows)

> XAMPP User
> 
> Laravel und Composer benötigen eine PHP Installation auf Ihrem System. Die PHP Version von XAMPP ist unter Umständen
> nicht vom ganzen System zugänglich.
> 
> Haben Sie Probleme beim Installieren von Composer oder Laravel installieren Sie bitte PHP auf dem System oder verwenden Sie die WebVM

### Laravel Installieren ###

1. Wechseln Sie (`cd`) in einem Terminal das Verzeichnis zum Ordner Ihrer Übungen.

1. Führen Sie folgende Befehle aus um Probleme mit dem SSL Zertifikat zu vermeiden:

    ```shell script
    composer config --global disable-tls true
    composer config --global secure-http false
    ```

1. Installieren Sie mit folgenden Befehl die benötigten PHP Erweiterungen

    `sudo apt install php-xml`

    > Unter Windows müssen diese Erweiterungen ebenfalls installiert werden. Sind Sie sich nicht sicher, ob diese Installiert sind
    > probieren Sie die Installation von Laravel (nächster Punkt) aus und notieren sich welche Erweiterungen fehlen.

1. Führen Sie dort folgenden Befehl aus

    `composer create-project laravel/laravel laravel`

1. Wechseln Sie im Terminal (`cd laravel`) in den eben erstellten Ordner

1. Starten Sie den Laravel Webserver mit

    `php artisan serve`
   
1. Rufen Sie die angezeigte URL im Browser auf. Sie sollten eine Laravel Demo Seite angezeigt bekommen.