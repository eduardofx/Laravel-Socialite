LARAVEL Socialite
___________________________________________________________

> composer require laravel/socialite

> php artisan make:auth

> php artisan serve

> http://localhost:8000/login


* Corrigir - cURL error 60
php.ini

>[curl]

>; A default value for the CURLOPT_CAINFO option. This is required to be an

>; absolute path.

>curl.cainfo = "C:\wamp64\bin\php\php5.6.25\cacert.pem"


Facebook
> https://developers.facebook.com/

Google
> https://console.developers.google.com/

Twitter
>  https://apps.twitter.com/

* Inserir o client_id e o client_secret em config/services.php
