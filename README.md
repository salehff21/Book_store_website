# Book Store Website

A PHP-based online bookstore web application that allows users to browse books, view details, add them to cart, and checkout. Admin functionality is included for managing books.

## 📂 Project Structure

Book_store_website/
│── Add_book.php # Admin page to add new books
│── book-details.php # Book detail page
│── Book.php # Book model / logic
│── cart.php # Shopping cart
│── checkout.php # Checkout process
│── index.php # Homepage
│── login.php # User login
│── .git/ # Git version control files

markdown
Copy code

## ⚙️ Requirements

- PHP 7.4 or higher  
- Apache or Nginx web server  
- MySQL database  
- Browser with JavaScript enabled  

## 🚀 Installation and Setup

1. Clone the repository or copy project files to your server:
   ```bash
   git clone https://github.com/your-username/Book_store_website.git
or manually upload to /var/www/html/Book_store_website.

Configure database:

Create a new MySQL database (e.g., bookstore).

Import the SQL schema (if provided).

Update database connection details inside the PHP files (commonly in a config or db_connect file, add one if missing). Example:

php
Copy code
<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "bookstore";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
Start Apache server and open in browser:

arduino
Copy code
http://localhost/Book_store_website
🔑 Features
User login system

Browse books and view details

Add books to cart

Checkout system

Admin page for adding new books

📌 Notes
Ensure the server has proper file permissions for PHP execution.

Secure the application before production (input validation, file sanitization, HTTPS, prepared statements).

GitHub Pages does not support PHP; deploy to a PHP-enabled server.

👨‍💻 Contributors
Eng: Saleh Al-shaebi 
