# Varms-Restaurants

# 🍽️ Restaurant Website with Admin Panel & Razorpay Integration

This is a PHP-based restaurant website that includes a user-facing interface for browsing dishes and placing orders, along with an admin panel for managing dishes and tracking revenue. It also integrates Razorpay for secure online payments.

---

## 🚀 Features

### ✅ User Side
- Browse available dishes
- Add items to cart
- Make secure payments via Razorpay
- View order confirmation

### ✅ Admin Panel
- Admin authentication (login/logout)
- Add/delete dishes
- View total items ordered, revenue, and estimated profit
- Dashboard overview with Bootstrap UI

### ✅ Razorpay Integration
- Generates dynamic Razorpay orders
- Handles payment using Razorpay Checkout
- Verifies payment signature
- Redirects to a success page on successful payment

---

## 🛠️ Tech Stack

- **Backend**: PHP (Vanilla)
- **Frontend**: HTML, CSS, Bootstrap 5.3
- **Database**: MySQL
- **Payment Gateway**: Razorpay
- **Server**: XAMPP (Apache, MySQL, PHP)

---

## 📂 Folder Structure

Restaurant-website/
├── index.php
├── admin_login.php
├── admin_dashboard.php
├── add_dish.php
├── delete_dish.php
├── config.php
├── razorpay_order.php
├── verify_payment.php
├── success.html
├── assets/
│ └── css, js, images
├── vendor/
│ └── autoload files (Composer)
└── database/
└── restaurant.sql

yaml
Copy
Edit

---

## ⚙️ Setup Instructions

### 1. Clone this repository:
```bash
git clone https://github.com/your-username/restaurant-website.git
2. Configure Environment
Import the restaurant.sql file into your MySQL database.

Update your config.php file with your database credentials and Razorpay API keys.

php
Copy
Edit
// config.php
define('DB_HOST', 'localhost');
define('DB_NAME', 'restaurant');
define('DB_USER', 'root');
define('DB_PASS', '');
define('RAZORPAY_KEY_ID', 'your_key_id');
define('RAZORPAY_KEY_SECRET', 'your_key_secret');
3. Start XAMPP
Place the project inside htdocs

Start Apache & MySQL from XAMPP control panel

Open in browser:
http://localhost/Restaurant-website/

🔐 Admin Login
Navigate to: http://localhost/Restaurant-website/admin_login.php

Default credentials (you can customize):

Username: admin

Password: admin123

📦 Dependencies
Install Razorpay PHP SDK using Composer:

bash
Copy
Edit
composer require razorpay/razorpay
📸 Screenshots
Add screenshots of the homepage, payment page, and admin dashboard here.

📄 License
This project is licensed under the MIT License.

🙌 Credits
Developed by jaya varms S
Student Project — Hotel & Restaurant Management System

yaml
Copy
Edit

---

Let me know if you’d like it tailored with your name (`Developed by Jayavarma`) or want me to genera






