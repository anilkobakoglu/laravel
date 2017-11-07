

<?php														DATABASE İŞLEMLERİNE GİRİŞ



//SQL SORGULARINI ÇALIŞTIRMA

SELECT

$users=DB::select('select * from kullanicilar');//tüm üyeleri çeker
$users = DB::select('select * from users where active = ?', [1]);
$results = DB::select('select * from users where id = :id', ['id' => 1]);//where kullanımı injection açığını kapar

foreach ($users as $user) {
    echo $user->name;  //tablonun isminden direk içeriği çekebiliyoruz
}


//________________________________________________________________________________________________


İNSERT

  	DB::insert('insert into kullanicilar (isim,parola) values (?,?)',['ahmet','ahmet987654']);//________________________________________________________________________________________________


UPDATE 

  DB::update("update kullanicilar set isim = 'ahmet' where isim = ?", ['mehmet']);
//________________________________________________________________________________________________

DELETE   


DB::delete('delete from kullanicilar where isim=?',['ahmet'] );

DB::statement('drop table users');
//________________________________________________________________________________________________








?>