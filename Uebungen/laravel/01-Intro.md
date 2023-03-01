# Laravel Einführung

## Was ist Laravel?

Laravel wurde im 2011 gestartet und ist zurzeit eines der vollständigsten PHP Frameworks. Es ist **kein** Content Management
System sondern für PHP Entwickler:innen ausgelegt.

Laravel stellt, wie andere Frameworks, Funktionen und Methoden zur Verfügung um häufige Probleme einfach zu lösen. Beinahe
alle simplen Probleme wurden bereits einmal gelöst und so hatte Laravel die Idee, diese Lösungen in einem Framework zusammenzufassen.

> Eine der besten Ressourcen um Laravel zu lernen ist der Kurs "[Laravel 8 from Scratch](https://laracasts.com/series/laravel-8-from-scratch)".
> 
> Auch wenn dieser Kurs auf Laravel 8 basiert (Laravel 10 erschien anfangs 2023) deckt er doch grosse Teile des Frameworks ab.

## Laravel ist mit MVC aufgebaut

Dies sollte an dieser Stelle besonders hervorgehoben werden. Obwohl Laravel einiges mehr als nur das MVC Pattern bietet
ist Laravel darauf ausgelegt dass Applikationen im MVC Pattern entwickelt werden. In den nächsten Abschnitten sehen
wir, welche Komponenten von Laravel dem M, V und C entsprechen.

## Komponenten von Laravel

Folgend sind einige Komponenten von Laravel aufgeführt. Wie erwähnt besitzt Laravel eine vielzahl von Modulen,
wir beschränken uns in diesem Modul jedoch auf folgende:

### Eloquent (Model)

Die wohl zentralste Komponente für uns - Eloquent. Eloquent ist ein ORM (object-relational mapper) welcher es uns ermöglicht,
die Daten aus der Datenbank einfach in PHP abzubilden.

Dank Eloquent muss man selten selbst ein SQL Query schreiben. Meist genügt eine Zeile wie folgende um ein User mit allen Bestellungen
zu laden und zu verändern:

```php
// Deactivate a user an cancel all his open orders
$user = User::with('orders')->where('id', 2)->get();

$user->orders->each(function($order) {
    if ($order->state == 'in-progress') {
        $order->state = 'cancelled';
        $order->save();
    }
});

$user->is_enabled = false;
$user->save();
```

In obigem Beispiel wird ein User deaktiviert und die offenen Bestellungen storniert. In der Order Klasse können
dann über Events noch weitere Aktionen ausgelöst werden wenn die Bestellung stoniert wird:

```php
public class Order extends Model {
    public function updated(Order $order)
    {
        if ($order->state === 'cancelled') {
            // TODO: Send an email to the logistics team, letting them know to NOT ship the order
        }
    }    
}
```

#### Migrationen

// TODO

#### Seeder & Factories

// TODO

### Controller / Request -> Response

Was ein Controller im MVC Model macht sollte hinlänglich bekannt sein.

Wie viele moderne Frameworks, arbeitet Laravel mit einem Request-Response-Lifecycle. Dies bedeutet, wenn eine Seite
aufgerufen wird, erstellt Laravel ein `Request` Objekt mit allen dazugehörigen Daten (URL, POST Parameter, HTTP Headers).
Dieser Request wird im Controller quasi zu einer `Response` umgewandelt:

```php
class UserController extends Controller
{
    public function show(string $id): View
    {
        $request = request();
        $user = User::findOrFail($id);
        
        // save the user data in case of a post request
        if ($request->isMethod('post')) {
            $user->fill($request->all());
            $user->save();
        }
        
        // return a view response of the user profile
        return view('user.profile', [
            'user' => $user
        ]);
    }
}
```

#### Validation

In obigem Beispiel werden die Daten welche übermittelt wurden 1:1 in die Datenbank geschrieben.

Dies ist nicht immer gewünscht, in den meisten Fällen muss man die Daten zuerst validieren. Laravel bietet hierfür
ebenfalls eine einfache Art der Validation an:

```php
$validated = $request->validate([
    'username' => 'required|unique:users|max:255',
    'email' => 'required|email',
    'age' => 'gt:0'
]);
```

So können wir mit wenigen Zeilen Code sicherstellen dass:

- ein Username gesetzt wurde und dieser eindeutig ist
- Die Email Adresse gesetzt und valide ist
- Falls ein Alter angegeben wurde, dieses grösser als 0 ist

#### Session

// TODO

### Blade Templates (View)

Gemäss MVC müssen die Views strikte von dem Controller und den Daten getrennt sein. Laravel verwendet hierfür die Blade
Template Enginge. Diese nimmt spezielle Blade Template (enden auf `.blade.php`) und füllt sie mit entsprechenden Daten.

Innerhalb der Blade Templates können wir Daten ausgeben, if-Abfragen ausführen oder über ein Set von Daten iterieren:

```html
Hello, {!! $user->username !!}.

@if ($user->role === 'admin')
    <p>Logged in as admin</p>
@endif

@foreach ($user->orders as $order)
    <p>Order {!! $order->id !!}, State: {!! $order->state !!}</p>
@endforeach
```

Wie im Beispiel der Controller gesehen, können wir ein Template mit der `view()` Funktion parsen und in eine Response umwandeln:

```php
return view('user.profile', [
    'user' => $user
]);
```

Der Name der View ist hier `user.profile`. Dies entspricht dem Ort an welchem das Blade Template abgelegt ist, sprich
`/resources/views/user/profile.blade.php`;

### Router

Der Router ist das Klebeband welches eingehende Requests mit Controllern verbindet. Zweck des Routers ist es, eine URL, z.B. `/user/profile` an den korrekten Controller weiterzuleiten.

Im einfachsten Fall kann sogar der Controller weggelassen werden. Unter `/` wird meistens die Startseite angezeigt,
dies kann also in solch einer Route definiert werden:

```php
Route::get('/', function () {
    return view('welcome');
});
```

Soll jedoch ein Controller aufgerufen werden um z.B. noch Daten dazu geladen werden, wird die Route wie folgt angegeben:

```php
Route::get(
    '/user/profile',
    [UserProfileController::class, 'show']
)
```

Ebenfalls lassen sich Parameter in Routen einbauen um z.B. das Profile eines beliebigen Users anzuzeigen:

```php
Route::get(
    '/user/profile/{id}',
    [UserProfileController::class, 'showPublic']
)

// Im Controller:
public function showPublic(string $id): View
{

}
```

#### Middlewares

// TODO

### Weitere Features

Folgende Funktionen sollen aufzeigen was Laravel "sonst noch so auf dem Kasten hat".
Wir werden uns in diesem Modul jedoch nicht vertieft damit auseinandersetzten.

#### Jobs / Queue

Geplante Funktionen welche zu einem definierten Zeitpunkt ausgeführt werden. Z.B. kann jeden Morgen um 08:00 Uhr ein
Email an die Logistik mit allen offenen Bestellungen versendet werden.

#### Dateiablage

Einfache Möglichkeit Dateien entweder auf dem Filesystem des Servers oder auf Google Drive/OneDrive/Amazon usw. zu speichern


