<?php 

//Redirect özelliği ile url ve control yönlendirme yapılı.

//basit bir yönlendirme örneği..
Route::get('asd', function () {
    return redirect('admin/ayarlar');//url ye asd yazılırsa url admin/ayarlar olarak değişir ve o sayfaya gider..
});

//bazen url ye bir adres yazıldığında onu, o sayfaya ulaşmasını sağlayan posta, forma form sayfasına geri göndermek istersin..örneğin session gerektiren bir sayfaya ulaşılmak istendi vs..

Route::post('profil', function () { //post ile yapılmalı
   

    return back()->withInput();
});



//Rotasın da neme olan rotalara redirect özelliği ile ulaşabilirsin.

Route::get("admin/","AdminController@get_admin")->name('admin'); // böyle bir rotamız olsun

route::get('git',function(){

	return redirect()->route('admin');// Böylelikle name'i admin olan rotayı çalıştırırız.
});



// Eğer rotanız parametra alıyorsa örneğin..
route::get("ako/{id}",function($id){

return $id;

})->name("ako");// burada rotamız url nin ikinci değerini parametre oalrak alıyor ve ekrana yazıyor.


//

route::get('git',function(){

	return redirect()->route('ako',['id'=>'45']); // böyle yaparak o rotaya gider ve id parametresini 45 olarak yazdırabiliriz.
});//ekrana 45 yazar url ise  http://localhost:8000/ako/45 diye değişiir.


//sREDİRECT İLE CONTROLLER DAN BİR FONKSİYON ÇALIŞTIRMA

route::get('git',function(){

	return redirect()->action('mycontroller@anasayfa');

});//action methodunun içerisini fonksiyonun yolunu belirtiyoruz.


//__________________________________
?>

								URL YÖNLENDİRME 

<?php 

//diyelimki biz kullanıcı denememe yazsa bile deneme sayfasına gitsin istiyoruz.
Route::redirect('/denememe', '/deneme', 301);

//altta da şöyle bir fonkisyonumuz var

Route::any("deneme","mycontrol@deneme");

//conuç olarak ekrana denememe yazsa bile deneme rotası çalışır



//_______________________________


		404  SAYFASINA YÖNLENDİRME

		abort(404);




?>