# Übung 6.1 #

## Beziehungen mit Eloquent ##

> Eloquent ist das System welches Laravel einsetzt, welches unsere PHP Klassen mit der Datenbank "verknüpft".
>
> Suchen Sie auf Google nach Hilfestellungen so können Sie direkt nach der Eloquent Lösung suchen, z.B. "Eloquent one to many relationship"

Bisher haben wir nur eigene Modelle erstellt welche keine Beziehungen zueinander haben.

Es ist war möglich auch so zu arbeiten, allerdings nimmt uns Laravel hier einige Arbeit ab. Studieren Sie hierzu dieses Beispiel:

```php
// Methode in der Klasse UserController
public function orders($id) {
    $user = User::find($id);

    $orders = Order::where('user_id', $id)->get();
    dump($orders);
    dd($user);
}
```

Mit diesem Code wird der Benutzer geladen und im nächsten Schritt alle seine Bestellungen.

Von einem MVC Standpunkt her ist dies allerdings nicht optimal. Der Controller muss wissen wie die Verknüpfung aufgebaut ist.
Schöner ist es, wenn das Model selbst die Verknüpfung kennt.

## HasMany Beziehung ##

In diesem Beispiel (Benutzer und Bestellungen) besteht vom **Benutzer** zur **Bestellung** eine has-many Beziehung
(da ein Benutzer mehrere Bestellungen hat).

Wir können dies in Laravel gleich im Model des Benutzers hinterlegen:

```php
// File: /app/Models/User.php
class User extends Model
{
    use HasFactory;

    public function orders() {
        return $this->hasMany(\App\Models\Order::class);
    }
}
```

Im UserController können wir unsere Methode wie folgt anpassen:

```php
// Methode in der Klasse UserController
public function orders($id) {
    $user = User::find($id);
    dd($user->orders);
}
```

Folgendes wurde dabei verändert:

- `User::with('orders')->find($id)`

    Die Angabe `with('orders')` sagt Eloquent, dass es zusammen mit dem Benutzer auch die Bestellungen laden soll. Mit
    `->find($id)` laden wir den Benutzer mit der gewünschten ID **und den Bestellungen** aus der Datenbank
    
- `dd($user->orders)`

    Wie Sie sehen, verwenden wir hier das Property `orders` und nicht **die Methode `orders`**! Die im Model angegebene Methode
    wird intern durch Eloquent aufgerufen und legt alle Bestellungen im Property `orders` ab.
    
## BelongsTo Beziehung ##

Nun möchten wir die Beziehung noch auf der "anderen Seite" hinterlegen. Wir möchten von einer Bestellung auf den Benutzer verweisen.
Hierzu verwenden wir eine belongs to Beziehung (die Bestellung gehört zu einem Benutzer).

Wir passen nun das Model der Bestellung an:

```php
class Order extends Model
{
    use HasFactory;
    
    public function user() {
        return $this->belongsTo(User::class);
    }
}
```

Nun können wir im Code von einer Bestellung den Benutzer laden:

```php
$order = Order::find($id);
dd($order->user);
```

Mehr Anleitungen und andere Beziehungstypen finden Sie in der [offiziellen Dokumentation](https://laravel.com/docs/8.x/eloquent-relationships).