

<?php 

URL ÇEKME YÖNTEMLERİ

echo url()->current(); //Sorgu dizesi olmadan geçerli URL'yi alın ..
echo url()->full();//Sorgu dizesini içeren geçerli URL'yi al ...
echo url()->request();//Önceki istek için tam URL'yi edinin ..

Contrellerin hangi url de çalıştığını bul
$url = action('HomeController@index');//http://localhost:8000/anasayfa





?>