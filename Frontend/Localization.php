

Eğer sitemizde birden fazla dil desteği olsun istiyorsak..

İşin mantığı....

____________________________________________


laravlde varsayılan olarak bir dil tanımlanmıştır(İngilizce) ve o dile config\App içersinde   'fallback_locale' => 'en', özelliği ile tanımlanmıştır.
Şimdi benim yapmak istediğim kullanıcı ister ingilizce ister Türkçe dil desteği alsın. Bunun için bir session tanımlamak istiyorum kullanıcı 
ve session içerisinde kullanıcının istediği dil yazsın daha sonra ise session değeri varsa  dilimizi session içeriği ile değiştirelim.

Sessionu nasıl değiştirice bir url linkinden değer alıcam mesela türkçeye tıklayınca url şöyle olacak..localhost:8000/lang/tr

inigilizceye tıklayınca localhost:8000/lang/en 

daha sonra yapmamız gereken ise ikinci parametreyi almak yani en ve tr yi çekmek.. ona bir rota tanımlayalım
______________________________________
<?php 

route::get('lang/{lang}', 'langController@index');

// tr yada en i parametre olarak algılıyor.. daha sonra lang controller diye bir sınıfın içerinde index methodunu çalıştırıyor.
?>
______________________________________

o zaman bundan sonra ilk adım bir controller tanımlamak ve session değerine bir değer atamak olsun

php artisan make:controller langController yazıyorum..

<?php 
class LangController extends Controller
{
   
    public function index(request $request, $lang){
			$systemLangs=['en','tr']; //sistemde iki dilimiz olduğunu varsayalım sadece İng. ve Türkçe

			if(in_array($lang,$systemLangs)){ // urlde /lang/{$lang} lang olarak gelen parametre tr yada en mi diye bakar
				$request->session()->put('lang', $lang);//eğer sistemdeki dillerden birisi ise lang diye session açıp içine atar
			 return redirect()->back();//daha sonra hemen tıklanan sayfaya geri gider yani kullanıcı türkçe yada ingilizceye tıklayınca url yi göremez

	}

	else{
    			abort(404);  //eğer sistemde böyle bir dil yoksa 404 sayfa hatası verir..  		
    		}

             

    }
}

?>

____________________________________________

daha sonra bir middleware tanımlayalım bu middleware site açılır açılmaz devreye girsin yani rotaya tanımlamayalım middlewaremizin ismi ise Lang olsun.
bunun için artisana php artisan make:middleware Lang yazıyoruz
otomatik olarak App\Http\middleware klasoru altından sınıf oluşturulacak

şimdi middleware içerisine bakalım


<?php 

class lang
{
    public function handle($request, Closure $next )
    {

 if($request->session()->has('lang')) { // lang diye bir session tanımlanmışmı diye bakar..
	 $lang=$request->session()->get('lang');//tanımlanmışsa içeriğini çeker ve $lang e atar

      \App::setlocale($lang); //SETLOCALE ÖZELLİĞİ İLE DİL TANIMLIYORUZ İÇERİĞİNE YAZDIĞIMIZ STRİNG DEĞERİ GEÇERLİ DİL OLARAK ALGILIYOR.
     
       return $next($request); //devam et..
        }

 else{

  	\App::setlocale('tr');//eğer böyle bir session yoksa varsayılan olarak dilimiz tr olsun
	 return $next($request);//devam et

 }      
   }
    
     }
    
?>


şimdi middlewareyi de yazdık çalışır mı? hayır! yapmamız gereken bu middlewareyi sisteme tanıtmak..

App\Http\ klasoru içerisinde Kernel.php ye geliyoruz..
protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \App\Http\Middleware\lang::class, // bizim yazdığımız lang sınıfı
        ],
yukarıdakilerin hepsi lang sınıfının çalışması için değil ben hepsini kopyaladım.


Şimdi Middleware de yazdık geldiğimiz nokta: Bir session değerimiz varsa o  session değeri ile sistem dilini değiştiriyoruz yoksa varsayılan olarak Türkçe'yi seçiyoruz.

Peki bu kadar mı?


____________________________________________

Şimdi dil dosyalarının nerede çalıştığına bakalım..

\resources\lang klasoru altında dil dosyalarımız var varsayılan olarak ingilizce geliyor.

mesela ne var içerisinde validation işlemlerinde ki hata mesajları, paginition yönlendirmeleri vs vs.


Aynı şekilde bizde Türkçe için dosyalarımızı oluşturalım lang altında tr diye klasor açalım..
Türkçeyi tr olarak tanımlayacağımız için klasor ismi mutlaka tr olmalı..

ingilizcedeki tüm dosyaları kopyalaıp içeriklerini türkçe yapabiliriz. tr klasorune attıktan sonra

Kendimiz de dosyalar oluşturabiliriz.. Örneğin bir messages diye bir dosya oluşturalım.

en klasoru altına 

<?php

return [
    'welcome' => 'Welcome to our application',
];

?>
tr klasoru içinde
?>

<?php

return [
    'welcome' => 'Uygulamamıza hoşgeldiniz',
];

// şimdi bunu nasıl kullanabiliriz wievde direkt welcome yazdığımızda bu çalışmıyor
?>



örnek view dosyası
____________________________________________

mevcut dil - {{\App::getLocale()}} BU SETLOCELİN TAM TERSİ SETLOCAL DİL DEĞERİNİ DEĞİŞTİRİR BUDA MEVCUT DİLİ GÖSTERİR..yukarıdaki ayarlara göre sisteme girer girmez tr olur.


controllerimizi çalıştıran linkleri şöyle verelim basit mantık ile 


 <a href="/lang/tr"> TR </a>  <a href="lang/en"> EN</a>

  @lang('messages.welcome') //bunda ise eğer türkçe seçili ise uygulammaıza hoş geldiğiniz yazar..

  messages oluşturulan .php dosyasının ismi welcome ise o dosyadarı returnun içerisndeki dizinin ismi.


mesajımızı direkt controllerde göstermek istersek echo __('messages.welcome');


____________________________________________

  --SON 

  yukarıda a hrefler vermiş olduğumuz linke tıklanıcak örneğin www.mybooks.com/lang/tr gibi bir url olacak onunla bir controller çalışıp o sayfaya geri gelecek  ve middlewaremiz de ise o sıra default oalrak dil tr olacak ama artık bir sessionumuz olduğu için o middlewre session içerisindekini setlocale aktaracaak ve wiewde gösterimler buna göre değişecek..
