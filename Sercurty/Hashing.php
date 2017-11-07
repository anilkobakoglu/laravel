karma anlamına geliyor..

Laravel Hash cephe, kullanıcı şifrelerini saklamak için güvenli Bcrypt karma sağlar. Laravel uygulamasına dahil olan yerleşik LoginController ve RegisterController sınıflarını kullanıyorsanız, otomatik olarak Bcrypt'i kayıt ve kimlik denetimi için kullanacaklardır.



use Illuminate\Support\Facades\Hash;

$a=Hash::make('asdşlj');
echo $a;
