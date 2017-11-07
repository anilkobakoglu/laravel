

Gmail mail gönderme...

ilk önce aşağıdaki ayarları yapmak gerekir.

.env ayarları

MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME= buraya kendi email adresi yazılacak
MAIL_PASSWORD= o mail adresin şifresi
MAIL_ENCRYPTION=tls

____
daha sonra confi\mail ayarları

yorum satırları silik hali

aynısını kopyala yapıştır.

<?php

return [

  
    'driver' => env('MAIL_DRIVER', 'smtp'),

    'host' => env('MAIL_HOST', 'smtp.mailgun.org'),

    'port' => env('MAIL_PORT', 587),

    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'example@gmail.com'),
        'name' => env('MAIL_FROM_NAME', 'Example'),
    ],

    'encryption' => env('MAIL_ENCRYPTION', 'tls'),

    'username' => env('MAIL_USERNAME'),

    'password' => env('MAIL_PASSWORD'),

    'sendmail' => '/usr/sbin/sendmail -bs',

   
'stream' => [
   'ssl' => [
       'allow_self_signed' => true,
       'verify_peer' => false,
       'verify_peer_name' => false,
   ],
],
    'pretend'=>false,

    'markdown' => [
        'theme' => 'default',

        'paths' => [
            resource_path('views/vendor/mail'),
        ],
    ],

];


?>


daha yapacağımız mail için bir controller oluşturmak olsun.

php artisan make:controller mailController

<?php 

// bu sınıfı çalıştıracak rota

router::get('send','mailController@send');



//daha sonra sınıfımızı olşutralım

class mailController extends Controller
{
    
public function send(){


Mail::send('mail',['icerik'=>'hosgeldiniz'],function($message){ 

    	$message->to('alici@gmail.com')->subject('Test email');
    	
    	$message->from('gonderen@gmail.com', 'AKO');
    });

echo 'mailiniz başarılı şekilde gönderilmiştir';
return header('Refresh: 2; url=/');

}
    
}

?>

mail::Send= mail göndermek için kullandığımız sınıf ve method..


'mail' = olarak yazılan kısım gönderilecek malin viewi onu birazdan oluşturcaz.. mail.blade.php diye

['icerik'=>'hoşgelndiniz'] = burada o sayfaya değişken gönderebiliyoruz.. sonra o sayfada {{$icerik}} olarak çekicez

$message = fonsiyonun değeri onun içeriside mail gönderme işlemi yapıyoruz

$message->to = maili kime göndereceksin

->subjeckt = mail başlık

$message->from(); = kimin gönderdiği.. bunu kullanmak zorunda değilsin

_________________________________________

daha sonra vievimizi oluşturalım

resource\view klasoru altında

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>BLOGKAFEM.NET</title> 
    </head>
<body>
<p>

	İlk mail GÖnderme denemem

{{$icerik}}</p> 

buraua birşeyler yaz falan

</body>
</html>


_________________________________________

localhost:8000/send  yazdığımızda mail gönderme işlemi gerçekleşecek


