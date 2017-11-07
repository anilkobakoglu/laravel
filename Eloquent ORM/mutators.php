Accessors veri tabanında veri okurken, veriye çeşitli müdahaleler ile büyük harf’e veya başka tüm müdahalelerde bulunabiliriz. Mutators ‘da ise bu işlem veritabanına veri kayıt sırasında yer almaktadır, yani gelen tüm veriyi örneğin büyük harf’e çevirebileceğimiz gibi bir çok fonksiyon yardımı ile işlemler yapabiliriz

<?php 

//önek bir controller


$kullanicilar=kullanicilar::all();

$foreach ($kullanicilar as $row) {

	$row->isim;								//böyle yaptığımızda isimler tabloda nasıl kaydedildiyse öyle yazılır. örneğin büyük harfle 
	
}

//çekeceğimiz verilerin görünümü değişrirmek istiyorsak accerssors dan yararlanıyoruz

--Accessors


// örnek bir model sayfasını açalım

namespace App;

use Illuminate\Database\Eloquent\Model;

class kullanicilar extends Model
{
    protected $table='kullanicilar';

    protected $fillable = ['parola'];




    public function getisimAttribute($value) 
    {
        return ucfirst($value);//burada okuma yaparkan ilk hafrleri büyük yapar
    }


    // burada bir çok şey yapabilirz ister ilk harfi küçük istersek büyük yazdırabiliriz.
    return strToUpper($value);//gibi

    // bu özelliği kullandığımızda veritabanında her hangibi değişiklik yapmamış oluruz.


    //kayıt eklerkende mutators mantığını kullanıyoruz

//_______________________________________________________________________
  --Mutators
  



 // örnek model

    public function setisimAttribute($value)
    {


        $this->attributes['isim']=strToUpper($value);	
    }


     kullanicilar::create(['isim'=>'matotors','parola'=>'iki']);// bu işlemi yaptıktan sonra isim harfleri büyük harf olur insert yapınca olmuyor ?




// mesela diyelim ki kullancıılar tablosuna kişi ekleme yaparken parola her zaman md5 ile şifrelensin ve öyle kayıt olunsun


     public function setparolaAttribute($value){

            $this->attributes['parola'] = md5($value);

    }

    //isteğe bağlı olarak sütunlara php komutları ile müdahale edebiliyoruz.
    //örneğin üyeler tablonuzda mail diye sütun var oraya kayıt olurkan mailin tüm harfleri küçük olsun diye komutta bulunabiliriz. gibi..


    
}
