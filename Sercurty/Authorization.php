

Yetkilendirme işlemi Gates ve Policies ile yapılır.
Laravel, kimlik doğrulama hizmetlerini kutudan çıkarmaya ek olarak, belirli bir kaynağa karşı kullanıcı eylemlerini yetkilendirmenin basit bir yolunu sunar. Kimlik doğrulama gibi, Laravel'in yetkilendirme yaklaşımı basittir ve eylemleri yetkilendirmenin iki temel yolu vardır: Gates ve Policies.


Gateler, bir kullanıcının BELİRLİ BİR EYLEMİ GERÇEKLEŞTİRME YETKİSİ OLUP OLMADIĞINI belirleyen Kapanışlardır ve genellikle Kapı cephesini kullanarak App \ Providers \ AuthServiceProvider sınıfında tanımlanır. Gateler her zaman bir kullanıcı örneğini ilk argüman olarak alırlar ve isteğe bağlı olarak Yakından ilintili bir model gibi ek argümanlar alabilirler.







konunun devamı gelecek..



