# Products App - Laravel API CRUD

A RESTful API built with **Laravel** and **PostgreSQL** to manage products

## 🚀 Features
- Full CRUD functionality (Create, Read, Update, Delete).
- PostgreSQL database integration.
- JSON API responses.


---

## 🛠️ Tech Stack
* **Framework:** Laravel 11.x 
* **Language:** PHP 8.2+
* **Database:** PostgreSQL
* **Tools:** Composer, Bruno (for testing), SQLPlus and DBngin

---

## ⚙️ Installation & Setup

Follow these steps to get the project running locally:

### 1. Install Laravel Herd and run
### 2. Clone the Repository
Using terminal, navigate to C:\Users\User name\Herd folder
Run 'git clone git@github.com:azwinazman/Products.git' on terminal
### 3. Install SQLPlus
### 4. Install DBngin and run
Start Postgres DB instance and click arrow to open SQLPlus
### 5. Create a new DB. Name it 'product_db'
### 6. Create 'products' table
Run 'php artisan migrate' command on terminal to create 'products' table. You have to be in herd\products path
### 7. Install Bruno api app
### 8. Create api request
GET http://products.test/api/products to get all product
POST http://products.test/api/products to create product
  In body tab type (example):
    {
      "name":"Pen",
      "description":"Jenama Stabillo",
      "price":2.50,
      "stock":8
    }
PUT http://products.test/api/products/1 to update a product
  Body example:
    {
      "name":"Buku",
      "description":"Sejarah Tingkatan 3",
      "price":17.00,
      "stock":5
    }
GET http://products.test/api/products/2 to find a product
DELETE http://products.test/api/products/1 to delete a product
