# SBI Laravel Inventory Module

## Краткое описание проекта

Простое приложение на Laravel для учёта товаров и категорий с возможностью экспорта данных в Excel через очереди.  
Проект построен на паттернах `Service` и `Repository`, с поддержкой API, валидацией через `Form Request`, модульными тестами и экспортом данных.

---

## Как установить

1. Клонируйте репозиторий:
   ```bash
   git clone https://github.com/shaxzodbe/sbi-laravel.git
   cd sbi-laravel
2. Установите зависимости:
    ```bash
   composer install
3. Скопируйте файл настроек окружения и сгенерируйте ключ:
    ```bash
   cp .env.example .env
   php artisan key:generate
4. Настройте подключение к базе данных в .env файле:
   ```dotenv
   DB_CONNECTION=pgsql
   DB_HOST=127.0.0.1
   DB_PORT=5432
   DB_DATABASE=your_database_name
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
5. Выполните миграции и сидеры:
    ```bash
   php artisan migrate --seed
6. Запустите обработчик очереди:
    ```bash
   php artisan queue:work

## Как запустить
1. Запустите локальный сервер Laravel:
    ```bash
   php artisan serve
2. API будет доступен по адресу:
    ```bash
   http://127.0.0.1:8000/api/
3. Все доступные эндпоинты:
    ```bash
   php artisan route:list
4. Запустить тесты:
    ```bash
   php artisan test
   
## 🛠 Стек технологий
Laravel 10+

PostgreSQL / MySQL

PHP 8.2+

Maatwebsite Excel

Очереди Laravel (Database Driver или Redis)

PHPUnit
