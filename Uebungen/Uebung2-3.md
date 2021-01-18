# Übung 2.2 #

> Vorbereitung wie bei jeder anderen Übung.

## Daten auslesen ##

Erweitern Sie die Ausgabe aller Kunden von der Übung 2.2. Fügen Sie für jeden Kunden einen Link
auf eine andere .php Datei ein (`bestellungen.php`) in welcher alle Bestellungen des Kunden aufgelistet werden.

> Übergeben Sie die ID des Benutzers als GET Parameter (`bestellungen.php?id=4`)

> Stellen Sie sicher dass die Seite gegen XSS Angriffe geschützt ist.

## Daten löschen ##

Fügen Sie nun in der Bestellübersicht einen Link ein um die entsprechende Bestellung zu löschen.
Ruft man den Link auf (`delete.php?id=2`) soll die Bestellung in der Datenbank gelöscht werden.

> Falls Sie möchten können Sie per Javascript noch eine Sicherheitsabfrage ausgeben lassen (`confirm()`)