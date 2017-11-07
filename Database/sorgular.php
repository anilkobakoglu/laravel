İLK OLARAK use Illuminate\Support\Facades\DB; sınıfını çağır

<?php 

			FİRST


//veri tabanı tablonuzdan tek bir satırı almak isterseniz..

			$kisi=DB::table('kullanicilar')->where('isim', 'anıl')->first();
   			echo $kisi->isim;
//______________
   			VALUES
//bir satırın tamamına değilde bir değerine ulaşmak istersen


   		$parola = DB::table('kullanicilar')->where('isim', 'anıl')->value('parola');
   		echo"$parola";

//_______________

   			PLUCK
   		//istediğimi< satırın içeriklerini çekme

   		$basliklar = DB::table('kullanicilar')->pluck('parola');

   		foreach ($basliklar as $baslik) {
   			

   					echo $baslik.'<br>';

   		}


//_______________
   			PLUCK 2

   			//birden fazla başlık çekip içerisinden istediğimizi seçebiliriz
   			$basliklar = DB::table('kullanicilar')->pluck('parola','isim');

   		foreach ($basliklar as $baslik=>$isim) {
   			

   					echo $baslik.'<br>';

   		}


//_________________
   		COUNT 

   			return DB::table('kullanicilar')->count();

//_______________ 		

     MAX_MİN

     return DB::table('kullanicilar')->max('created_at'); return DB::table('kullanicilar')->min('created_at');

 //________________
 			 	 
 			 	 					--SELECT--


$isimler=  DB::table('kullanicilar')->select('isim')->get();//istediğimi< stunları böyle çekiyoruz



--WHERE--



return DB::table('kullanicilar')->where('isim','ako')->get();//ismi ako olanın tğm verilerini çek

//bununla bir farkı yok return DB::table('kullanicilar')->where('isim','=',ako')->get()

$kisi=DB::table('kullanicilar')
                ->where('isim', 'like', 'ak%') //nasıl karşılaştırma yapmak istediğimiz şeyi ortaya yazıyoruz
                ->get();

dd($kisi);

//__

$users = DB::table('users')
                ->where('votes', '>=', 100)
                ->get();



//__birden fazla karşılaştırma kullanacaksak

$kisi=DB::table('kullanicilar')
                ->where(
                	[['isim', 'like', 'ak%'],['parola','zelite']])
                ->get();

dd($kisi);

//____or where

$kisi=DB::table('kullanicilar')->where('isim','asd')->orWhere('isim','ahmet')->get(); //ismi asd yada ahmet olanı çek


//__Beetween kullanımı 


$kisi=DB::table('kullanicilar')->whereBetween('id',[0,5])->get();

dd($kisi);



//_____whereNotBetween



 $kisi=DB::table('kullanicilar')->whereNotBetween('id',[0,5])->get();

dd($kisi);

 //____  İn kullanımı
 

 $kisi= DB::table('kullanicilar')
                    ->whereIn('id', [1, 4, 26])//idlerden 1 4 26 olanları getirir
                    ->get();

dd($kisi);
                 

//_____ Not in 

 $kisi= DB::table('kullanicilar')
                    ->whereNotIn('id', [1, 4, 26])//idlerden 1 4 26 olanları getirir
                    ->get();

dd($kisi);



// Null Kullanımı 


$kisi= DB::table('kullanicilar')
                    ->whereNull('id')  // id si boş olanı çeker
                    ->get();


// Not null 


 $kisi= DB::table('kullanicilar')
                    ->whereNotNull('updated_at') // dolu olanı çeker
                    ->get();

dd($kisi);


// TARİhlerle arama yapma



// where date


$kisi= DB::table('kullanicilar')
                    ->whereDate('created_at','2017-10-22')
                    ->get();

dd($kisi);


// where month 

$kisi= DB::table('kullanicilar')
                    ->whereMonth('created_at','10') //10. ayda oluşturulanlar
                    ->get();

dd($kisi);
// Day ve Year aynı mont yerine bunları yaz



// Sütunlar bir birine eşitmi COLUMN



$kisi=  DB::table('kullanicilar')
                ->whereColumn('isim', 'parola')//ismi parolasına eşitmi denek
                ->get();

dd($kisi);
//__
$users = DB::table('users')
                ->whereColumn('updated_at', '>', 'created_at')
                ->get();
//__

$users = DB::table('users')
                ->whereColumn([
                    ['first_name', '=', 'last_name'],
                    ['updated_at', '>', 'created_at']
                ])->get();



//__Kapsamlı sorgular

select * from kullanicilar where isim=akso or(isim=ako and parola=zelite); gibi sorguları aşağıdaki gibi yapıyoruz

$kisi=  DB::table('kullanicilar')
                ->where('isim','akso')->orWhere(function($query){

                		$query->where('isim','ako')->orWhere('parola','zelite');
                		


                })->get();
dd($kisi);

//bir tane daha buna örnek

$kisi=DB::table('kullanicilar')->select('isim')->where('isim','mousasow')
	->orWhere(function($query){
		$query->whereIn('id',[4,6,31])->orWhere('parola','kobakoglu');

			
})->get();


	//____________eğer bu tarz sorgularda değilken kullancaksak böyle yapmak gere örneğin





	
$asd="merhaba";

$kisi=  DB::table('kullanicilar')
                ->where('isim','akso')->orWhere(function($query) use ($asd){

                		$query->where('isim',$asd)->orWhere('parola','zelite');
                		


                })->get();
dd($kisi);	

    }

}




//_____________

Desc ve ASc

$kisi= DB::table('kullanicilar')->select('isim')->orderBy('isim','asc')->get();
$kisi= DB::table('kullanicilar')->select('isim')->orderBy('isim','desc')->get();	



// LATEST VE OLDEST


$kisi= DB::table('kullanicilar')->select('created_at')->latest()->first(); // tarihe göre en son kişiyi gösterir mesela son verilen sipariş vs vs bununla yapılabilir.
$kisi= DB::table('kullanicilar')->select('created_at')->oldest()->first(); // ilk

$kisi= DB::table('kullanicilar')->select('created_at')->latest()->get();//tarihi en uzaktan en yakından en uzağa göre sıralar yani en büyükten en küçüğe


 //RASTEGELE ÇEKME


 $kisi= DB::table('kullanicilar')->select('isim')->inRandomOrder()->first(); //rastgele bir isim çeker get yaparsan rastlege sıralar da çeker


 //LİMİT

 $kisi= DB::table('kullanicilar')->select('isim')->limit(5)->get();




//_______________________________________________________________

 															--İNSERT--

 DB::table('kullanicilar')->insert(['isim'=>'sebep','parola'=>'neden']);//eklenecekler dizi halinde eklenir
 
 //Birden fazla kişi ekleme


 DB::table('kullanicilar')->insert([['isim'=>'ali','parola'=>'neden'],
									['isim'=>'semih','parola'=>'neden']	
								   ]);															




//_________________________________________________________

 													--UPDATE--


 
 	DB::table('kullanicilar')->where('isim','veli')->update(['isim'=>'veli','parola'=>'sifreasdas']);//dizi halinde değiştirmelerr yapabiliyoruz.


 //İNCREMENT VE DECREMENT


//İNCREMENT ARTIRMA İŞLEMİ YAPAR 
DB::table('kullanicilar')->where('id','26')->increment('id');// İD Sİ 26 olanı bir arttırır

DB::table('kullanicilar')->where('id','27')->increment('id',8);
DB::table('kullanicilar')->where('id','35')->decrement('id',9);// 9 azaltır

//___________________________________________________________

													--DELETE--



DB::table('kullanicilar')->delete();//tablonun içini siler

DB::table('kullaniclar')->where('id', '>', 100)->delete();	//id si 100 den büyük olanı siler






//_________________


UNİONS 


$first = DB::table('users')
            ->whereNull('first_name');

$users = DB::table('users')
            ->whereNull('last_name')
            ->union($first)
            ->get();

 ?>