													KİMLİK DOĞRULAMA- authenticaiton


Bu kısımda güvenli kişi ekleme işlemlerinden bahsediliyor.
Varsayılan olarak, Laravel uygulama dizininizde bir App \ User Eloquent modelini içerir. Bu model, varsayılan Güvenli Kimlik Doğrulama Sürücüsü ile kullanılabilir. Uygulamanız Gizli Kullanmıyorsa, Laravel sorgu oluşturucuyu kullanan veritabanı doğrulama sürücüsünü kullanabilirsiniz.

App \ USer modeli için veritabanı şemasını oluştururken, parola sütununun en az 60 karakter uzunluğunda olduğundan emin olun. Varsayılan dize sütun uzunluğunu 255 karakterlik tutmak iyi bir seçim olacaktır.

Ayrıca, kullanıcılarınızın (veya eşdeğeri) tablonuzun null karakterli, dizesi remember_token olan ve 100 karakterlik bir sütun içerdiğini doğrulamanız gerekir. Bu sütun, uygulamanıza giriş yaparken "beni hatırla" seçeneğini belirleyen kullanıcılar için bir simge depolamak için kullanılacaktır.													
							_______________



<?php 

															--GİRİŞ--

// Auth özellikleri controller/auth içerisinde bulunur
//Laravel, basit bir komutla kimlik doğrulama için gereken tüm güzergahları ve görünümleri oluşturmak için hızlı bir yol sağlar:

php artisan make:auth

//Bu komut, yeni uygulamalarda kullanılmalı ve tüm kimlik doğrulama son noktalarının güzergahlarının yanı sıra bir düzen görünümü, kayıt ve oturum açma görünümleri yüklenecektir. Ayrıca giriş sonrası talepleri uygulamanızın ön paneline işlemek için bir App/HomeController üretilecektir.															



--VİEW 

php artisan make:auth //komutu viewde gerekli değişimleri yapacaktır ve bu değişimi Resources/views/auth klasoru altında yapacaktır.Ayrıca Layouts sınıfını da otomatik yükleyecektir bunlar varsayılan olarak dizayn edilmiştir istersen içeriğini değiştirebilirsin.


--Authenticating/kimlik doğrulanıyor

//Dahil olan kimlik doğrulama denetleyicileri için yollar ve görünümler kurulumuna sahip olduğunuza göre, uygulamanız için yeni kullanıcılar kaydetmeye ve kimlik doğrulamaya hazırsınız!

--Path Customization / yol özelleştirme

//Bir kullanıcı başarıyla kimlik doğrulaması yapıldığında, / home URI'sine yönlendirilirler. Kimlik doğrulama sonrası yönlendirme konumunu, LoginController, RegisterController ve ResetPasswordController üzerinde bir redirectTo özelliği tanımlayarak özelleştirebilirsiniz

protected $redirectTo = '/';

--Username Customization / kullanıcı adı  özelleştirme

//Varsayılan olarak, Laravel kimlik doğrulaması için e-posta alanını kullanır. Bunu özelleştirmek isterseniz, LoginController cihazınızda bir kullanıcı adı yöntemi tanımlayabilirsiniz



--Validation / Storage Customization

/*Yeni bir kullanıcı uygulamanıza kaydolurken gereken form alanlarını değiştirmek veya yeni kullanıcıların veritabanınıza nasıl depolandığını özelleştirmek için RegisterController sınıfını değiştirebilirsiniz. Bu sınıf, uygulamanızın yeni kullanıcılarını doğrulamaktan ve oluşturmaktan sorumludur.
RegisterController'ın validator yöntemi, uygulamanın yeni kullanıcıları için geçerlilik kurallarını içerir. Bu yöntemi istediğiniz gibi değiştirmek serbesttir.

RegisterController'ın create yöntemi, Veranda ORM'yi kullanarak veritabanınızda yeni App \ User kayıtları oluşturmaktan sorumludur. Bu yöntem veritabanınızın gereksinimlerine göre değiştirilebilir*/



--Kimliği Doğrulanmış Kullanıcıları Çekme


//kimliği doğrulanmış kullanıcılara.. Auth ile ulaşabilirsin

use Illuminate\Support\Facades\Auth;

///Şu anda kimliği doğrulanmış kullanıcıyı al ...
$user = Auth::user();

// kimiğini al
$id = Auth::id();


//Alternatif olarak, bir kullanıcı kimliği doğrulandıktan sonra kimliği doğrulanmış kullanıcıya bir Illuminate \ Http \ Request örneği aracılığıyla erişebilirsiniz.

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    
    public function update(Request $request)
    {
        // $request->user()  kimliği doğrulanmış kullanıcının bir örneğini döndürür ...

    }
}


//______


  $user = Auth::user(); //ahmet adlı kullanıcı giriş yaptuktan sonra herhangibi bir sınıft abunu yazdırırsak ahmet yazar
   echo $user;

  $id= Auth::id();//yazarsak id sini alırız.(giriş yapmış kullanıcının)



 --Determining If The Current User Is Authenticated
 
 //kullanıcı giriş yapmış mı yapmamış gibi bir kontrol etmek istersek

 use Illuminate\Support\Facades\Auth;


if(Auth::check()){

echo"merhaba";			//kullanıcı girişi yapılmışsa bu kodu yazdığımızda merhaba yazar

}




--Rotaları Koruma // Protecting Routes


//yukarıda yaptığımız gibi işlem yaparak kullanıcı giriş yapmışmı yapmamışmı diye kontrol edebilirz ama bunun daha kolay yolu rotalara yada controllere middleware yönlendirmesi yapmaktır..

Route::get('profile', function () {
    

    // giriş yapmışsa profil linki çalışsın gibi
})->middleware('auth');


public function __construct()
{
    $this->middleware('auth'); //bir kullanıcı giriş yapmışsa bu middleware çalışsın gibi..

}

//
--Giriş Engelleme

//Laravel'in yerleşik LoginController sınıfını kullanıyorsanız, Illuminate \ Foundation \ Auth \ ThrottlesLogins özelliği zaten denetleyicinizde bulunur. Varsayılan olarak, birkaç denemeden sonra doğru kimlik bilgilerini sağlamamaları durumunda kullanıcı bir dakika boyunca giriş yapamaz. Kısma, kullanıcının kullanıcı adı / e-posta adresine ve IP adreslerine özeldir.



--Manually Authenticating Users

//Tabii ki, Laravel'e dahil olan kimlik doğrulama denetçilerini kullanmanız gerekmez. Bu denetleyicileri kaldırmayı seçerseniz, doğrudan Laravel kimlik doğrulama sınıflarını kullanarak kullanıcı kimlik doğrulamasını yönetmeniz gerekir. Endişelenme, bu bir cinch!Laravel'in kimlik doğrulama servislerine Kimlik Doğrulaması yüzünden erişeceğiz, bu nedenle Kimlik Doğrusu'nu sınıfın en üstünde içe aktarmamız gerekecek. Sonra, girişme yöntemini kontrol edelim:

class databasedeneme extends Controller
{
   public function deneme(){

if (Auth::attempt(['email' => '$ahmet@gmail.com', 'password' => 'ahmet987'])) {  //attemtp girişim demek
            // Authentication passed...
            return redirect()->intended('dashboard');		//böyle bir kullanıcı giriş yaptıysa bir şeyler yap
        }
   	 
/*

Deneme yöntemi, bir dizi anahtar / değer çifti ilk argüman olarak kabul eder. Dizideki değerler, kullanıcıyı veritabanı tablosunda bulmak için kullanılacaktır. Böylece, yukarıdaki örnekte, kullanıcı e-posta sütununun değerine göre alınacaktır. Kullanıcı bulunursa, veritabanında saklanan hashed edilmiş şifre, dizi yoluyla yönteme geçirilen şifre değeriyle karşılaştırılacaktır. Veritabanında karma parolayla karşılaştırmadan önce, çerçeve otomatik olarak değeri olan parola değeri olarak belirtilen parolayı karma olmamalıdır. İki hashed parolası eşleşirse, kimliği doğrulanmış bir oturum kullanıcı için başlatılacaktır.

Kimlik doğrulama başarılı olursa, deneme yöntemi true değerini döndürür. Aksi takdirde false döndürülecektir.

Yeniden yönlendirici üzerinde amaçlanan yöntem, kullanıcıyı, kimlik doğrulama katmanı tarafından engellenmeden önce erişmeye çalıştıkları URL'ye yönlendirecektir. Amaçlanmış hedefin mevcut olmadığı durumlarda, bu yöntemde bir geri dönüşüm URI verilebilir.
*/


--Specifying Additional Conditions //ek koşulların belirtilmesi


//İsterseniz, kullanıcının e-posta ve parolasına ek olarak kimlik doğrulama sorgusuna ek koşullar da ekleyebilirsiniz. Örneğin, kullanıcının "etkin" olarak işaretlendiğini doğrulayabiliriz:

if (Auth::attempt(['email' => $email, 'password' => $password, 'active' => 1])) {
    // Böyle bir kullanıcı var
}

//bunlarda email kullanmak zorunda değiliz kullanıcı ismide olabilirdi




 --Accessing Specific Guard Instances

 //Yetkilendirme cephesinde guard yöntemini kullanarak kullanmak istediğiniz korucu örneğini belirtebilirsiniz. Bu, tamamen ayrı yetkili kılınabilir modeller veya kullanıcı tabloları kullanarak uygulamanızın ayrı kısımları için kimlik doğrulamayı yönetmenizi sağlar.Guardda iletilen koruma adı, auth.php yapılandırma dosyanızda yapılandırılan muhafızlardan birine karşılık gelmelidir:

 if (Auth::guard('admin')->attempt($credentials)) {
    //
}



--Logging Out

//Kullanıcıları uygulamanızdan çıkarmak için, Kimlik Doğrulaması bölümünde çıkış yöntemini kullanabilirsiniz. Bu, kullanıcının oturumundaki kimlik doğrulama bilgilerini silecektir:

Auth::logout();



--Remembering Users//kullanıcıları hatırlama

//Uygulamanızda "beni hatırla" işlevselliği sunmak isterseniz, deneme yöntemine ikinci bir argüman olarak bir boolean değeri iletebilirsiniz; bu, kullanıcıyı süresiz olarak kimliği doğrulanmış halde tutacak veya manuel olarak çıkış yapana kadar. Tabii ki, kullanıcılar tablonuz "beni hatırla" simgesini depolamak için kullanılacak remember_token dizesini içermelidir.

if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
    // The user is being remembered...
}




//Laravel ile birlikte gelen yerleşik LoginController kullanıyorsanız, kullanıcıları "hatırlamak" için uygun mantık zaten denetleyicinin kullandığı özellikler tarafından uygulanır.


//__
if (Auth::viaRemember()) {
    //
}
//Kullanıcıları "hatırla" ediyorsanız, kullanıcının "beni hatırla" çerezini kullanarak kimliği doğrulanmış olup olmadığını belirlemek için viaRemember yöntemini kullanabilirsiniz:



					Other Authentication Methods//diğer kimlik doğrulama yöntemleri

-Authenticate A User By ID

//Bir kullanıcıyı kimliğine göre uygulamaya girmek için loginUsingId yöntemini kullanabilirsiniz. Bu yöntem, yalnızca kimliği doğrulanmasını istediğiniz kullanıcının birincil anahtarını kabul eder.

return Auth::loginUsingId(50);//böyle birisi oturum açmış gibi olur




														--HTTP Temel Kimlik Doğrulama--

//HTTP Temel Kimlik Doğrulama, özel "oturum açma" sayfası oluşturmadan uygulamanızın kullanıcılarını doğrulamak için hızlı bir yol sağlar. Başlamak için auth.basic katmanını rotanıza ekleyin. Auth.basic ara katman Laravel çerçevesinde bulunur; dolayısıyla onu tanımlamanıza gerek yoktur

****
Route::get('profile', function () {
    echo"ok";
})->middleware('auth.basic');

//bu middlewareyi kullanırsak eğer profile sayfasına ulaşılmak istenirse ve giriş yapılmamışsa mail ve şifresini girmesi için bir pencere açılır.
//kullanıcı adı olan yer maili temsil eder

// sıkıntı yaşıyorsa

RewriteCond %{HTTP:Authorization} ^(.+)$
RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}] //.htaccess içine bunu ekle







