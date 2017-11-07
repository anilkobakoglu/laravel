

^^Artisan, Laravel ile birlikte gelen komut satırı arabirimidir. Uygulamanızı oluştururken size yardımcı olabilecek faydalı komutlar sağlar. Mevcut Artisan komutlarının bir listesini görüntülemek için list komutunu kullanabilirsiniz:

--php artisan list


^^Her komutu aynı zamanda, komutun mevcut bağımsız değişkenlerini ve seçeneklerini görüntüleyen ve açıklayan bir "yardım" ekranı da vardır. Bir yardım ekranı görüntülemek için, komutun adından önce yardımla gelmeniz yeterlidir

--php artisan help migrate

VE diğerleri...

Diğer PHP Artisan komutları

php artisan make:controller controller_adi =Yeni Controller Oluşturur
php artisan make:controller controller_adi –resource =Resource parametresiyle index,update,delete gibi methodları hazır şekilde oluşturur.
php artisan route:list = Tüm Yapılan Route İşlemlerini Ayrıntılı Şekilde Listeler.
php artisan make:migration migrate_adi = Migrate için dosya oluşturur.
php artisan make:migration migrate_adi –create=tablo_adi = Migrate için up ve down methodları hazır şekilde oluşturur.
php artisan make:migration migrate_adi –table=tablo_adi = Migrate edilmiş bir tabloya ek tablo eklemeye hazır şekilde oluşturur.
php artisan migrate = Migrate edilmemiş dosyaları migrate eder.
php artisan migrate:reset = Tüm migrate işlemleri iptal eder.
php artisan migrate:rollback = En Son yapılan migrate işlemini iptal eder.
php artisan migrate:refresh = Tüm tabloları silip yeniden migrate eder.
php artisan make:model model_adi = Yeni model oluşturur.
php artisan make:model model_adi -m = Yeni modeli migrate hazır şekilde oluşturur.
php artisan make:request LaravelRequest = Request işlemleri için hazır dosya oluşturur.
php artisan make:auth = Laravel’in sunduğu hazır auth işlemlerini yapar.
php artisan cache:clear = Laravel cache’ni siler.
php artisan session:table = Session’ları veri tabanında tutmak istenildiğinde hazır session migrate oluşturur.
php artisan make:seeder UsersTableSeeder = Yeni Bir Seeder Oluşturur.
php artisan db:seed = Seedleri Çalıştırır.
php artisan db:seed –class=UsersTableSeeder = Veya sadece ilgili seed’i çalıştır.
php artisan migrate:refresh –seed = Migrationlar Seed ile yeniden silip çalıştırır.



Bazı komutlarda tepki alınamaması durumunda
composer dump-autoload
Kullanabiliriz.