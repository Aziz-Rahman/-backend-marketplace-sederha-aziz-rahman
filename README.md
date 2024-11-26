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

Body

Raw (JSON)
```
{
    "name": "Customer Z",
    "email": "customer_z@example.com",
    "password": "password123",
    "role": "customer"
}
```
* role : (merchant atau customer)

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

Body

Raw (JSON)
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
*Token tsb akan diguNakan untuk proses2 didalam sistem
![alt text](https://github.com/Aziz-Rahman/backend-marketplace-sederhana-aziz-rahman/blob/main/screenshoot/login.png)


#ADD PRODUCT
-------------
POST | http://localhost:9090/api/merchant/product

Headers

Content-Type : application/json

Authorization : bearer [TOKEN]

Contoh Request

Body

Raw (JSON)
```
{
    "title": "Barang Kiriman",
    "description": "Ini merupakan barang kiriman.",
    "price": 66654,
    "stock": 5
}
```

Contoh Response:
```
{
    "message": "Product created successfully",
    "product": {
        "title": "Barang Kiriman",
        "description": "Ini merupakan barang kiriman.",
        "price": 66654,
        "merchant_id": 3,
        "stock": 5,
        "updated_at": "2024-11-26T12:40:49.000000Z",
        "created_at": "2024-11-26T12:40:49.000000Z",
        "id": 1
    }
}
```

![alt text](https://github.com/Aziz-Rahman/backend-marketplace-sederhana-aziz-rahman/blob/main/screenshoot/addProduct-merchant.png)


#UPDATE PRODUCT
----------------
POST | http://localhost:9090/api/merchant/updateProduct

Headers

Content-Type : application/json

Authorization : bearer [TOKEN]

Contoh Request

Body

Raw (JSON)
```
{
    "id": 1,
    "title": "Barang Kiriman diubah !!!",
    "description": "Ini merupakan barang kiriman.",
    "price": 66654,
    "stock": 53
}
```

Contoh Response:
```
{
    "message": "Update product successfully"
}
```
![alt text](https://github.com/Aziz-Rahman/backend-marketplace-sederhana-aziz-rahman/blob/main/screenshoot/updateProduct-merchant.png)


#DELETE PRODUCT
---------------
POST | http://localhost:9090/api/merchant/deleteProduct/2

Headers

Content-Type : application/json

Authorization : bearer [TOKEN]

Contoh Response
```
{
    "message": "Product deleted successfully"
}
```

#VIEW ORDER (CUSTOMER YANG SUDAH ORDER)
---------------------------------------
GET | http://localhost:9090/api/merchant/viewOrders

Headers

Content-Type : application/json

Authorization : bearer [TOKEN]

Contoh Response

![alt text](https://github.com/Aziz-Rahman/backend-marketplace-sederhana-aziz-rahman/blob/main/screenshoot/viewCustomerOrder-merchant.png)


#SHOW PRODUCT
-------------
GET | http://localhost:9090/api/customer/products
