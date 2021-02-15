# Übung 5.3 #

Diese Übung erfordert keine Abgabe. Die hier beschriebene Technik wird jedoch später
im Projekt relevant.

## Traits ##

Wenn später überprüft werden muss ob ein Benutzer eingeloggt ist muss dies bei allen geschützten
Seiten vorhanden sein. Damit nicht in allen Controllern diese Methode implementiert werden muss,
stellt PHP Traits zur Verfügung.

> Ein Trait ist eine Möglichkeit eine Klasse zu erweitern. Traits können mehreren Klassen mehr Methoden
> zur Verfügung stellen.
> 
> Der Vorteil im Gegensatz zur Vererbung ist, dass eine Klasse mehrere Traits haben kann (im Gegensatz zu nur einer Vererbung).

Im folgenden Beispiel ist ein Trait beschrieben. Schauen Sie sich dieses durch damit Sie diese Methode
später im Projekt anwenden können:

```php
class CheckoutController {
    use LoginTrait;
    
    public function sendOrder() {
        $this->checkLogin();
    }
}

class ProfileController {
    use LoginTrait;
    
    public function orders() {
        $this->checkLogin();
    }
}

trait LoginTrait {
    public function checkLogin() {
        // Prüft ob der Benutzer in der Session ist...
        
        return true;
    }
}
```

Wie Sie sehen ist die Methode `checkLogin` im Trait definiert, kann aber in beiden Klassen verwendet werden.