
Bu sayfada controllerde neler yapılabilir kısmen onlara değindim..diğer konularda daha fazla controller işlemi bulmak mümkün..


											#CONTROLLER MİDDLWARE

<?php 

// Nornmalde rotada şu şekilde bir middleware tanımlayabiiliyoruz..

Route::get("admin","abc@asdf")->middleware('admin');

//contructda ise middleware belirtmek istiyorsak..not: laravelin resmi sitesine göre middlewareyi (arakatman) burada kullanmak daha verimli..

//1- contruct (kurucu fonksyionu)içine örneğin..


 public function __construct(){

 	$this->middleware('admindeneme'); // Sınıfın diğer fonksiyonu çalışmadan önce middleware-ara katmanın araya girer ve gerekli işlemleri yapar.
 }

 	



		//Class içinde middlewareye müdahale eddebileceğimiz üç seçeneğimiz var

		1. $this->middleware('admindeneme');  // Eğer sanadece bunu yazarsak o class içinde ki tüm methodlar middlewareden etkileninir.

		2. $this->middlware('admindeneme')->only('profil');  //'only' bunu yazarsak.. bu class içinde sadece bu methodu etkile demek.

		3. $this->middleware('admindeneme')->except('profil'); //'except' bunu yazarsak.. Bu class içinde bu bunun dışındakilere admin middlewaresini uygula deriz.


// dizi şeklinde kullanımları:
		$this->middleware('admindeneme', ['except' => ['get_admin', 'get_ayarlar']]);
		$this->middleware('admindeneme', ['only' => ['get_admin', 'get_ayarlar']]);

// Son olarak App\http\kernel.php içerisine middlewaremizi tanımlamamız gerek.  protected $routeMiddleware içine: örneğin  'admindeneme'=>\App\Http\Middleware\admindeneme::class, yazıyoruz
//__________________________________________________________________________________________________________________________________________________________________
?>
													RESOURCE C0NTROLLERS

<?php 

/*Laravel kaynak yönlendirme, tipik "CRUD" yollarını tek bir kod satırı ile denetleyiciye atar. Örneğin, uygulamanız tarafından saklanan "fotoğraflar" için tüm HTTP isteklerini işleyen bir denetleyici oluşturmak isteyebilirsiniz.

1- Resource controlleri oluştur= php artisan make:controlle FotoKontrol --resource

Böyle bir controller oluşacak..*/


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "index ";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return "create";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return"store";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return "goster".$id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       return "düzenle".$id;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return "güncelle".$id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return "kaldırıldı".$id;
    }
}
//içlerine kısaca bir iki return doldurdum.

// Routerde nasıl rota ataması papılır?

Route::resource("foto","photoController"); //gibi rotalandırma yapılır.

// PEKİ URL YE NE YAZARSAM NE OLUR???

a- GET İLE= "http://localhost:8000/foto/" ==  İNDEX methodu
b- GET İLE ="http://localhost:8000/foto/create" == CREATE methodu
c- POST İLE= "http://localhost:8000/foto/" == STORE methodu
d-GET ile "http://localhost:8000/foto/8" == SHOW methodu
e- GET ile "http://localhost:8000/foto/8/edit" == EDİT methodu
f- PUT/PATCH ile ="http://localhost:8000/foto/8" == UPDATE methodu
g-DELETE ile ="http://localhost:8000/foto/8" == DESTROY methodu çalışır..

// bubları kullancaksan PUT DELETE PATCH 
{{ method_field('PUT') }}//bunu kullanmayı unutma




Route::resource('photo', 'PhotoController', ['only' => [
    'index', 'show'
]]);

Route::resource('photo', 'PhotoController', ['except' => [
    'create', 'store', 'update', 'destroy'
]]);

// bu tarz seçimlerle resource controllerinde ki istediğin özellikleri kullanabilirsin



// PARAMETRE GÖNDERMEK İÇİN


Route::resource('user', 'AdminUserController', ['parameters' => [
    'user' => 'admin_user'
]]);





//________________________________________________________________________________________________________________________________________________________________
?>