# assignment-rest-api-manage-blogs

Create a REST API for managing blog posts with endpoints for listing, creating, updating, and deleting posts. Use API Resource for response formatting.

---

## Creating project,

composer create-project laravel/laravel manage-blogs

php artisan key:generate

---

## For posts, I will create posts table through migration

php artisan make:migration create_posts_table --create=posts
php artisan make:migration create_blogs_table --create=blogs

---

## Now, I need Elequent model Post,

php artisan make:model Post
php artisan make:model Blog

---

## We need controller,

php artisan make:controller PostController --api
php artisan make:controller BlogController --api

---

## Let's create API Resource for Post response formatting,

php artisan make:resource PostResource
php artisan make:resource BlogResource

---

## In routes/api.php,

Route::apiResource('posts', PostController::class);
Route::apiResource('blogs', BlogController::class);

---

## Let's migrate the tables

php artisan migrate

---

## check post api resources are created,

php artisan route:list

---

## CI/CD temporary domain

https://cornflowerblue-stingray-365252.hostingersite.com

---

## Postman Public Collection

https://www.postman.com/orange-flare-819917/sachin-bhoi-testing/collection/t2ddu4k/manage-blog-posts
