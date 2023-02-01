# Übung 1.5 #

> Wie immer wird für die Übung ein eigener Ordner erstellt.

## Vorbereitung ##

Erstellen Sie wie immer einen neuen Ordner für diese Übung den Sie
dann im Browser öffnen können (z.B. http://m151.test/Uebung1-5/)


1. Erstellen Sie in der Datei `index.php` ein simples Formular. Geben Sie als `action` Attribute die eigene Seite (`?`) an:

```html
<form method="POST" action="?">
    <input type="text" name="name" placeholder="Benutzername" />
    <input type="submit" value="Absenden" />
</form>
```

> Als Methode wählen Sie die `POST` Methode.

## Daten empfangen und ausgeben ##

1. Fügen Sie in der Datei `index.php` oberhalb des Formulars folgenden Code ein:

```php
<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['name'];
        echo "Hallo {$username}!";
    }
?>
```

### Aufgaben ###

- [ ] Bauen Sie als weiteres Formularelement ein Dropdown (`<select>`) ein in welchem der Benutzer seine Klasse wählen kann und geben Sie diese aus
- [ ] Geben Sie einen Fehler aus wenn der Benutzer keinen Namen angegeben hat

## Pizza Konfigurator ##

Erstellen Sie ein Formular mit welchem sich der Benutzer eine eigene Pizza zusammensetzen kann.

Der Benutzer kann eine Zutat eingeben und diese mit einem Klick auf den Button hinzufügen. Verwenden Sie
das Wissen aus der Übung 1.2 um die Zutaten in der Session zu speichern.

![Pizza Konfigurator](https://github.com/Andi-Moser/SJ20-21-M151/raw/main/Uebungen/img/pizza.png)

### Tipps ###

- Sie können die Liste der Zutaten entweder als Array oder als String abspeichern.
- Wie PHP Arrays behandelt können Sie einfach per Google rausfinden.