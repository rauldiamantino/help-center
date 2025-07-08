# Help Center

This is a multi-tenant Help Center platform built with Laravel, evolved from the project at [rauldiamantino/central-ajuda](https://github.com/rauldiamantino/central-ajuda).

---

### Features

- Separate companies with their own users, categories, and articles  
- Role-based access control (admin, editor)  
- Article view tracking  
- Public-facing pages customized per company  

---

### Technologies

- Laravel 12  
- PHP 8.3  
- MySQL 8  
- Eloquent ORM  

---

### Quick Setup

```bash
git clone https://github.com/rauldiamantino/help-center.git
cd help-center
composer install

cp .env.example .env
# Configure your database credentials in the .env file (make sure the database exists)

php artisan migrate --seed
php artisan serve
