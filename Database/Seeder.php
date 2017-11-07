<?php 

/*
Veritabanına örnek kayıtlar eklemiz için laravelin bize sunmuş olduğu kolay bir yöntemdir.
Database/seed klasoru altında Seedlerimizi oluşturuyoruz. Varsayılan olarak DatabaseSeeder sayfamız bulunmakta içerisine call methodu ile yeni Seedler oluşturuyoruz ve ardından artisan ile kendi seedimiz oluşuyor Seedimizi isimlendirirken UsersTableSeeder tarzı isimlendirme yaparak en azından bu sınıfın ne olduğu hakkında ipucu vermiş oluyoruz.

*/



//1
//DATABASE/SEED KLASORU ALTINDA DEFAULT OLARAK GELEN SEEDER DatabaseSeeder.php içeriği..




use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class); //Call methodu ile bir Seed sınıfı oluşturuyor.

    }
}

//__________


//2

//daha sonra artisanımızda php artisan make:seeder UsersTableSeeder yazıyoruz ve bize sınıfımızı oluşturuyor...

use Illuminate\Database\Seeder;

use App\User;//sublime text gibi editör kullanıyorsanız bu sınıfı kendiniz eklemeniz gerek(tavsiyem phpstrom)

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
           //Run methodu içerisine basit bir ekleme işi yaptım bunların veritabanına kayıt olmasını istersem artisan da aktif hale getirmem gerek..
    	User::create([
    		'name'=>'ako',
    		'email' =>'ako@gmail.com',			
    		'password' =>'987654sda'

    	]);

    }
}

//3

// php martisan db:seed  komutu ile Seederımız çalışıyor.



// yeni Seeder eklemek istersel DatabaseSeeder içiine call methodu ile yukarıdaki gibi yeni Seederler oluşturulabilir.


//Örnek bir tane daha seed oluşturma

//DatabaseSeeder.php içine 
  $this->call(kullanicilarTableSeeder::class); //bunu yazdım 

 //daha sonra artisana  = php artisan make:seeder kullanicilarTableSeeder komutunu yazdım

  //kullanciilarTable Seeder classım oluştu içine..

  DB::table('kullanicilar')->insert(['isim'=>'sebep','parola'=>'neden']); // bunu yazdım ve artisanda tekrar seedimi aktif hale getirdikten sonra veritabanıma kayıt yapmış oldum..



/*


php artisan db:seed = Seedleri Çalıştırır.
php artisan db:seed –class=UserTableSeeder = Veya sadece ilgili seed’i çalıştır.
php artisan migrate:refresh –seed = Migrationlar Seed ile yeniden silip çalıştırır.
php artisan migrate –seed = Veya migrate ederken seed işlemi yapar.*/


//FAKE HESAPLAREKLEMEK İÇİN 

//ÖRneğin bunu USersTableSeederin içine yazdım ve bana 50 kişi ekledi kendilinden.

//mesela birsinin ismi Patsy Lebsack :)
//bununla veritabanınızı test edebilirsiniz vs vs
factory(App\User::class, 50)->create()->each(function ($u) {
        $u->posts()->save(factory(App\Post::class)->make());
    });



 ?>

