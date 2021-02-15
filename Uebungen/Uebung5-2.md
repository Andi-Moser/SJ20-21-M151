# Übung 5.2 #

## Routen ##

Der Einstiegspunkt einer Web Applikation sind immer die Routen. Sie verknüpfen die aufgerufene URL
mit einer Methode eines Controllers.

> In Laravel können simple Routen auch ohne Controller existieren.
> Wir werden jedoch für jede Route auch einen Controller erstellen.

Alle Routen sind im File `laravel/routes/web.php` hinterlegt.
Schauen wir uns mal an wie so eine Route aussieht:

```php
Route::get('/', function () {
    return view('welcome');
});
```

Diese Route antwortet auf GET Request mit dem Pfad `/` und gibt die View `welcome` zurück.

> Soll eine Route POST Requests beantworten muss `Route::post()` verwendet werden.

Da diese View keine Daten benötigt ist hier auch kein Controller hinterlegt.

### Eigene Route erstellen ###

Wir möchten nun eine Route erstellen welche alle Produkte auflistet. Die Route soll
auf den Pfad `/products` (GET) lauten und die Methode `ProductController::list()` aufrufen.

Wir erstellen also die Route wie folgt:

```php
Route::get('/products', [\App\Http\Controllers\ProductController::class, 'list']);
```

Anstelle einer Funktion übergeben wir hier ein Array, bestehend aus dem Namen der Controller Klasse und der Methode.
Diese Methode müssen wir nun noch im `ProductController` ergänzen:

```php
public function list() {
    die('in here!');
}
```

Nun können wir den Webserver mit `php artisan serve` starten und die URL `http://127.0.0.1:8000/products` aufrufen.

### Daten auslesen ###

Wir möchten in diesem Controller nun alle Produkte auslesen.

> Erstellen Sie zuerst einige (3-4) Einträge in der `products` Tabelle damit wir überprüfen können ob dies funktioniert.

Dafür ergänzen wir folgenden Code in der `list` Methode:

```php
$products = \App\Models\Product::all();

echo "<pre>";
var_dump($products);
die();
```

Wir erhalten nun eine Collection (`Illuminate\Database\Eloquent\Collection`) mit allen Produkt-Models.

## Views ##

Nun erstellen wir eine View welche alle Produkte in einer HTML Tabelle ausgibt.
Wir erstellen also im Ordner `laravel/resources/views` eine neue Datei namens `products.blade.php`.

> Blade
> 
> Blade ist eine sog. Templating Engine. Innerhalb von .blade.php Files kann normales PHP verwendet werden,
> es empfiehlt sich aber die Blade Funktionen für Loops, If-Abfragen usw zu verwenden.
> 
> Variablen können in Blade mit {{ $variablenName }} ausgegeben werden.
> 
> Weitere Informationen finden Sie in der [Dokumentation](https://laravel.com/docs/8.x/blade)

In dieser View fügen wir folgenden Coden ein:

```html
<html>
<head>
    <title>Alle Produkte</title>
</head>

<body>
    {{dd($products)}}
</body>
</html>
```

Im Controller müssen wir noch die View aufrufen und ihr die Produkte übergeben:

```php
public function list() {
    $products = \App\Models\Product::all();

    return view('products', ['products' => $products]);
}
```

Nun werden die Produkte in der View ausgegeben (gedumpt). Wir wollen jedoch die Produkte in einer schönen Tabelle ausgeben:

```html
<table>
    <tr>
        <th>Name</th>
        <th>Preis</th>
        <th>Details</th>
    </tr>
    @foreach ($products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->price }}</td>
            <td><a href="/product/{{ $product->id }}">Link</a></td>
        </tr>
    @endforeach
</table>
```

## Produktdetail ##

In der Liste oben haben wir bei den Produkten einen Link zur Detailseite mit `/product/1` angegeben.

Nun wollen wir dass unter diesem Link die Detailseite eines Produktes ausgegeben wird. Dafür erstellen wir folgende Route:

```php
Route::get('/product/:id', [\App\Http\Controllers\ProductController::class, 'detail']);
```

Die Methode im Controller erstellen wir wie folgt:

```php
public function detail($id) {
    dd($id);
}
```

> Beachten Sie wie bei der Route `/product/{id}` der Name des Parameters in {} geschrieben ist.
> Dieser Parameter wird automatisch der Methode `detail` übergeben.

Erstellen Sie nun eine View für die Detailseite in welcher Sie das Produkt ausgeben.

> *Einzelnes Element aus der Datenbank laden*
> 
> Ein einzelnes Element können Sie wie folgt aus der Datenbank laden:
> 
> `$product = \App\Models\Product::find($id);` (Wenn wir die ID des Elements haben)
> 
> `$product = \App\Models\Product::where('id', $id)->first();` (Hier können wir nach beliebigen Spalten filtern. `->first()` gibt uns das erste Objekt zurück)
