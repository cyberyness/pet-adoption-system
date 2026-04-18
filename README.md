"# pet-adoption-system" 
Инсталация
Клонирайте репозиторито:
git clone https://github.com/cyberyness/pet-adoption-system.git
cd pet-adoption-system

Инсталирайте PHP зависимостите:
composer update

Копирайте конфигурационния файл:
cp .env.example .env

Генерирайте application key:
php artisan key:generate

Създайте базата данни и изпълнете миграциите:
php artisan migrate

Стартиране
Стартирайте локалния сървър:

php artisan serve --port=80
Приложението ще бъде достъпно на: http://127.0.0.1
