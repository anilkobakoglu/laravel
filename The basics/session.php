																	SESSİON

<?php 
/*SEssion oluşturma */ session(['kullanici_adi'=>$isim]);  /*yada */  session(['key' => 'value']);

/* session içeriğine ulaşma alttaki ile farkı yok*/ session('kullanici_adi')

/* Session içeriğine ulaşma */ $request->session()->get('kullanici_adi');

/* Aradığın session içeriği boşsa yoksa şununla değiştir */ $request->session()->get('kullanici_id', 'ako');

/* Session tüm değerleri */ $request->session()->all();


/*sessionun olup olmadığını kontrol etme*/if ($request->session()->has('uye_id')) {  }


/* put metodu oturumunuzda yeni bilgi parçaları saklar*/ $request->session()->put('key', 'value');

/* Oturum Dizi Değerlerine Ekleme Yapmak*/ $request->session()->push('user.teams', 'developers');

/*forget metodu oturumdaki bilgiden bazı kısımlarını siler. Oturumdan tüm bilgileri silmek isterseniz flush metodunu kullanabilirsiniz:*/

/* sessiondan bazı şeyleri silme */ $request->session()->forget('key');
 
/*session silme (destory ;)*/ $request->session()->flush();


   





?>