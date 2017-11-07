

Gmail mail gönderme...


İlk yapacağımız mail için bir controller oluşturmak olsun.

php artisan make:controller sendMail olsun

<?php 

