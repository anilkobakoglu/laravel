
Veritabanınızda birden çok tablo ve bu tablolari iç içe geçmiş şekilde olabilir, yani bir yorumlar tablosu ve içerisinde yorumu kimin yaptıüına dair açılan 'kullanici_id' sütunu, bu duruma tablolar arası ilişki deniyor, laravelde bu ilişkileri daha kolay ve basit şekilde kontrol edicez.


<?php 
													--ONE TO ONE --

/*
Bire bir ilişkilendirme yapılır.

Örneğin Öğrenciler ve Veliler Tablomuz olsun her öğrencinin bir veli her verlinin bir öğrencisi olduğunu düşünelim.

veiler tablosunda öğrenci_id adında bir alan var id var. Yani biz öğrencinin bilgilerini çekerken velinin ismini de çekebiliriz.


ÖĞRENCİLER															VELİ
____________													______________												
												
id | isim | soyisim											id | isim | telno | ogrenci_id
________________________                               ______________________________________

1 | abc | klm                                              5   | arf  | 5444   | 1 


*/


//controllerde şöyle bir işlem yapıyoruz diyelim


		ogrenciler::get();
//sonuç olarak sadece sadece bir kili gelir ve içeriği 1 abc kim olur bu kontrol ile öğrencir bilgisinden velisine ulaşamadık bunun için...



namespace App;

use Illuminate\Database\Eloquent\Model;

class ogrenci extends Model
{
    protected $table='ogrenci';

  
     public function veliler()

    {

        return $this->hasOne('App\veliler');// Ogrenci_id olaran olması gerek öteki tabloda laravel böyle otomatik algılar eğer veliler tablosunda ogrenci_id değilde başka bir şey yazıyorsa  return $this->hasOne('App\veliler','baskaid yaz');

    }
   	
}


// şimdi tekrar öğrenciler tablosundan velimize ulaşmayı denersek..


   return ogrenci::find(1)->veliler;

//bunu yaptıktan sonra id si bir olan örencinin veliler bilgisini getirecek.


 //velinin herhangi bir bilgisine ulaşmak istersek..

 // mesela Öğrenci_id si 24 olan öğrencinin veli nosu...


 return  ogrenci::find(24)->veliler->telno;



// PEKİ TAM TERSİNİ YAPMAK İSTERSEK YANİ VELİDEN ÖĞRENCİYİ BULMA 

// zaten velile tablosunda öğrencinin id si var... veliler modeline de alttak, gibi düzenliyoruz

namespace App;

use Illuminate\Database\Eloquent\Model;

class veli extends Model
{
    protected $table='veli';

  
     public function ogrenci()

    {

        return $this->belongsTo('App\ogrenci');// Ogrenci_id olaran olması gerek öteki tabloda laravel böyle otomatik algılar eğer veliler tablosunda ogrenci_id değilde başka bir şey yazıyorsa  return $this->hasOne('App\veliler','baskaid yaz');



      => NOT öğrenciler tablosunda ogrenci_id yok ama id var laravar otomatik oalrak tablo ismini önüne getirir ve ogrenc_id olur

    }
   	
}



									--ONE TO MANY--


//Dİyelim yorumlar tablomuz var
//Bir kullanıcı birden fazla yorum yapabilir dolayısı ile yorumlar tablosunda aynı kullanıcı_id sine ait yorum olabilir bunun için ONE TO MANY kullanıyoruz.


// Kullanıcılar modeli


namespace App;

use Illuminate\Database\Eloquent\Model;

class kullanicilar extends Model
{
    protected $table='kullanicilar';

    protected $fillable = ['parola'];



    public function yorumlar(){


    	return $this->hasMany('App\yorumlar'); // yorumları bu modele dail ediyoruz
    }
   	
}



// yorumlar modeli


namespace App;

use Illuminate\Database\Eloquent\Model;

class yorumlar extends Model
{
    protected $table='yorumlar';



    
    public function kullanicilar(){


    	return $this->belongsTo('App\kullanicilar');	// one to many deki olduğu gibi..

    	//hangi yorumun kime ait olduğunu çekmek için kullanıyoruz

    	//NOT eğer yorumlar satırında kullanicilar_id değilde başka bir şey isimle kullanici_id sini tutuyorsa örneğin user_id diyelim bunu belirtmelisin 	return $this->hasMany('App\yorumlar', 'user_id'); gibi


    }
}

//yazdırma işlemi


$yorumlar =yorumlar::all();

foreach ($yorumlar as $yorum) {

		echo $yorum->icerik . ' yorumunu '. $yorum->kullanicilar->isim. ' yapmıştır '.'<br>';
		
}
// bu şekilde yapabiliriz.




?>