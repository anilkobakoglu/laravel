ROUTER
<?php 




//İKİ ANA ROTA YÖNTEMİ




/*1-*/ Route::get('/', function () {
    return view('welcome');
});

/*2-*/ Route::get("/","mycontrol@welcome")


//________________________________________________________________________________________________________________________________________________________?>
															ANY

<?php 

//post, get, delete yada put fark etmeden o fonksiyonu çalıştırır
Route::any("/deneme",function(){


	return view("deneme");
});



Route::any("deneme","mycontrol@welcome");

//________________________________________________________________________________________________________________________________________________________?>



														MATCH

<?php 

//buda any gibi POST yada GET  fark etmeden url deki linki çalıştırır.


Route::match(['get', 'post'], '/deneme', function () {
    return view("deneme");
});


Route::match(['get', 'post','put','delete'], '/deneme', function () {
    return view("deneme");
});


Route::match(['get','post'],'/deneme','mycontrol@deneme');


//________________________________________________________________________________________________________________________________________________________
?>


								URL YÖNLENDİRME 

<?php 

//diyelimki biz kullanıcı denememe yazsa bile deneme sayfasına gitsin istiyoruz.
Route::redirect('/denememe', '/deneme', 301);

//altta da şöyle bir fonkisyonumuz var

Route::any("deneme","mycontrol@deneme");

//conuç olarak ekrana denememe yazsa bile deneme rotası çalışır

?>
//________________________________________________________________________________________________________________________________________________________

							DİREKT SAYFAYA YÖNLENDİRME


		<?php 
		//conrroller yada fonksyion çalıştırmadan bir sayfaya yönlendirme yapmak istemiyorsak bunu kullanabiliriz.


			Route::view('/asdasd', 'anasayfa');


			//değer de gönderilenilir

			Route::view('/welcome', 'welcome', ['name' => 'ako']);

			// {{$name}} şeklinde o sayfada kullanabilir.
			//NOT bunu eğer controllerden veri çekmen gerekiyorsa vs kullanma statik sayfalarda kullanabilirsin.
//________________________________________________________________________________________________________________________________________________________
		?>


				URL DEN PARAMETRE ÇEKME


<?php 

Route::get('anasayfa/{kullanici_id}', function ($id) {
    return 'kullanıcı '.$id;
});

//___


Route::any("anasayfa/{baslik}/deneme/{id}",function($id,$baslik){

return "$id"."<br>"."$baslik";
// http://localhost:8000/anasayfa/1/deneme/9/ urlsi girersek  ekrana  ve 9 yazar

// {} içine - kullanamazız sayfa bulunamaz örneğin{id-5} yerine {id_5} yazmak gerek

});

Route::get("anasayfa/deneme/{id}","mycontrol@deneme");

//denem controllerinde böyle çekilir

public function deneme($id){

	return $id;
}

//________________________________________________________________________________________________________________________________________________________
?>


							DÜZENLİ İFADE KISITLAMALARI

<?PHP 



Route::get('anasayfa/{id}', function ($id) {
    //

    return view("anasayfa");
})->where('id', '[A-Za-z]+');  //id her türlü parametreyi alabilir. ÖZel kadarkterler hariç "'^#" gibi



Route::get('anasayfa/{name}', function ($name) {
    return view("anasayfa");
})->where('name', '[0-9]+'); // sadece sayısal değer alabilir






//______________________________________________________________________________________________________________________________________________________
?>

								ROTA İSİMLERNDİRME

<?php 



Route::get('anasayfa/deneme', function () {
   echo "ako mine zelite"; // bu yöndemler bu rotaya isim veriyorum


})->name('ako');


//yada 
Route::get('anasayfa/deneme', 'mycontroller@deneme')->name('ako'); // böyle


// Örnek bir controller olsun onun içinde ASD fonkisyonu olsun o fonksiyon içine 

	echo route('ako');
    	    return redirect()->route('ako'); //bunu yazarsam...

echo route('ako');//http://localhost:8000/anasayfa/deneme demektir.
 return redirect()->route('ako');// buda o namedeki rotayı çalıştırır. Redirect zaten yönlendirme demek

?>
//______________________________________________________________________________________________________________________________________________________


										GRUPLAMA 


PREFİX

<?php 
Route::prefix('admin')->group(function () {
    Route::get('anıl', function () {
       echo"anıl";
    });

    Route::get('ako',function(){
		echo"ako";

    });
});
//DAHA FAZLASI MİDDLEWARE KONUSUNDA...takipte kal ;)





//______________________________________________________________________________________________________________________________________________________

						
?>
									MODEL BAĞLAMA	

<?php

//***süper bir özellik kullan***S


Route::get('/users/{user}', function (App\User $user) {

    return $user->name;
}); // direkt modeli çağırıyoruz içinde id si eşleşen varsa ismini veriyor aksi halde 404 sayfası..	




?>

