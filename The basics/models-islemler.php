<?php 


<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class uyelermodel extends Model
{
    protected $table="kullanicilar";//TAblonun adını bu şekilde belirtiyoruz esneklik yok

    	
    protected $fillable=["ogrenci_adi","ogrenci_soyadi"];//tabbloda nerelere ekleme yapacağımızı seçiyoruz.


    //public $timestamps=false;
}
