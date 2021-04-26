Backend Proje Kurulumu

.env dosyasında mysql bağlantı ayarlarını güncelleyiniz.

1)composer install<br>
2)php artisan migrate<br>
    ->Nothing to migrate hatası alırsanız<br>
    ->php artisan migrate:reset<br>
    ->php artisan migrate<br>
3) php artisan passport:install<br>
4) php artisan key:generate<br>
5) php artisan serve<br>
