## API
Steps to run the api (_Laravel 10_).

Create a database, then:
1) Copy `.env.example` to `.env`
```
cp .env.example .env
```
2) Link the storage
```
php artisan link:storage:link
```
3) Generate key.
```
php artisan key:generate
```
4) Install the dependencies
```
composer install
```
5) Run migrations and seed

```
php artisan migrate:fresh --seed
```
This will seed the defualt user, `admin@admin.com`, 12 companies, 15 employees attached to each company resource.

6) Run the dev server
```
php artisan serve
```

