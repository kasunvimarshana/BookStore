"# BookStore" 

## Installation

#### Go to project Directory
add database reference in .env [DATABASE_URL="mysql://root:@127.0.0.1:3306/book_store"]

```bash
composer install
php bin/console doctrine:database:create
php bin/console make:migration
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
symfony server:start
```


#### Coupon Codes
000001, 000002, 000003, 000004, 000005
