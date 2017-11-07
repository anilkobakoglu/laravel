

Yaptığımız orm işlemlerinde bazı methodlar kullanırız

<?php 
$users = App\User::where('active', 1)->get(); //örneğin burada get yardımı ile hepsini çekiyoruz


//yaklaşık 100 tane olan bu methodalara Digging Deeper klasoru altında değinilecek