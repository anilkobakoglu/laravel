<?php 
/*veritabanına tablo oluşturmaya, sütun oluşturma gibi işlemlerimizi yapıyor
1- bunun için ilk yapılması gereken terminalden php artisan make:migration create_haberler_table gibi bir migration ekliyoruz

*/



?>
<?php //daha sonra aşağıdaki kod dizimini otomatik olarak geliyor. database\migrations klasörüne

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAkoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ako', function (Blueprint $table) {
            $table->increments('id');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

// tamamlanmış şekli aşağıda



use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAkoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()//yükleme kısmı 
    {
        Schema::create('ako', function (Blueprint $table) {
            $table->increments('id');// artış demek increments bu da tablonun idlerine yazılıyor
            $table->string("no");//string bir sütun oluşturmamıza yazrıyor
            $table->string('name');
            $table->string('slug');
            $table->string('avatar');
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
        Schema::dropIfExists('ako');//çıkış yaptırıyoruz.
    }
}


// bunu yaptıktan sonra terminalden php artisan migrate yazıyoruz ve tablomuz veritabınımıza ekleniyor.

/*örnek terminal migrate işlemleri

migrate:fresh=>tazeliyor yani tablo içeriklerini boşaltıyor.

migrate:refresh=> ne olduğunu bilmiyorum

migrate:status=> hali hazırdaki migrateleri gösteriyor(tablolarını)

migrate:reset=>tüm taşıma işlemlerini geri alır.

migrate:install=>?

migrate=>rollback=>son yapılan işlemi geri alır birden fazla işlemi etkileyebilir
php artisan migrate:rollback --step=5 böyle yaparsan son 5 ini geri alır.


*/
//DİPNOT ÖRNEK TABLO OLUŞTURDUK MİGRATE ETTİKTEN SONRA ORAYA SÜTUN DİREKT EKLEYEMİYORUZ ONUN İÇİN AYRI BİR FONKSİYON YAZMAN GEREK ONUNLA UĞRAŞACAĞINA LOCALHOSTTAN ELLE EKLE ;)



/*
up fonksiyonuna neler yapılabilir?




Schema::rename($from, $to); tablo ismi değiştirir
Schema::table('users', function (Blueprint $table) {   TABLO EKLER
    $table->string('email');
});

sütun değerleri
______________________________

$table->char('name', 4);//char ekliyoruz 4 karakterlik
$table->dateTime('created_at');//data time satırı
$table->integer('votes');//integer değerli
$table->string('email');//string değer
$table->string('name', 100);//sınırlama
$table->text('description');//text
$table->timestamps();// crate_at ve uptadet_at leri otomatik yükler
$table->unique('email');//eşsiz

düzenleyiciler
__________________________________
->after('column')// bu sütundan sonra yerleştir.
->default($value)//sütun için varsayılan bir değer atar
->first()//ilk olarak tabloya yerleştirilir
->nullable()//sütunun boş bırakılmasına null yapılmasına izin verir.
->unique();//eşsiz olmasını sağlar




*/


//daha fazlası için. https://laravel.com/docs/5.5/migrations ADRESİNE BAK


// İNCE AYAR migrate hatası alırsan aşağıdakilerini yap. Yolu app/providers
use Illuminate\Support\Facades\Schema;
  public function boot()
    {
        Schema::defaultStringLength(191);
    }
