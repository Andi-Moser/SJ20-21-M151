# Übung 3.4 #

## Login Vorbereiten ##

Wir möchten die in Übung 3.3 erstellte Übersicht mit einem Login sichern. Benutzer sollen sich Registrieren und nach der Registrierung einloggen können.

Damit sich Benutzer überhaupt einloggen können, braucht es eine Tabelle in welcher wir die Benutzerdaten ablegen können.
Erstellen Sie diese Tabelle in der Northind Datenbank.

**Tabelle `logins`**

| Name | Datentyp |
| --- | --- |
| id | INTEGER |
| username | VARCHAR(255) |
| password | VARCHAR(255) |
| first_name | VARCHAR(255) |
| last_name | VARCHAR(255) |

## Registrierung einbauen ##

In einer neuen Datei `register.php` kann sich der Benutzer registrieren.

Auf ihr soll ein Formular erscheinen mit allen benötigten Feldern. Bei Absenden soll ein neuer Eintrag
in der Tabelle `logins` erstellt werden und der Benutzer zur Login Seite weitergeleitet werden.

> Prüfen Sie vor dem Erstellen des Logins ob der Benutzername bereits vergeben ist!

> Verwenden Sie zum hashen des Passworts die Funktion `password_hash()`

## Login einbauen ##

Auf der Seite `login.php` kann sich der Benutzer nun mit Benutzername und Passwort einloggen.

Erstellen Sie das Login Formular und prüfen Sie beim Absenden ob Bentuzername und Passwort stimmen.
Ist die Kombination korrekt wird der Benutzer auf die Seite aller `customers` weitergeleitet, falls nicht
soll eine Fehlermeldung ausgegeben werden.

Wenn der Benutzer eingeloggt ist soll dies in der Session so hinterlegt werden.

> Verwenden Sie zum Prüfen des Passworts die Funktion `password_verify()`

## Logout einbauen ##

Erstellen Sie eine simple Seite `logout.php` auf welcher der Benutzer ausgeloggt wird. Nach dem Logout
wird der Benutzer wieder auf die Login Seite weitergeleitet.

> Um den Benutzer auszuloggen reicht es, die Session zu löschen (`session_destory()`)

## Sensible Seiten schützen ##

Das Login ist relativ sinnlos wenn auf gesperrten Seiten nicht geprüft wird ob der Benutzer auch wirklich eingeloggt ist.

Prüfen Sie bei allen internen Seiten (alle ausser Login und Registrierung) ob ein Benutzer in der Session vorhanden ist. Ist keiner
vorhanden leiten Sie den Benutzer auf die Login Seite weiter.

> Damit der Code zum Login-Check nicht auf jeder Seite verüfgbar ist, lohnt es sich diesen auszulagern.
> 
> Erstellen Sie eine Datei `login_check.php` und laden Sie diese Datei bei allen benötigten Seiten mit `include 'session_check.php';`
