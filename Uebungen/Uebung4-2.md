# Übung 4.2 #

## Ordnerstruktur ##

Auf die Details von Laravel wird später noch eingegangen.
Zuerst wollen wir uns einen Überblick über die Ordnerstruktur verschaffen.

Viele der Ordner sind zurzeit noch nicht wichtig und wir können sie deshalb ignorieren.
In folgenden Ordnern werden wir viel Arbeiten. Schauen Sie sich die Inhalte dieser Ordner an
und überlegen Sie was diese bewirken:

- `app/Http/Controllers`
- `app/Models`
- `database/migrations`
- `resources/views`

## Laravel Artisan ##

Wir haben den Webserver nun mit `php artisan serve` gestartet. Artisan ist der Name des Kommandozeilentools von Laravel
mit welchem diverse Aufgaben vie CLI ausgeführt werden können.

Sie sehen auch dass im Root-Ordner des Projektes eine Datei namens `artisan` existiert. Diese wird mit dem Befehl `php artisan`
aufgerufen (unter Unix benötigen Dateien keine Dateiendung)

Führen Sie den Befehl ohne das Kommando `serve` aus (also nur `php artisan`). Sie erhalten eine Liste
aller verfügbaren Befehle.

Schauen Sie diese kurz durch um einen Eindruck der Funktionen zu erhalten welche Laravel uns bietet.