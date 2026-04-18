"# pet-adoption-system" 
Изисквания
Задължителни
PHP 8.2 или по-нова версия
Composer
Опционални
Node.js и npm (за компилиране на frontend assets)
Инсталация
Клонирайте репозиторито:
git clone https://github.com/ivanOgnyanov/mvc-controllers-exercise.git
cd mvc-controllers-exercise
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

php artisan serve
Приложението ще бъде достъпно на: http://localhost:8000
