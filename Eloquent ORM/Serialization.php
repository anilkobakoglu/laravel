
anlamı seri hale getirme

<?php

--Serializing To Arrays


//tablolarnız arası relationship özelliği varsa yani ilişkilendirilnişse 


   	 $kisiler=\App\kullanicilar::with('yorumlar')->find(5); //with özelliği ile yorumlar tablosundaki yorumları ile birlikte $kisilere aktarılır

   	 return $kisiler->toArray();	// değerlerinizi dizi halinde döndürür

   	 //not to array yazmasak ta aynı çıktıyı alıyorum

   	 return $users[9]; //9. değeri verir.




   
   --HİDDEN

  protected $hidden = ['password'];	 

  return kisiler::all(); //yaptığımda ekranda parolayı göremem.. Parolayı gizlemiş oldum



   $users = \App\kullanicilar::all();

   	 	foreach ($users as $user){			//fakat şu şekilde direkt parolayı çektiğimde gözükür

   	 			echo $user->parola.'<br>';

   	 	}

   --VİSİBLE
   
       protected $visible = ['parola'];


return kullanicilar::all(); // yaptığımda sadece parolalar gözükür.

//yine isim vs ulaşmak için foreach içerisinde ulaşılabilir.
