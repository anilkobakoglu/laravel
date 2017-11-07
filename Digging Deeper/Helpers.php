
Laravel, çeşitli "yardımcı" PHP işlevleri içeriyor. Bu işlevlerin birçoğu çerçevenin kendisi tarafından kullanılır; Ancak bunları uygun bulursanız, kendi uygulamalarınızda kullanabilirsiniz.


<?php 
											--Arrays & Objects--

//örnek bir dizimiz olsun


$dizi=array('isim'=>'ako','parola'=>'zelite');



--//Array Except

//dizi değişkeninden değer çıkartmak istersen..

$filtre = array_except($dizi, ['parola']);

print_r($filtre);		//sadece isim yazar
________________________________________________________
--//array_has()



$array = ['product' => ['name' => 'Desk', 'price' => 100]];

$contains = array_has($array, 'product.name');

// true

$contains = array_has($array, ['product.price', 'product.discount']);

// false

__________________________________________________________

Array Only


$array = ['name' => 'Desk', 'price' => 100, 'orders' => 10];

$slice = array_only($array, ['name', 'price']);			//sadece istediğimiz içerikleri çekebiliriz

print_r($slice); 
//____________________________________________________________

Array pluck 
//Array_pluck işlevi, bir dizideki belirli bir anahtarın tüm değerlerini alır:

$array = [
    ['developer' => ['id' => 1, 'name' => 'Taylor']],
    ['developer' => ['id' => 2, 'name' => 'Abigail']],
];

$names = array_pluck($array, 'developer.name');

// ['Taylor', 'Abigail']

//________________________________________________________


Array Prepend

$array = ['one', 'two', 'three', 'four'];

$array = array_prepend($array, 'zero');		//diznin başına değer ekler


print_r($array);
// ['zero', 'one', 'two', 'three', 'four']


//___________________________________________________________

Array Pull 
$array = ['name' => 'Desk', 'price' => 100];

$name = array_pull($array, 'name'); //diziden değişken kaldırır

// $array: ['price' => 100]


//________________________________________________________________

Array RAndom 


$array = [1, 2, 3, 4, 5];

$random = array_random($array);//random değer çeker

// 4 

$items = array_random($array, 2); // iki tane çeker


//___________________________________________


Array Short



$array = ['Desk', 'Table', 'Chair']; 

$sorted = array_sort($array); // küçükten büyüğe sıralar

// ['Chair', 'Desk', 'Table'])


//____________________________________________
Array Wrap

$string = 'Laravel';

$array = array_wrap($string); //string bir değerse onu array yapar, değilse değiştrmez

// ['Laravel']


__________________________________________


Array HEad 
$array = [100, 200, 300];

$first = head($array);		//ilk değeri alır

// 100

//_______________________________________________



$array = [100, 200, 300];

$last = last($array);						//son değer

// 300


											--PATH--

//yollar


$path app_path();			//Bu klasorlerin yollarını verir içlerinie değer girince alt klasoru gibi gösteriliyor

$path = base_path();

$path = config_path();

$path = database_path();;

$path = public_path();

$path = storage_path();


										--STRİNG--



echo __('Welcome to our application'); // n işe yaradını bilmiyorum


Camel Case 

$converted = camel_case('ako_mine.zelite');

echo $converted

//AkoMİne.zelite yazar   // _ den sonra ki harfi büyük yapar

_______________________________________________		



Ends_Wİth

$result = ends_with('This is my name', 'name');	// cümlenin sonu name ile bitiyorsa ture döndüdür


// true								
_______________________________________________
Snake Case

$converted = snake_case('fooBar');  //büyük harften sonra

// foo_bar



_______________________________________________

starts_with()



$result = starts_with('This is my name', 'This');

// true

_______________________________________________


str_after()


$slice = str_after('This is my name', 'This is'); //this is den sonrası

// ' my name'

_______________________________________________


str_before()


$slice = str_before('This is my name', 'my name'); //tam teersi

// 'This is '

________________________________________________________


str_contains()

$contains = str_contains('This is my name', 'my'); // böyle bir kelime va rmı

// true

_______________________________________________

Str_RAndom

$random = str_random(40);
echo $random; 							//rastgele kırk karakterlikmetin  oluşturur

_______________________________________________

str_replace_array()


$string = 'The event will take place between ? and ?';

$replaced = str_replace_array('?', ['8:30', '9:00'], $string);

// The event will take place between 8:30 and 9:00
_______________________________________________


title_case()


$converted = title_case('a nice title uses the correct case');

// A Nice Title Uses The Correct Case

															


															--URL--


Action:

$url = action('databasedeneme@deneme');		// bunu yazdığımda bu controllerin hangi url de çalıştıını gösterir

return $url;			 //http://localhost:8000/db												


_______________________________________________


Route: 
$url = route('home'); // hangi rota isminin hangi urlde çalıştını gösterir..



$url = route('home');


_______________________________________________
Secure_url

$url = url('usser/home'); //https://localhost:8000/usser/home


_______________________________________________

													--Miscellaneous--

Abort:

hata sayfalarına yönlendirme mesela abort(404); 404 sayfası açılır.


Now:

echo now(); // şuanki tarih saat

