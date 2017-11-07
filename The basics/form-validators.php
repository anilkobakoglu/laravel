                                        FORM VALİDAtORS

<?php 
/*
Nedir Bu Form VAlidotor? 
Formları bir sayfaya post ettiğimiz de form içeriklerini kontrol eder ve gerekirse kullanıcıya bir dönüt sağlar.

Formdan gelen her veriyi veritabanına kaydedemeyiz bazı istediğimiz kurallar süzgeçinden geçirmek gerek
 */
    

?>

                                    MANUAL VALİDAtORS


    <?php 
    use validator;

 public function uyekaydet(Request $request)
    {
        $validator = Validator::make($request->all(), [     // burada elle validator yapıyoruz.
          
            'isim' => 'required|max:255', // isim Adındaki input boş bırakılmamalı ve karakter sayısı 225 i geçmemeli.
          
            'parola' => 'required', //parola boş bırakılmamalı.

        ]);




        if ($validator->fails()) { //validator fails= bir hata varsa..
           
            return redirect('kaydol') // kaydol php ye git
                        ->withErrors($validator) // hata mesajlarını o sayfaya gönder
                        ->withInput(); // input değerlerini o sayfaya gönder
        }

        
    }


//daha sorna formu gödnerdiğimiz sayfada örneğin..
    {{Form::password('parola')}}
    {{ $errors->first('parola')}} //altına bunu yazıyoruz.. Bunu yazarsak eğer parola boş gönderilirse tekrar bu sayfa açılır ve altında bu hata gözükür.

//___________________________

                                        OTOMATİK HATA SİSTEMİ



 Validator::make($request->all(), [

    'isim' => 'required|max:5', 
                                            //bu işlemle yukarıdaki aynıdır.
    'parola' => 'required',

])->validate();          

  //___________________________


                                        BİR SAYFADA BİRDEN FAZLA FORM VARSA


 //Eğer validatorlerine isim verirsen sıkıntı olmaz. Bunun için yapman gereken tek şey ikinci vir değer girmek.                                     

return redirect('register') ->withErrors($validator, 'login');// 

           
{{ $errors->login->first('email') }} //hata mesajını yayınlarken önüne ismini yazmak yeterli..

//____________________________________-



                                            HATA İLETİLERİ İLE ÇALIŞMA




    public function anasayfa(Request $request){

    $validator= Validator::make($request->all(), [
    'title' => 'required|max:5',
    'body' => 'required',
]);         
        

         $hatalar=$validator->errors(); // errorları $hatalara atıyoruz 
        echo $hatalar->first('title');  // ve içinden title ile ilgili ilk hataı çekiyoruz

//________
         $hatalar=$validator->errors();
        echo $hatalar->first('title','bir hata yapıldı'); // ikinci parametreyi girersek titlede bir hata varsa ekrana bir hata yapıldı yazar



//________

      //hataları dizi halinde çekme


           $errors=$validator->errors();
        foreach ($errors->get('title') as $message) {
            

            return $message;
}
//_____



        //tüm hataları dizi halinde çekme


          $errors=$validator->errors();
        foreach ($errors->all() as $message) {
            
            print_r($message);
}

//__________


        //hata var mı ?

  $errors=$validator->errors();

    if ($errors->has('body')) {
    echo"bir hata var";
}
//_________

                        ÖZEL HATA İLETİLERİ

//Resources/ langs/en/validation dosyasının aç.

 // Custom alanında kendine özel iletiler hazırla örneğin
 


 'custom' => [
        'attribute-name' => [
            'rule-name' => 'giris',
        ],

        'title' => [
            'required' => 'lütfen bu alanı doldur= :attribute',
             'max'=> 'lütfen :max karakteri geçme: :attribute',

        ],
        'mail'=>[
                 'email'  => 'Geçerli bir mail adresi girin= :attribute',
                 'required' => 'lütfen bu alanı doldur :attribute',

        ],
         'body'=>[
                
                 'required' => 'lütfen bu alanı doldur :attribute',

        ],
        'image'=>[
                'image'                => 'Lütfen geçerli bir tür seçin.',
        ],



    ],                    








//_____________________


//validasyonda ne gibi özellikler var sadece required gibi basit işlemler değil.
  **
  ***
   **
      unique:kullanicilar,isim' // örneğin burada kullanıcılar tablosunda böyle bir veri varmı diye kontrol ediyoruz varsa hata veriyor işlem yapmıyor.

      
      // normalde bunu yapmak için inputtaki veriyi alır sonra elle db ye bağlanır for vs ile karşılaştırma yapar if falan filan işte kıymetini bil laravelin ;)




    ?>                              
