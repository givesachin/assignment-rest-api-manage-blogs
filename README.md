# assignment-rest-api-manage-blogs
Create a REST API for managing blog posts with endpoints for listing, creating, updating, and deleting posts. Use API Resource for response formatting.

Creating project,

composer create-project laravel/laravel manage-blogs

php artisan key:generate

For posts, I will create posts table through migration

php artisan make:migration create_posts_table --create=posts

Now, I need Elequent model Post,

php artisan make:model Post

We need controller,

php artisan make:controller PostController --api

Let's create API Resource for Post response formatting,

php artisan make:resource PostResource

In routes/api.php,

Route::apiResource('posts', PostController::class);

Let's migrate the tables

php artisan migrate

