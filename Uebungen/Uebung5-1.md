# Übung 5.1 #

## Vorbereitung ##

Nun wird das Laravel Projekt an die Datenbank angebunden. Dafür müssen als erstes die Datenbankverbindungsdaten
hinterlegt werden.

### Umgebungen ###

Zugangsdaten wie Passwörter oder API Keys werden in `env` Files gespeichert. Diese sind vom GIT ausgeschlossen damit
nicht plötzlich Passwörter in einem öffentlichen Repository stehen.

In Laravel Ordner finden Sie ein File namens `.env`. Dies ist das Standard Env File. Weitere können für jede Umgebung
erstellt werden, z.B. `.env.development` welches nur in der Entwicklungsumgebung geladen wird.

> Was ist eine Umgebung?
> 
> Entwicklungsumgebung bezieht sich in diesem Kontext nicht auf Visual Studio Code sondern auf den 
> Server auf welchem das Projekt läuft. So gibt es den lokalen Server (`development`), den Testserver auf welchem 
> automatisierte Tests ausgeführt werden (`test`) und den Live-Server (`production`)

### Zugangsdaten hinterlegen ###

Suchen Sie nun im File `.env` folgende Zeilen und hinterlegen Sie dort die Zugangsdaten für Ihre Datenbank:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

> Im `.env` File finden wir noch weitere interessante Einstellungen, z.B.:
> 
> ```env
>    SESSION_DRIVER=file
>    SESSION_LIFETIME=120
> ```
> Dies sagt Laravel dass die Informationen welche in der Session gespeichert sind intern in einer Datei abgelegt werden
> und dass eine Session nach 120 Minuten ohne Aktivität abläuft.

### Bestehende Daten löschen ###

Die Standard Laravel Installation enthält bereits ein Model und zwei Migrationen welche wir nicht benötigen.

Löschen Sie nun alle folgenden Dateien:

- `laravel/database/migrations/2014_10_12_000000_create_users_table.php`
- `laravel/database/migrations/2014_10_12_100000_create_password_resets_table.php`
- `laravel/app/Models/User.php`

## Erstes Model erstellen ##

Wir wollen nun die erste Tabelle (ein Model bezieht sich immer genau auf eine Tabelle) erstellen.
Wir starten mit einer simplen Entität - einem Produkt

### Dateien erstellen ###

Führen Sie in der Konsole folgenden Befehl aus:

`php artisan make:model Product --controller --factory --migration --seed`

Der Befehl ist wie folgt aufgebaut:

| Befehl | Bedeutung |
| --- | --- |
| make:model | Erstellt ein neues Model |
| --controller | Erstellt einen Controller für das Model |
| --factory | Erstellt eine Factory. Die Factory wird später verwendet |
| --migration | Erstellt ein Migration File in welchem der Aufbau der Tabelle beschrieben ist |
| --seed | Erstellt einen Seeder welcher ebenfalls später verwendet wird |

> Achten Sie darauf dass Sie sich in der Konsole im Verzeichnis von Laravel befinden!

> Controller, Factory und Seeder können auch später noch erstellt werden, es ist jedoch einfacher wenn dies bereits jetzt gemacht wird.

### Migration befüllen ###

Öffnen Sie das erstellte File `laravel/database/migrations/2021_02_15_094145_create_products_table.php`.

> Der Zeitstempel zu Begin der Datei wird bei Ihnen anders sein.

Zu Beginn interessiert uns nur die Methode `up`:

```php
public function up()
{
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->timestamps();
    });
}
```

Hier wird die Tabelle erstellte (`Schema::create`) und darin wird der Tabelle ein Primärschlüssel
(`$table->id()`) sowie Timestamps (Erstellt am, Geändert am).

> Die Timestamps können Sie optional entfernen

Ergänzen Sie nun diese Funktion wie folgt:

```php
$table->id();
$table->timestamps();

$table->string('name');
$table->float('price');
$table->text('details');
$table->text('manual');
$table->string('image');
```

Nun werden der Tabelle die benötigten Felder hinzugefügt. Mit `$table->` können Spalten mit unterschiedlichen Datentypen hinzugefügt werden:

- `$table->string('name')` - Name: name, Datentyp: VARCHAR
- `$table->float('price')` - Name: price, Datentyp: FLOAT
- `$table->text('details')` - Name: details, Datentyp: TEXT

Mit `$table->integer()` könnten wir noch Integer Spalten hinzufügen, diese benötigen wir jedoch nicht.

> Wieso ist das Bild in einem String gespeichert?
> 
> Bilder sollten nicht direkt in der Datenbank gespeichert werden. Stattdessen müssen Sie den Bildnamen als String speichern.
> Das Bild selbst ist direkt im Projekt als normale Datei gespeichert

### Migrationstabelle erstellen ###

Damit Laravel weiss welche Migrationen bereits ausgeführt wird, braucht es eine Migrationstabelle.

Diese müssen wir zum Glück nicht selbst erstellen sondern können sie mit folgendem Befehl erstellen lassen:

`php artisan migrate:install`

### Migrationen ausführen ###

Nun können wir den Status all unser Migrationen ansehen:

`php artisan migrate:status`

Dies gibt eine Ausgabe wie folgende:

```
+------+--------------------------------------------+-------+
| Ran? | Migration                                  | Batch |
+------+--------------------------------------------+-------+
| No   | 2019_08_19_000000_create_failed_jobs_table |       |
| No   | 2021_02_15_094145_create_products_table    |       |
+------+--------------------------------------------+-------+
```

Wie wir in der ersten Spalte sehen ist noch keine Migration ausgeführt - dies wollen wir ändern:

`php artisan migrate`

Prüfen wir nun erneut den Status (`php artisan migrate:status`) sehen wir folgende Ausgabe:

```
+------+--------------------------------------------+-------+
| Ran? | Migration                                  | Batch |
+------+--------------------------------------------+-------+
| Yes  | 2019_08_19_000000_create_failed_jobs_table |  1    |
| Yes  | 2021_02_15_094145_create_products_table    |  1    |
+------+--------------------------------------------+-------+
```

Überprüfen Sie nun ob die Produkttabelle korrekt erstellt wurde!

## Tipps und Tricks ##

### Feld vergessen? ###

Wenn Sie einer Tabelle ein weiteres Feld hinzufügen möchten (z.B. Anzahl Verfügbare Artikel `stock`)
können Sie hierfür eine einzelne Migration erstellen:

`php artisan make:migration add_stock_to_products`

Dies erstellt eine neue Migration. Laravel versucht aus dem Befehl automatisch den Tabellennamen (`products`) zu erraten,
also achten Sie darauf dass dieser korrekt geschrieben ist!

### Frischer Start? ###

Sie können die Datenbank jederzeit komplett neu generieren lassen:

`php artisan migrate:fresh`

Dieser Befehl löscht zuerst alle Tabellen (und die entsprechenden Daten) und erstellt sie neu.

### Aufräumen? ###

In der Praxis werden beim Programmieren einer Software ständig neue Migrationen hinzugefügt.

Wird ein Feature abgeschlossen kann man alle Migrationen davon zu einer zusammenfassen und mit `php artisan migrate:fresh`
die Datenbank neu erstellen lassen. So hat man am Ende eines Features nur noch eine Migration pro Tabelle.

## Stopp! ##

Der erste Teil dieser Übung ist vorbei, wir werden diesen im Plenum besprechen und danach mit dem zweiten Teil fortfahren.

## Alle Tabellen erfassen ##

Erstellen Sie nun für jede Tabelle in Ihrem Datenbankschema die Migration wie oben beschrieben.