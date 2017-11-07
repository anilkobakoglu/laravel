<?php 

/*
Laravel Schema cephesi, Laravel'in desteklediği veritabanı sistemlerinin tamamında tablolar oluşturmak ve değiştirmek için veritabanı agnostik desteği sağlar.

Veri tabanına tablolar ekleyip kaldırma işlemini laravelin kendisinde yapma fırsatı sunar*/

//database/migrations klasorudne bulunur..

1-migration oluşturma : php artisan make:migration create_kisiler_table


 /*yöntemi, veritabanınıza yeni tablolar, sütunlar veya dizinler eklemek için kullanılırken, down yöntemi up yöntemi tarafından gerçekleştirilen işlemleri tersine çevirmelidir.*/ 

 //örnek
 public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('airline');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('flights');
    }
}


//Migrationsu aktif hale getirmek çaşıltırmak: php artisan migrate


										--Rolling Back Migrationsu-- (göçleri geri alma)



php artisan migrate:rollback //En son taşıma işlemini geri almak için, geri alma komutunu kullanabilirsiniz. Bu komut, geçişlerin son "toplu işlemi" ni geri taşır; bu, birden fazla taşıma dosyasını içerebilir



php artisan migrate:rollback --step=5  //Geri alma komutuna adım seçeneği sağlayarak sınırlı sayıda taşıma işlemini geri alabilirsiniz. Örneğin, yandaki komut son beş geçişi geri alacaktır:

php artisan migrate:reset//reset komutu, uygulamanızın tüm taşıma işlemlerini geri alır

php artisan migrate:refresh//Migrate: refresh komutu tüm taşıma işlemlerini geri alır ve daha sonra taşıma işlemini yürütecektir. Bu komut etkili bir şekilde tüm veritabanınızı yeniden oluşturur

php artisan migrate:fresh
								//Migrate: fresh komutu, tüm tabloları veritabanından düşürür ve sonra geçiş komutunu çalıştırır
php artisan migrate:fresh --seed






											--TABLO OLUŞTURMA--

/*Yeni bir veritabanı tablosu oluşturmak için, Şema cephesindeki create yöntemini kullanmak gerek. Create yöntemi iki bağımsız değişkeni kabul eder. Birincisi tablonun adıdır, ikincisi ise yeni tabloyu tanımlamak için kullanılabilecek bir Blueprint nesnesi*/


Schema::create('users', function (Blueprint $table) {
    $table->increments('id');
});




	--Tablo / Sütun Varlığını Kontrol Etme

if (Schema::hasTable('users')) {
    //
}

if (Schema::hasColumn('users', 'email')) {
    //
}
--tabloları yenide adlandırma

Schema::rename($uyeler, $kisiler);


--MEvcut Bir tabloyu bırakmak down

Schema::drop('users');

Schema::dropIfExists('users');



											--TABLO SÜTUNLARI--



   			  --SÜTUNLAR

//örneğin

chema::table('users', function (Blueprint $table) {
    $table->string('email');
});



    $table->increments('id');		 ==> birincil anahtar
    $table->char('name', 4);    	 ==> Char eklentisi
    $table->dateTime('created_at');	 ==> Tarih
    $table->integer('votes'); 		 ==>Sayısal değer
    $table->string('email'); 		 ==> strin değer
    $table->string('name', 100); 	 ==> varchar 
    $table->string('name', 100);	 ==> Text
    $table->timestamps(); 			 ==> created_at ve updated_ad sütunlarını otomatik yükler
    $table->rememberToken(); 		 ==>Remember_tokeni VARCHAR (100) NULL olarak ekler.

//daha bir çok farklı sütun var fakat en çok kullanılanlar bunlar daha fazlazı laravel doucamtion..

  --SüTUN ÖZELLİKLERİ


  //örneğin

  Schema::table('users', function (Blueprint $table) {
    $table->string('email')->nullable();    //emaili nullable yapar
});


  	$table->string('email'); ->after('isim') ==> İsimden sonra emaili ekle demek.
	->comment('my comment')					 ==> Sütuna açıklama ekler
  	->default($value)						 ==> Varsayılan bir değer ekler
  	->first() 								 ==> Tabloya ilk olarak bu yerleştirilsin






  									--SÜTUN ÖZELLİKLERİNİ DEĞİŞTİRME--


 //SÜTUNUN BAZI ÖZELLİKLERİ DAH ASONRA DEĞİŞTİRMEK İSTEYEBİLİRİZ

  //örneğin

  	Schema::table('users', function (Blueprint $table) {
    $table->string('name', 50)->change();
});




  										--SİLME ve İSİM DEĞİŞTİRME--

 //Bir sütunun adını değiştirmek için Şema oluşturucusunda Sütunu yeniden adlandırma yöntemini kullanabilirsiniz. Bir sütunun adını değiştirmeden önce, doctrine / dbal bağımlılığını besteci.json dosyanıza eklediğinizden emin olun.


  Schema::table('users', function (Blueprint $table) {
    $table->renameColumn('from', 'to');
});



 Schema::table('users', function (Blueprint $table) {
    $table->dropColumn('votes');
});



								--İNDEXES-


			$table->string('email')->unique(); ==> benzersiz
			
			$table->unique('email');		   ==> mail alanı

			$table->primary('id');			   ==> birincil anahtar
						 





// Migrationları yüklerken base "table or view already exists : 1050 table 'users' already exists" böyle bir hata alırsan aşağıdakini yap.

			//YOLU app/providers
use Illuminate\Support\Facades\Schema;
  public function boot()
    {
        Schema::defaultStringLength(191);
    }
?>