

												--ŞİFRELEME--


Laravel'in şifreleyicisi, AES-256 ve AES-128 şifrelemesini sağlamak için OpenSSL'yi kullanıyor. Laravel'in dahili şifreleme imkanlarını kullanmanız ve "evde yetiştirilen" kendi şifreleme algoritmalarınızı kurmaya çalışmamanız kesinlikle önerilir. Laravel'in şifrelenmiş değerlerinin tümü, bir mesaj kimlik doğrulama kodu (MAC) kullanılarak imzalanır, böylece esas değerleri şifrelenir değiştirilemez.

Before using Laravel's encrypter, you must set a key option in your config/app.php configuration file. You should use the php artisan key:generate command to generate this key since this Artisan command will use PHP's secure random bytes generator to build your key. If this value is not properly set, all values encrypted by Laravel will be insecure. 


<?php 
 


 //php artisan key:generate												



--Using The Encrypter


return DB::table('users')->insert([
 	'name'=>'hasan',
 	'email'=>'hasan.05@gmail.com',
 	'password'=>encrypt('hasan987')
 ]);

//_________




$a=bcrypt('merhaba');	// şifreler 
	
echo $a.'<br>';


    