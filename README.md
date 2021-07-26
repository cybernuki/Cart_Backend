# Cart_Backend

shopping cart implementation in php

# Enviroment:

laravel 7<br>
postgres <br>

# Execution:

Before running the API make sure that: <br>
you install de dependencies with `composer install` <br>
your database is <b>postges</b>, is serving on port 5432 and have a schema called <b>cart-project<b><br>

You can run integration tests using the following command: <br>
`php artisan test` <br>

If it is the first time using this program use the following command to migrate the database: <br>
`php artisan migrate:fresh` <br>

You can use the following command to generate some data: <br>
`php artisan db:seed`<br>

Finally, Execute the API with the following command:<br>
`php artisan serve --port:3000`<br>

Please use port <b>3000</b> in order to use with the front-end project <br>
Into the file tests/ you can find some request examples

# Data Types:

## Cart:

status: enum('pending','completed')

## Product:

name: string<br>
sku: string<br>
description: string<br>
price: float<br>
imageUrl: string<br>

## ProductCar:

quantity: integer<br>
product_id: integer<br>
cart_id: integer<br>

# Routes:

## Carts Routes:

GET|HEAD api/carts <br>
POST api/carts <br>
GET|HEAD api/carts/{cart_id} <br>
PUT|PATCH api/carts/{cart_id} <br>
DELETE api/carts/{cart_id} <br>

## Products Routes:

GET|HEAD api/products <br>
POST api/products <br>
GET|HEAD api/products/{product_id} <br>
PUT|PATCH api/products/{product_id} <br>
DELETE api/products/{product_id} <br>

## ProductCars Routes:

GET|HEAD api/product_cars <br>
POST api/product_cars <br>
GET|HEAD api/product_cars/{product_car_id} <br>
PUT|PATCH api/product_cars/{product_car_id} // sending 0 as quantity in the request result in a delete from the database <br>
DELETE api/product_cars/{product_car_id} <br>
