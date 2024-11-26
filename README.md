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
http://localhost:9090/api/register
![alt text](https://github.com/Aziz-Rahman/backend-marketplace-sederhana-aziz-rahman/blob/main/screenshoot/register.png)


#LOGIN
http://localhost:9090/api/login
![alt text](https://github.com/Aziz-Rahman/backend-marketplace-sederhana-aziz-rahman/blob/main/screenshoot/login.png)


#ADD PRODUCT
[http://localhost:9090/api/login](http://localhost:9090/api/merchant/product)
![alt text](https://github.com/Aziz-Rahman/backend-marketplace-sederhana-aziz-rahman/blob/main/screenshoot/addProduct-merchant.png)


#UPDATE PRODUCT
[http://localhost:9090/api/login](http://localhost:9090/api/merchant/updateProduct)
![alt text](https://github.com/Aziz-Rahman/backend-marketplace-sederhana-aziz-rahman/blob/main/screenshoot/updateProduct-merchant.png)


#DELETE PRODUCT
[http://localhost:9090/api/login](http://localhost:9090/api/merchant/deleteProduct/9)
![alt text](https://github.com/Aziz-Rahman/backend-marketplace-sederhana-aziz-rahman/blob/main/screenshoot/deleteProduct-merchant.png)


#VIEW ORDER (CUSTOMER YANG SUDAH ORDER)
GET | http://localhost:9090/api/merchant/viewOrders
![alt text](https://github.com/Aziz-Rahman/backend-marketplace-sederhana-aziz-rahman/blob/main/screenshoot/viewCustomerOrder-merchant.png)


#SHOW PRODUCT
GET | http://localhost:9090/api/customer/products
![alt text](https://github.com/Aziz-Rahman/backend-marketplace-sederhana-aziz-rahman/blob/main/screenshoot/showProduct.png)
