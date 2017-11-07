
//kelime anlamı arakatman
//kullanım amacı filtreleme


//1- Php artisan make:middleware "isim" cmd ye bunu yazarak bir middleware oluşturmuş oluyoruz

#2- bunu yazdıktan sonra App/Http/Middleware klasörü altında ismini verdiğimiz middleware sayfası oluşur.

# ÖRNEĞİN 


<?php

namespace App\Http\Middleware;

use Closure;

class CheckAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->yas <= 200) {
            return redirect('home');
        }

        return $next($request);
    }
}

// yaşı 200 den küçükse eve gitsin büyükse devaö etsin..

?>
3- app/middleware/kernel.php dosyası içerisine gelip  yolunu veriyoruz.

4-'admin' => \App\Http\Middleware\admin::class, (o sayfada buna benzer örnekler var bakarak yazılır)

_________________________________________________________________________________________________________________________________________________________

                                ROTAYA MİDDLEWARE ATAMA

    <?php 
//örneğin....



//Checkage diye bir middleware oluşturdum 
    namespace App\Http\Middleware;

use Closure;

class CheckAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if($request->age >= 20)//  buraya yaşı rotadan göndericem
        {

         return $next($request);//yaşı 20 den büyükse çalışsın

        }
        else
        {

           return redirect("/");//değilse anasyafaya yönlendirsin..
        }
       
    }
}


//2. yapacağımız şey bu middleware yi sisteme tanıtmak..
/*
        App\midleware\kernel dosyasını açıyoruz

        protected $routeMiddleware'in altına 

         'age'=>\App\Http\Middleware\CheckAge::class,


        bunu yazıyoruz artık rotalar da bu middleware yi age diye çağırcaz.

*/

// 3. Rota da middleware nasıl eklenir..


 Route::get("ako/{age}",function($age){ //yaşı CheckAge.php de request ile çekiyorduk..

    echo"yaşınız 20 den büyük";

})->middleware('age');



//NOT midllewaremizi böyle de çağırabiliriz.

Route::get("ako/{age}",function($age){ //yaşı CheckAge.php de request ile çekiyorduk..

    echo"yaşınız 20 den büyük";

})->middleware('CheckAge::class');





    ?>

____________________________________________________________________________________________________________________________________________________________



                                    MİDDLEWARE GRUP
<?php 

// birden fazla rotaya aynı middleware eklemektense bir grup oluşturup içine rotalar ekleyip hepsine aynı middleware eklenmesi daha kolay bir yöntemdir..

// admin adında bir middleware oluşturalım.. php artisan make:middleware Admin

// Rotamızı yazalım..


Route::group(['prefix'=>'admin','middleware'=>'admin'],function(){

        Route::get("/{kim}",function($kim){

                return view('backend.admin');
        });
            Route::get("ayarlar/{kim}",function($kim){

                return view('backend.admin');
        });



});



//prexik admin yaptığumuzda her seferinde admin/ayarlar admin/profil vs yapmak yerine prefix admin yapıyorsun altına profil ayarlar vs sıralıyorsun... altında ki rotaların önünde admin yazıyormuş gibi düşün..


// {kim} Kimi Admin middlewaresinde çekicez..


// Admin middlewaremimzi oluşturalım= php artisan make:middleware Admin

namespace App\Http\Middleware;

use Closure;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if($request->kim == 'ako'){   // diyelim ki girdğimiz url şu şekilde http://localhost:8000/admin/ako

             return $next($request);       //adminden sonrasını request ile alıyoru
                                            //saçma bir kurgu ama eğer ako ise rota çalışıyor değilse anasayfaya yönlendiriyor
        }else{

            
            return redirect('/');
        }
       
    }
}

/*NOT KURGU= diyelim ki admin panelimiz var ve sayfalar olarak profil admin uyeler gibi sekmelerimiz var..

        localhost/admin/profil
         localhost/admin/uyeler
          localhost/admin/ayarlar  gibi seklmelerimiz (url) var.. bunun için bir Rota Grubu oluşur başına prefix admin diye ekle(tercihen)

        daha sonra bir admin middlewaresi oluştur. Bak bakayım buraya ulaşmak isteyen gerçekten admin mi gerekli sorgulamaları yap ve adminse rotanın içeriğini çalıştır değilse isteğe göre işlemler yap..

        -derineinmedenkurgu-
*/
?>


        

























