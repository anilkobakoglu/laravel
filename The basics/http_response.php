<?php 

// tüm rota işlemleri kullanıcıya bir yanıt veya denetleyici döndürmelidir

						//STRİNG/ARRAYS

Route::get('/', function () {
    return 'Hello ako';
});


Route::get('/', function () {
    return [1, 2, 3];
});


?>


	BU KONU YARIM BIRAKILMIŞTIR devamı gelecek şimdilik DEVAMI: https://laravel.com/docs/5.5/responses