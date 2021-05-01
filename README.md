# Square1 Blog

## Requeriments
The current project requeriments are:
- PHP >= 7.3
- MySql version >= 8.0.22.
- Laravel version >= 8.

## how to install?

- Clone this repository.
- Run  <code>composer install</code>
- Create a local database
- Create a local tests database
- Create a <code>.env</code> File, based on <code>.env.example</code> file
- Config <code>.env</code> File
- Run <code>php artisan test</code> to test the project
- Run <code>php artisan migrate</code> command
- Run <code>php artisan db:seed --class=UserTableSeeder</code> command
- Run <code>php artisan posts:sync </code> to get posts from the ahother web platform
- Run (Optional) <code>php artisan db:seed --class=PostTableSeeder</code> if you need to see pagination and filter functionalities

Thanks for your time, all feedback is welcome.

