
												ELOQUENT

 Her veritabanı tablosuna karşılık gelen “Model”, tabloyla etkileşim için kullanılır. Modeller tablolarınızda veriler için sorgular yapmanızı, yeni kayıtlar gitmenizi sağlar. Başlamadan önce veritabanı bağlantınızı config/database.php dosyasında yapılandırın.

<?php 


//Artisandan model oluşturmak içi= php artisan make:model User

// eğer Mİgrasyon ile bieraer oluşturulsun istiyorsan= php artisan make:model User --migration

//modeller App klasoru altında migrationlar ise database/migration klasorunde bulunur.


												--Sıradışı Model Konvansiyonları--


//örnek model sınıfı




namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelDeneme extends Model
{
    
     protected $table = 'kullanicilar'; // Tablo değişkenini protected değişkeni olarak yazmalıyız. 
     									//$table den başka tablo belitilemez
     									// bu ikisi standart kuraldır daha sonra tablonun ismini yazıyorsun.
     									//not- protectedin anlamı sadece bu sınıf ve extend edilen sınıfta çalışır demek.

}


///_____________


--PRİMARY KEY

/* Tabloyu oluştururken tabloya otomatik olaran id ekleni ve primary otomatik artışlı integer bir sütun olarak atanır.
	
Artan olmayan veya sayısal olmayan birincil anahtarı kullanmak istiyorsanız, modelinizdeki public $ incrementing özelliğini false olarak ayarlamalısınız.

 */ 

--TİMESTAMPS


//Varsayılan olarak, Eloquent, created_at ve updated_at sütunlarının tablolarınızda bulunmasını bekler. Bu sütunların Eloquent tarafından otomatik olarak yönetilmesini istemiyorsanız, modelinizdeki $ timestamps özelliğini false olarak ayarlayın.
//false olarak ayarlamadığınızda otomatik olarak tablonuzda bu iki sütunda mevcut olacaktır,istemezsen aşağıdakini yap.

 public $timestamps = false;
 protected $dateFormat = 'U'; //tarihi farklı gösterme yolu diğer yolları bilmiyorum.


 //Eğer create_at ve update_at isimlerini değiştirmek istersen 
 const CREATED_AT = 'creation_date';
 const UPDATED_AT = 'last_update';			//bu global değişkenlerin ismini böyle değiştirebilirsin.


 												--Retrieving Models--


 //Modelinizi oluşturup TAblonuzu da oluşturdukran sonra verilerinize kolay bir şekilde erişebilirsiniz.




use App\ModelDeneme;
class databasedeneme extends Controller
{
   public function deneme(){





   				$kisiler=\App\ModelDeneme::all();

   				foreach($kisiler as $kisi){

   						echo $kisi->isim ;
   				}

}


//daha fazla koşul ekleme 


$flights = App\Flight::where('active', 1)			//birçok benzeri örnek
               ->orderBy('name', 'desc')
               ->take(10)
               ->get()


//____________________________________________
               					--Retrieving Single Models / Aggregates--

 
 /*
Elbette, belirli bir tablonun tüm kayıtlarını almakla kalmayıp, bulma veya ilk kullanarak tek kayıtları da alabilirsiniz. Bir model koleksiyonu döndürmek yerine, bu yöntemler tek bir örnek örneği döndürür:
 */    

 $isimler= \App\ModelDeneme::find(1);	//id si 1 olanı ekrana yazar
echo $isimler;
//___

//koşulda ekleyebiliyoruz tabiki..
$isimler= \App\ModelDeneme::where('isim','ako')->find(1); // bu kısıtlamalara eşit olan ilk sorguyu al
echo $isimler;
//__

//koşula uyan daha fazla Sonuç çekmek mümkün


$isimler= \App\ModelDeneme::where('isim','like','a%')->find([1,2,3,4,5]);  //ismi a ile başlayan ilk 5 kişi

echo $isimler;		
          					
//__

--Not Found Exception 

//bazen bşr model bulunamazsa bir istisna atmak isteyebilirsiniz. Sonuç bulunamazsa Illuminate\Database\Eloquent\ModelNotFoundException bu sınıf çalışır.


$isimler= \App\ModelDeneme::findOrFail(1); //yukarıdaki ile aynı şeyi yapıyoruz aslında sadece ek olarak OrFaili ekliyoruz sonuna

echo $isimler;

$model = \App\ModelDeneme::where('isim', 'ako')->firstOrFail();

echo $model;		//sınıf bulunamazsa böyle bir sınıf yoktur gibi bir hata alıyorsun



--Kümeleri alma-Retrieving Aggregates



$count = \App\ModelDeneme::where('isim', 'like','a%')->count(); //ekrana 5 yazar
echo $count;

$enuzun = \App\ModelDeneme::where('isim', 'like','a%')->max('parola'); //ismi a ile başlayıp parolası en uzun olanı gösterir
echo $enuzun;


									--Inserting & Updating Models--

--İNSERT--

//Veritabanında yeni bir kayıt oluşturmak için, yeni bir model örneği oluşturmanız, model üzerinde öznitelikler ayarlamanız ve ardından kaydetme yöntemini çağırmanız yeterlidir

	$ekle=new ModelDeneme; //Modelimizi ekle değişkenine atıyoruz

   		$ekle->isim='deneme'; //isin sütununa bir değer atadık
   		$ekle->save();//en sonda da bu işlemleri kaydettik ve verimiz eklendi.


   		//create_At ve update_at sütunları otomatik olarak doldurlur.


   
   --UPDATE--
   /*
Kaydetme yöntemi, veritabanında önceden var olan modelleri güncellemek için de kullanılabilir. Bir modeli güncellemek için modeli güncellemeniz, güncellemek istediğiniz özellikleri ayarlamanız ve ardından kaydetme yöntemini aramanız gerekir. Yine, updated_at zaman damgası otomatik olarak güncellenir, bu nedenle elle değerini ayarlamanıza gerek yoktur*/		

//örneğin 5.kişinin ismini bes yapalım

$guncelle= \App\ModelDeneme::find('5');

   			$guncelle->isim='bes';
   			$guncelle->save();



	return 	\App\ModelDeneme::where('isim','fatma')->update(['isim'=>'esra']); //bir diğer güncelleme örneği




--KİTLE ATAMA--


/*
Bir kullanıcı, beklenmedik bir HTTP parametresini bir istekte ilettiğinde ve bu parametre, beklemediğiniz bir veritabanında bir sütunu değiştirdiğinde, bir toplu iş güvenlik açığı oluşur. Örneğin, kötü niyetli bir kullanıcı bir HTTP isteği aracılığıyla bir is_admin parametresi gönderebilir; bu HTTP isteği, daha sonra modelinizin oluşturma yöntemine geçirilerek kullanıcının kendisini bir yönetici olarak tırmandırmasına olanak tanır.

Bu nedenle, başlamak için toplu atanabilir hale getirmek istediğiniz model özelliklerini tanımlamalısınız. Bunu modelin $ fillable özelliğini kullanarak yapabilirsiniz.*/


//ksıaca nerelere ekle yapılabilceğini seçiyoruz

// Fillable ile sütunları belirlediğimiz taktirde, create özelliğini kullanabiliyoruz.. örneği inceleyelim

class ModelDeneme extends Model
{
    protected $table='kullanicilar';		 //benim model classım böyle diyelim..

    protected $fillable = ['isim'];			//fillable isim yapıyorum buda "bu sütunun içeriği değiştirilebilir" anlamına geliyor



}

//controllerde ki işlemim:

 return  \App\ModelDeneme::create(['isim' => 'asd']); //isim sütununa asd yazarak yeni bir kişi ekler.
  return  \App\ModelDeneme::create(['parola' => 'asd']);//eğer parolaya bir değer eklemek istersem hata alırım çünkğ ona dokunulmaasına izin vermedim

//bunun için her ikisini de değiştirmek istersem

  protected $fillable = ['isim','parola']; //dizi içerisine ekleme yapıyorum



--Guarding Attributes- Kitleleri koruma


//fillablenin tersi mantığı ile çalışır. Bunda dolduralan dizi haricindeki tm sütunlara create işlemi yapabilirsin demektir.


  protected $guarded = ['parola']; //bunu yaptıktan sonra


    return  \App\ModelDeneme::create(['parola' => 'asd']); //bunu yaparsak hata alırız buna dokunamazsın dedik ;

    //eğer daha fazla dokunulmasını istemediğin sütun olursa dizi halinde yazabilirsin..




    										--Deleting --



   $sil= \App\ModelDeneme::find(15);
   $sil->delete();


//Deleting Models By Query
return \App\modelsil::where('id','2')->delete();



											--SOFT DELETİNG--

//bazen silinen verileninizin geriye gelmesini istersiniz eğer direkt silme işlemi yaparsan silinen veriyi geri alamazsın bunun için, eskiden tablolarda silindi gibi bir sütn oluşturulup içine 0 yada 1 yazarak varsayılan değer atardık sildikten sonra 1 olurdu mesela sonra onu tekrar geri alabilirdik fakat laravelle bu olay çok daha kolay hale getrilimiş/

//Öncelikle Model sınıfımızı düzenleyelim örnek bir model sınıfı.


namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;//bu sınıfı elle ekliyoruz(sublime text gibi editör kullanıyorsan)

class delete extends Model
{
	 use SoftDeletes;		//daha sonra bunu ekliyoruz
    
	protected $table = 'deneme';
	
	 protected $dates = ['deleted_at']; // silme işlemlerinde bu sütun otomatik olarak tarih atayacak

}




//2. olarak eğer tablomuzun modelimizin migratesi varsa...


 $table->softDeletes(); // silinen verilerin tarihini tutması için bir column oluşturuyoruz.




 // controllerde sıradan bir silme işlemi yapalarım

 return \App\DenemeModel::where('id','5')->delete()

 //şimdi bu işlemi yaptıktan sonra tablomuzdaki deleted_at sütununda silinme tarihi yazacak..


 //bu işlemden sonra kullanıcıları görüntüleyelim


return \app\DenemeModel()->all(); //böyle görüntülersek silinen veriler gözükmeyecek


return  \App\delete::withTrashed()->get(); //withTrashed methodunu kullanarak çekersek silinen ve silinmeyelenler hepsi gözükür

return  \App\delete::onlyTrashed()->get();//onlyTrashed yaparsak sadece silinenler gözükür.


return  \App\delete::where('isim','ako')->onlyTrashed()->get();//koşul ekleyebiliriz

Silinmiş Öğeleri Geri Kazanmak


return  \App\delete::withTrashed()->restore();

return  \App\delete::where('isim','ali')->withTrashed()->restore(); //istediğini geri getirebilirsin



İlla bu veriyi silmek istiyorum Dİyorsan


   	return  \App\delete::where('isim','ali')->forceDelete(); // forceDelete ile toptan silersin geride gelmez :)



 								--EVENTS--
 								
 	Bu konuya daha sonra değinilecek..  	

 ?>