# Cart_Backend
shopping cart implementation in php

# Enviroment:
laravel 7<br>
mysql <br>

# Execution:
Before run the API sure that: <br>
you're database is <b>mysql</b> <br>
The service is <b>running</b> on port 3306 <br>
You have already a schema called <b>cartproject<b> <br>

If it is the first time using this program use the following command to migrate the database: <br>
`php artisan migrate:fresh` <br>

After, you can use the following command to generate some data: <br>
`php artisan db:seed`<br>

Finally, Execute the API in the following way:<br>
`php artisan serve  --port:3000`<br>

Please use port <b>3000</b> in order to use with the front-end project <br>
Into the file tests/ you can find some request tests

# Data Types:
## Cart:
status: enum('pending','completed')

## Product:
name: string<br>
sku: string<br>
description: string<br>
price: float<br>

## ProductCar:
quantity: integer<br>
product_id: integer<br>
cart_id:  integer<br>

# Routes:
## Carts Routes:

GET|HEAD   api/carts <br>
POST       api/carts <br>
GET|HEAD   api/carts/{cart_id} <br>
PUT|PATCH  api/carts/{cart_id} <br>
DELETE     api/carts/{cart_id} <br>

## Products Routes:

GET|HEAD   api/products <br>
POST       api/products <br>
GET|HEAD   api/products/{product_id} <br>
PUT|PATCH  api/products/{product_id} <br> 
DELETE     api/products/{product_id} <br>

## ProductCars Routes:

GET|HEAD   api/product_cars <br>
POST       api/product_cars <br>
GET|HEAD   api/product_cars/{product_car_id} <br>
PUT|PATCH  api/product_cars/{product_car_id} <br> // sending 0 as quantity in the request result in a delete from the database
DELETE     api/product_cars/{product_car_id} <br>