<?php 

//view sayfalarının uzantısı .blade olmalı

//1- View sayfasında değişken gösterme

<html>
    <body>
        <h1>merhaba, {{ $isim }}</h1>
    </body>
</html>

//______________________________________

// ROTADAN VİEW E DEĞİŞKEN GÖNDERME
route::get('home',function(){


	return view('anasayfa',['name'=>'ako']); // Dizi şeklinde değişken gönderilebilir

	//anasayfa.blade.php de ise {{$name}} yazdığımızda bu urlyi girdikten sonra ekrana ako da yazar.
	// NOT daha önce başka bir rota ile bu viewi çalıştırdıysanız ve bu rotadan önce yazılmışsa yönlendirilmesi hata alırsın name undefined gibi..

});
//______________________________________


route::get('home',function(){

	$name="ako";

	return view('anasayfa',compact('name'));//Compact özelliği ile de veri gönderilebiir fakat $ işaretini koyma..


});

//____________________________


Route::get('uyeler',function(){

	return view('admin.uyegoster');//resources klasoru altında view klasorunun latında bir klasor oluşturup içine bir view blade atadıysanız . işareti ile o klasorın içine girilebilir.

	//    deneme/ass gibi düşün.


});
//________________________________

// Bir Viewin var olup olmadığını görmek için..

/*İlk olarak bu class ı cağır. */use Illuminate\Support\Facades\View; 

// ÖRNEK KULLANIMI 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class mycontroller extends Controller
{
    public function anasayfa(){

    		
    		if (View::exists('backend.adminIndex')) {

    			echo"var";
    
}


    }
}


//______________________________


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class mycontroller extends Controller
{
    public function anasayfa(){
    																// Viewe veri gönderme
    		
    		if (View::exists('anasayfa')) {

			return view('anasayfa',['name'=>'ako']);
}


    }
}



//_______________________________________

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class mycontroller extends Controller
{
    public function anasayfa(){

    		
    		if (View::exists('anasayfa')) {

			return view('anasayfa')->with('name','controllerdengonderilenname'); //WİTH ile veri gönderme sol tarafa ne yazarsan blade de o isimle çekmek zorudnasın
}


    }
}





//_______________________________________
	
	TÜM VİEW SAYFALARINA ORTAK BİR DEĞİŞKEN GÖNDERMEK

//Bazen tğm sayfalarda ortak bir değişken olması istenebilir. mrneğin saat vs 

// bunun için App/Providers/AppServideProvider php dosyaono aç..

// use Illuminate\Support\Facades\View; classını çağır
/*function boot içine*/  view::share('name','akominezelite'); /*yada ne istersen-*/

// ÖRNEKK.....
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        view::share('name','akominezelite');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
//____________________________________
















?>