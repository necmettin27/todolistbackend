Backend Proje Kurulumu

.env dosyasında mysql bağlantı ayarlarını güncelleyiniz.

1)composer install
2)php artisan migrate
    ->Nothing to migrate hatası alırsanız
    ->php artisan migrate:reset
    ->php artisan migrate
3) php artisan passport:install
4) php artisan serve
