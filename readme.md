INSTALATION:

cp .env.example .env

composer install

chmod -R 0777 bootstrap/ storage/

php artisan key:generate

php artisan migrate

php artisan db:seed

ADMIN:

url: /login

login: admin@admin.com
pass: secret

login: user@user.com
pass: secret

login: editor@editor.com
pass: secret