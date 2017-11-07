Blade, Laravel ile sağlanan basit fakat güçlü şablonlama motorudur. Diğer popüler PHP şablonlu motorların aksine, Blade, görüşlerinizde düz PHP kodunu kullanmanızı sınırlamaz. Aslında, tüm Blade görüntüleri düz PHP kodu halinde derlenir ve değiştirilene kadar önbelleğe alınır, yani Blade uygulamanıza sıfır yük ekler. Blade görünümü dosyaları .blade.php dosya uzantısını kullanır ve genellikle resources / views dizininde saklanır.

<?php 

						--VERİLERİ GÖRÜNTÜLEME--


Route::get('denemesayfa', function () {
    return view('welcome', ['name' => 'ako']);
});						

Merhaba, {{ $name }} // <?php echo"$name"; ? > yerine bunu yazıyoruz


//Halihazırda Tüm geçerli php kodlarını aynı şekilde kullanabiliriz
 tarih:{{ print_r(getdate()) }}


/*Uygulamanızın kullanıcıları tarafından sağlanan içeriği yansıtırken çok dikkatli olun. Kullanıcı tarafından sağlanan verileri görüntülerken XSS saldırılarını önlemek için daima kaçışlı, süslü parantez sözdizimini kullanın.*/

	
						--KONTROL YAPILARI--	

// karmaşık php kodlarından kurtarır.

--İF

@if (5 == 1)
  doğru
@elseif (5 < 1)
    doğru
@else
   hiç biri dorğu değil
@endif

//______________________

//Kolaylık sağlamak için, Blade ayrıca bir @unless yönergesi sunmaktadır:
@unless (Auth::check())
    Giriş yapılmamış.
@endunless
//___________-

--İSEET ve EMPTY
@isset($name)
    // tanımlanmış ve boş değil
@endisset

@empty($name)
    // $name değeri boş..
@endempty
		
//______________


//@auth ve @guest yönergeleri, geçerli kullanıcının kimliği doğrulanmış mı yoksa misafir mi olduğunu hızlı bir şekilde belirlemek için kullanılabilir

@auth
    // kullanıcı
@endauth



@guest
    // misafir
@endguest


//Gerekirse, @auth ve @guest yönergelerini kullanırken denetlenmesi gereken kimlik doğrulama korumasını belirtebilirsiniz


@auth('admin')
    // The user is authenticated...
@endauth

@guest('admin')
    // The user is not authenticated...
@endguest
//__________________________________________



--SWİTCH



@switch('ahmet')

    @case('veli')
      merhaba ako
        @break

    @case('ayşe')
            merhaba zelite
        @break

    @default
        seni tanımıyorum 					//seni tanımıyorum yazar
@endswitch



//________________________________________

-- FOR VE FOREACH KULLANIMI

@for($i=0;$i<5;$i++)

    {{$i}}

@endfor

//___
$isimler=array('ahmet','mehmet','necdet','sezer') 


@foreach($isimler as $isim)

        <p> {{$isim}}</p>

@endforeach
//array içerisi boş olsaydı ve bunu anlamak içinde aşağıdaki gibi yapabiliriz

//___________________
php $isimler=array();



@forelse ($isimler as $isim)
    <li>{{ $isim }}</li>
@empty
    <p>isimlerr listesi boş</p>
@endforelse

//___________________

// döngü yapılırken arada sonlandırma işlemi yapbilirz örneğin..
$isimler=array('ahmet','nejdet','sezer','selçuk') 


@foreach ($isimler as $isim)
  
    <li>{{ $isim }}</li>
        
    @if($isim=='sezer')
        aradığımu buldum= {{$isim}}				//ekrana sezeri kadar yazar sonra if komutu çalışır.
        @break
    @endif
        
@endforeach


//_____________________

//Döngü kullanırken, döngüyü de sonlandırabilir veya geçerli yinelemeyi atlayabilirsiniz:
$isimler=array('ahmet','nejdet','sezer','selçuk')
@foreach ($isimler as $isim)
  
  @continue($isim=='ahmet')//isim aahmet olunca devam et

  <li> {{$isim}} </li>				//ekrana nejdet sezer yazar

  @break($isim=='sezer')//isim sezer olunca dur
        
@endforeach

//_______________________________________________________________________________________________________


												--KISA BİLGİLER--

{{-- Bu yorum HTML de bulunmayacak --}} // HTML YORUM SATIRI


//___
@php
    #KODUNU YAZ		     //PHP TAGI AÇIP KAPATMAK
@endphp

//___

@push('deneme')
    Merhaba  			//push methodu ile bir sınıf gibi bir şey oluşturuyoruz
@endpush

@stack('deneme')		// sayfada bunu yazdığımızda merhaba yazar

//Bu, herhangi bir JavaScript kitaplığı belirlemede özellikle yararlı olabilir

// 


 ?>	