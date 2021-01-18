# Übung 2.4 #

## Daten einfügen ##

Erstellen Sie ein HTML Formular mit welchem ein neuer Kunde hinzugefügt werden kann. Das Formular
soll alle Felder welche die Tabelle `customers` benötigt beinhalten.

Nach dem Absenden des Formulars soll der Kunden in der Datenbank erstellt werden und dem Benutzer
wieder die Liste aller Kunden ausgegeben werden.

## Daten aktualisieren - Teil 1 ##

Erweitern Sie obenstehendes Formular wie folgt:

Dem Formular soll per GET Parameter ein Kunde per ID übergeben werden können.
Wird das Formular mit der ID eines Kunden aufgerufen soll es mit den entsprechenden Werten vorausgefüllt
sein damit man den Kunden aktualisieren kann.

> Fügen Sie ebenfalls ein versteckes Input Feld mit der ID des Kunden ein
> (`<input type='hidden' name='customer_id' id='3'>`)
> 
> Ist keine ID vorhanden so soll dieses Feld leer sein (`value=''`) 

## Daten aktualisieren - Teil 2 ##

Wenn das Formular abgesendet wird soll das PHP Script entscheiden was passiert:

- customer_id vorhanden? => Kunde wird aktualisiert
- customer_id NICHT vorhanden => Neuer Kunde wird erstellt