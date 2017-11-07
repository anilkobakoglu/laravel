


<?php 

												PAGİNATİON

//sayfalandırma işlemi yapar.. Veritabanından çekeceğiniz verileri sayfa sayfa ayırır.


$users = DB::table('kullanicilar')->paginate(5);

        return view('databasedeneme', compact('users')); // kullaniciları 5'er 5'er dabasasedeneme.blade.php ye atar
    }

// o sayfada da kullanıcıları öyle çekmek için.
      @foreach ($users as $user)
        {{ $user->isim }}        //böyle çekebiliri<
    @endforeach
		{{$users}}//bunu yazmayı unutma

//_________
SİMPLE PANİNATİON 


$users = DB::table('users')->simplePaginate(15);// o sayfada kullanıcıları gösteriminde fark var sadece

//___________

$users = Uyeler::paginate(5); // böyle de aynı işlemi yapabiliriz

//_______________

where de kullanabiliriz

$users = KaydolModel::where('isim','like','a%')->paginate(5);


//_____________

http://localhost:8000/kisiler?page=2 //link böyle gözükür

http://localhost:8000/kisigoster/url?page=1 bu tarz url yapmak istersen  
$users->withPath('kisigoster/url');bunu kullan


// TÜM PAGİNATE METHOTLARI


$results->count() // o sayfadaki spaginate sayısını verir
$results->currentPage()//kaçıncı sayfada olduğunu gösterir
$results->firstItem()//sayfanın başındaki ilk değerin kaçıncı sırada olduğunu gösterir
$results->hasMorePages()//diuelim paginate değeri 5, eğer o sayfada 5 tane varsa 1 döndürür.
$results->lastItem()// o sayfaya kadar toplam kaç kişi olduğunu gösterir
$results->lastPage() (Not available when using simplePaginate)//toplam sayfa sayınısnı verir
$results->nextPageUrl()//bir sonraki sayfanın urlsi
$results->perPage()//pagination değerini verir
$results->previousPageUrl()// önceki sayfanın urlsi
$results->total() (Not available when using simplePaginate) // paginatteki toplam kişiyi verir
$results->url($page)//bilmiyorum



Örnek kullanım blade sayfası


{{$users->total()}} toplam total sayı<br>

{{$users->count()}} bu sayfadaki toplam kişi <br>
{{$users->currentPage()}}.sayfadasın<br>
{{$users->firstItem()}}..sayfanın başındaki ilk değerin kaçıncı sırada olduğunu gösterir<br>
{{$users->hasMorePages()}} var<br>
{{$users->lastItem()}}..bu sayfaya kadar toplam bu kadar kişi mevcut<br>
{{$users->lastPage()}}....bu kadar sayfa mevcut<br>
{{$users->nextPageUrl()}}.. bir sonraki sayfanın urlsi<br>
{{$users->perPage()}}.pagination değeri<br>
{{$users->previousPageUrl()}}...önceki sayfanın urlsi<br>




	  @foreach ($users as $user)
        {{ $user->isim }}
    @endforeach
		{{ $users}}
		





?>