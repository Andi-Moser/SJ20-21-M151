# Übung 7.1 #

## Demodaten erstellen ##

In der Übung 5.1 haben wir zusätzlich zum Model und der Migration noch einen Seeder und eine Factory erstellt.

Diese werden verwendet um Demo Daten automatisch zu erstellen. So benötigt man nur das Projekt und keine
Datenbank um das Projekt bei sich zu starten.

### Factory ###

Die Factory definiert wie ein Demo Produkt aussehen muss. Fügen Sie deshalb folgenden Code in
die Datei `ProductFactory.php` ein:

```php
<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;
    
    public function definition()
    {
        return [
            'name' => 'Produkt ' . Str::random(5),
            'price' => rand(100, 1000) / 10,
            'details' => Str::words(50),
            'manual' => Str::words(50),
            'image' => 'image.jpg'
        ];
    }
}
```

### Seeder ###

Der Seeder erstellt nun diese Objekte und speichert sie:

Wir verwenden folgenden Code für die Datei `ProductSeeder.php`
```php
<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::factory()
                ->count(50)
                ->create();
    }
}
```

### Seeder ausführen ###

Diesen Seeder führen Sie nun mit folgendem Befehl aus:

`php artisan db:seed --class=ProductSeeder`

## Seeder für andere Klassen erstellen ##

Erstellen Sie nun für die anderen Klassen Seeder und Factories.