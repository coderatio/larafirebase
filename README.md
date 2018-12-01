# Larafirebase
A simple and clean CRUD laravel  blog app using PHP(Laravel) and VueJs with Google Firebase.

# How to use
First thing is to install all our PHP libraries. You can do so by executing this command on your terminal.
```vim
composer install
```

We then copy the contents of our .env.example and create a .env file on our project root and paste the contents there. After which, execute this command on your terminal to generate new app key.

```vim
php artisan key:generate
```

Then, we need to install our npm dependencies. Do that by executing this command on your terminal
```vim
npm install
```
Lastly, open app folder and create a new folder called `secret` and paste your Google service account key. Then, open `PostsController` and put the path to that file on our LaraFirebase object instance. e.g

```php
$this->pfb = new LaraFirebase('../secret/php-crud-f7984-3f535927d6d2.json'); Change this path as per your key name
```

That's all you need to do.

Let me know if you need any help.
