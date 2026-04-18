"# pet-adoption-system" 
Изисквания
Задължителни
PHP 8.2 или по-нова версия
Composer
Опционални
Node.js и npm (за компилиране на frontend assets)
Инсталация
Клонирайте репозиторито:
[git clone https://githubhttps://github.com/cyberyness/pet-adoption-system.git
cd pet-adoption-system
Инсталирайте PHP зависимостите:
composer update
Копирайте конфигурационния файл:
cp .env.example .env
Генерирайте application key:
php artisan key:generate
Създайте базата данни и изпълнете миграциите:
php artisan migrate
(Опционално) Ако имате Node.js, инсталирайте frontend зависимостите:
npm install
npm run build
Стартиране
Стартирайте локалния сървър:

php artisan serve --port=80
Приложението ще бъде достъпно на: http://127.0.0.1
