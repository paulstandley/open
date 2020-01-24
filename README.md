# Paul Standley

![profile](img/profile.png)

## OPEN

![open](img/open.png)

---

### Laravel __6__ setup

#### **Bash Setup**

```BASH

composer create-project --prefer-dist laravel/laravel open

composer require laravel/ui --dev

php artisan ui react

php artisan ui react --auth

npm install && npm run dev

npm run watch

```

### Conrtrollers Models Migrations

#### **Bash Controllers**

```BASH

php artisan make:controller ProfileController -r

php artisan make:model Profile -m

php artisan make:controller PostsController -r

php artisan make:model Post -m

php artisan make:controller FollowsController

php artisan make:migration creates_profile_user_pivot_table --create profile_user

php artisan make:mail NewUserWelcomeMail -m emails.welcome-email

php artisan storeage:link

php artisan make:policy ProfilePolicy -m Profile

composer require intervention/image

composer require guzzlehttp/guzzle

php artisan migrate

```
