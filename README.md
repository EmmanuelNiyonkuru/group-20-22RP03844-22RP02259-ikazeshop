Ikaze shop is Laravel based e-comerce platform for buying famous product

#Developers :
    SHYAKA Aimable     22RP02259
    NIYONKURU Emmanuel 22RP03844

Laravel E-Commerce Checkout System
Project Overview
This Laravel-based e-commerce checkout system provides a complete solution for handling customer orders, including cart management, checkout processing, and order receipt generation.

Features
🛒 Shopping cart functionality with session storage

💳 Secure checkout process with form validation

📦 Order management with database persistence

🧾 Automatic receipt generation

🔐 Authentication-protected routes

📱 Responsive design

Installation
Clone the repository:https://github.com/EmmanuelNiyonkuru/group-20-22RP03844-22RP02259-ikazeshop

cd group-20-22RP03844-22RP02259-ikazeshop

#Install dependencies:

composer install
npm install

#Configure environment:


cp .env.example .env
php artisan key:generate
Set up database:

#Create a MySQL database
database name :ecom
Update .env with your database credentials

Run migrations:

#php artisan migrate

#Run the development server:

php artisan serve
Database Structure
Tables
orders

id
user_id (foreign key)
order_number (unique)
first_name
last_name
email
address
country
state
zip_code
payment_method
total_amount
status
created_at
updated_at
order_items
id
order_id (foreign key)
product_id (foreign key)
product_name
price
quantity
created_at
updated_at



#Routes
/products   to view all product available 


Dependencies
PHP : PHP 8.2.12

Laravel 11

MySQL 5.7+

Bootstrap 5

Font Awesome 6

Security Considerations
All checkout routes require authentication

CSRF protection on forms

Input validation on all user-submitted data

Users can only view their own order receipts

Troubleshooting
If the checkout process fails:

Check your form validation errors

Verify all required fields are filled

Ensure your database connection is working

#Check Laravel logs for errors


