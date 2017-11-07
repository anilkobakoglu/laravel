<?php 
//request özelliğini kullanmak için 'use Illuminate\Http\Request' classını sayfana eklemek zorundasın. NOT: artisanda oluşturulan controllerde bu otomatik yüklenir.

// NEDİR BU REQUEST? örneğin..

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class kullanicilar extends Controller
{
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function uyeler(Request $request)	
    {
        $ad = $request->input('isim');

       
    }
}

// burada yaptığımız işlem bu methoda atanan istekleri (post etmek vs) Request ile bir değişkene atıyoruz burada o değişkenin ismide $request.
//yukarıdaki kodda başka ne yapılmış. Bir form gödnerilmiş ve değerleri $request değişkeninde
//  $request->intput('name') = gönderilen formda inputda name='isim' olanı $ad değişkenine atılmış.

//_______________________________________________________________________________________________________________________________________________________________
?>
											ROTA VERİLERİNİ REQUEST İLE ÇEKME

<?php 


//örnek bir rota 
Route::put('user/{id}', 'UserController@update')->where('id','[0-9]+'); //localhost:user/8 gibi bir url girdiğimizi düşünürsek id=8 olur.

// Bu url yi nasıl controllerda çekerim?

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Update the specified user.
     *
     * @param  Request  $request
     * @param  string  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        echo"$id";
    }
}


//__________________________________________________________________________________________________________________________________________________________________
?>


											REQUEST PATH

<?PHP 

// istek yolu anlamına gelmektedir.

örneğin route::get("/deneme/a/b","deneme@deneme1"); //diye bir rotamız var


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class deneme extends Controller
{
   

   public function deneme1(Request $request){


   	return $request->path(); // path özelliği ile bu yolu çekiyoruz ekrana deneme/a/b yazar.
   }
}

//_______________

// İS methodu ile gelen yolun belirli bir kalıba uygunluğunu test edebiliriz

   	if ($request->is('deneme/*')) {
    
    		echo"ok"; 
}

// bunlar ne işimize yarar?? Projen ilerlediği zaman onlarca router yapıyorsun ve bazı fonksyionların sadece tek urlde çalışmasını istiyorsun örneğin admindeneme gibi bir fonksiyonun var sadece url de şu adres de çalışsın istiyorsun localhost:admindeneme/dene gibi.. bunun için bu özellikleri kullanabilirsin.

//2 diyelim bir rotan var router::get("ako/7/8","a@b"); burada urlenin herhangibisini parametre olarak göndermedim. Fonksiyonda nasıl çekebilirim. 
// $url =$request->path(); özelliği ile çeker istetsem ako/7/8 adresinden ortanca değeri bir takım sorgularla çekerim.




****NOT== Eğer tüm url yi çekmek istersek = $request->url(); kullan bu http://localhost:8000/deneme/a/b/ eşittir.
//__________________________________________________________________________________________________________________________________________________________________
?>

												METHOD TÜRÜNÜ ÇEKME

<?php 

		
			1-$request->method(); // bu controlleri GET,POST; DELETE,PUT ile mi çalıştığını gösterir.

			2-	if ($request->isMethod('get')) { // sorguda kullanım yöntemi
   				

   			echo "get methodu";
}

// DİKKAT eğer $method=$request->method(); if($method=='get')  {echo"get methodu";} gibi bir işlem yapacaksan hata alırsın çünkü $method GET e eşittir get e değil.

// doğrusu şu if($method==='GET')  üç tane eşittir olmalı türü ve içeriği aynı demektir.


//________________________________________________________________________________________________________________________________________________________________
?>		
								***İNUT DEĞERLERİNİ ÇEKME***      (retrieving input)

<?php 

// İnputtan gelen verileri $request ile çekiyoruz. Düz php de örneğin şöyleydi $isim=$_POST['isim']; bu bir açıktır ve böyle kullanılmaması tavsiye edilir.
// peki nasıl çekiyoruz?
// not formları laravel collective paketi ile yapman önerilir.form işlemlerine göz at ;) 
/*

			{{csrf_field()}}
		isim: {{Form::text('isim')}}<br>
		soyisim: {{Form::text('soyisim')}}<br>
		parola: {{Form::password('parola')}}<br>
			{{Form::submit('gonder')}}

			form collectiv paketi yüklendikten sonra çrnek bir form..

*/



$input = $request->all();// post edilen tüm verileri DİZİ halinde çekiyoruz.
$name = $request->input('isim');//istediğimiz inputu çekebiliriz
$name = $request->input('isim', 'Ako');//isim boş gönderildiyse Akoyu isim olarak kabul eder ve atama yapar.

$soyisim=$request->soyisim;
$isim=$request->isim;
$parola=$request->parola;  // böylede erişim sağlanabilir..

										// VERİLERİN BİR KISMINI ALMA


/*sadece istenilen verileri çekme*/ return $request->only(['isim','parola']); /*çıktısı  {"isim":"ako","parola":"9876544"}*/
/*seçilenler dışında hepsini çek*/ return $request->except(['isim','parola']); /*çıktısı {"_token":"IG5vBBw4RxNi0RHLQI7zPN2ffNVttyqt5M5W","soyisim":"akosurnme"}*/

/*NEDİR BU TOKEN ?
		formlar oluştururken zararlı yazılımlar robot yapıp sisteminizin formuna saniyede yüzlerce kayıt vs işlemi yapabilir.. laravel bunun önüne geçmek için token dan yararlanıyor.. yukarıda ki token karakterini kendisi oluşturuyor bu isteği kullanıcı mı program mı yapıyor diye test ediyor..

		Unutma. örneğin gelen tüm verileri kayıt edeceksin hata alırsın çünkü veritabanında _token diye bir alan yok ama formudna var..kayıt yapmadan önce unset yaparak token değerini silmeyi unutma yada farklı alternatifler üret vs

*/
// excepti nerede kullanabilir... 
//diyelim bir e ticaret siten var bir kullanıcının profilini görüntülemek istiyorsun bir form işleminden sonra..return $request->except(['kredikartno']]); gibi..



 if($request->has(['isim']))
 	{
 		echo"var";					//has methodu $request içinde böyle bir değer var mı diye bakar. varsa true döndürür
 	}

$request->has(['isim','soyisim',])// birden fazla değişkende kontrol edilebilir.

$array=array('isim','soyisim');// ve böylede

  if($request->has([$array])){echo"var";} 


  // DİKKAT has methodu boş gelse bile true gönderir.. ture döndürmesi için form içinde o name de bir input olsun

  // boş mu dolumu kontrolü için ?  filled methodu mevcut..

  if($request->filled(['isim'])){
  	echo"dolu";
  }
  
    if(!$request->filled(['isim'])){
  	echo"dolu";
  }
  
  

			
//________________________________________________________________________________________________________________________________________________________________

?>

                                      OLD REQUEST


  <?php 

  /*flash methodu kullanıcının bir sonraki isteğine kadar input bilgilerini o oturum için tutacaktır.*/ $request->flash();

 /* sadece bunlar tutulsun=*/ $request->flashOnly(['isim','soyisim']);

 /*bunlar haricindekiler tutulsun */ $request->flashExcept(['parola']);


 // FORM BİLGİLERİ BAŞKA BİR SAYFAYA YÖNLENDİRME

  return redirect('formpage')->withInput();//tüm verileri o sayfaya atar.

  return redirect('formpage')->withInput($request->except(['parola']));


  //OLD FORM BİLGİLERİNİ ÇEKME

  $soyisim = $request->old('soyisim');
  

  //ÇEKİLEN VERİLERİ İNPUTDA VALUE OLARAK KGÖSTERME

  <input type="text" name="soyisim" value="{{ old('soyisim') }}">



//__________________________________________________________________________________________________________________________________________________________________
?>

DEVAMI VAR.....