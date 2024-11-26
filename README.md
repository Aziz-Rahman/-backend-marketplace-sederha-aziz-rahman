Langkah-langkah menjalankan project
------------------------------------

git clone https://github.com/Aziz-Rahman/backend-marketplace-sederhana-aziz-rahman.git

composer install

php artisan key:generate --ansi

#Sesuaikan file .env dengan database yang akan dibuat
php artisan migrate

#RUNING ...
php artisan serve atau 
php artisan serve --port=9090 untuk menjalankan di port lain

#REGISTER
-----------
POST | http://localhost:9090/api/register

Contoh Request
```
{
    "name": "Customer Z",
    "email": "customer_z@example.com",
    "password": "password123",
    "role": "customer"
}
```

Contoh Response:
```
{
    "message": "User registered successfully"
}
```
![alt text](https://github.com/Aziz-Rahman/backend-marketplace-sederhana-aziz-rahman/blob/main/screenshoot/register.png)


#LOGIN
-----------
POST | http://localhost:9090/api/login

Contoh Request
```
{
    "email": "customer_z@example.com",
    "password": "password123"
}
```

Contoh Response:
```
{
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjkwOTAvYXBpL2xvZ2luIiwiaWF0IjoxNzMyNjI0MTE1LCJleHAiOjE3MzI2Mjc3MTUsIm5iZiI6MTczMjYyNDExNSwianRpIjoiWUNoc2FCbDhNOXVUejlYZyIsInN1YiI6IjIiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.A3Vj1-ay5jXu3DjBPe_eeUZLw99lXhieDF6N-hreNrA"
}
```
*Token tsb akan digubakan untuk proses2 didalam sistem
![alt text](https://github.com/Aziz-Rahman/backend-marketplace-sederhana-aziz-rahman/blob/main/screenshoot/login.png)


#ADD PRODUCT
-------------
POST | http://localhost:9090/api/merchant/product
![alt text](https://github.com/Aziz-Rahman/backend-marketplace-sederhana-aziz-rahman/blob/main/screenshoot/addProduct-merchant.png)


#UPDATE PRODUCT
----------------
http://localhost:9090/api/merchant/updateProduct
![alt text](https://github.com/Aziz-Rahman/backend-marketplace-sederhana-aziz-rahman/blob/main/screenshoot/updateProduct-merchant.png)


#DELETE PRODUCT
---------------
http://localhost:9090/api/merchant/deleteProduct/9
![alt text](https://github.com/Aziz-Rahman/backend-marketplace-sederhana-aziz-rahman/blob/main/screenshoot/deleteProduct-merchant.png)


#VIEW ORDER (CUSTOMER YANG SUDAH ORDER)
---------------------------------------
GET | http://localhost:9090/api/merchant/viewOrders
![alt text](https://github.com/Aziz-Rahman/backend-marketplace-sederhana-aziz-rahman/blob/main/screenshoot/viewCustomerOrder-merchant.png)


#SHOW PRODUCT
-------------
GET | http://localhost:9090/api/customer/products
![alt text](https://github.com/Aziz-Rahman/backend-marketplace-sederhana-aziz-rahman/blob/main/screenshoot/showProduct.png)
