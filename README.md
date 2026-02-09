# Hapani Motors 🚗

A comprehensive web-based vehicle management and e-commerce system built with PHP, enabling users to browse vehicles, manage orders, and providing administrative capabilities for inventory management.

## 📋 Overview

Hapani Motors is a full-featured vehicle sales platform with three distinct user roles:
- **Customers**: Browse vehicles, manage shopping cart, place orders, and track order history
- **Administrators**: Manage products, employees, and oversee the system
- **Support Staff**: Handle customer inquiries and user management

## 🛠️ Technology Stack

- **Backend**: PHP (75.8%)
- **Styling**: CSS (20.7%)
- **Additional**: Hack (2.7%), JavaScript (0.8%)
- **Database**: MySQL
- **Architecture**: MVC (Model-View-Controller) Pattern

## 📁 Project Structure

```
Project-Hapani-Motors/
├── controller/          # Application controllers
│   ├── HomeController.php
│   ├── Admin_*.php     # Admin controllers
│   ├── Support_*.php   # Support controllers
│   └── User controllers
├── model/              # Data models and database logic
│   ├── user.php
│   ├── product.php
│   ├── cart.php
│   ├── order.php
│   └── admin_*.php
├── view/               # User interface templates
│   ├── admin_*.php     # Admin views
│   ├── support_*.php   # Support views
│   ├── user_*.php      # Customer views
│   ├── css/           # Stylesheets
│   ├── js/            # JavaScript files
│   ├── Images/        # Image assets
│   └── uploaded_img/  # User-uploaded images
├── hapani.sql         # Database schema
└── index.php          # Entry point
```

## ✨ Features

### Customer Features
- 🏠 Browse vehicle inventory
- 🛒 Shopping cart management
- 📦 Order placement and checkout
- 📜 Order history tracking
- 👤 User profile management
- 🔐 User authentication (login/register)
- 🔑 Password recovery
- 📞 Contact form

### Admin Features
- 📊 Dashboard with system overview
- 🚘 Product/vehicle management (CRUD operations)
- 👥 Employee management
- 🔄 Product updates and inventory control
- 👤 Profile management

### Support Features
- 💬 Message management
- 👥 User support and management
- 📊 Support dashboard
- 👤 Profile management

## 🚀 Installation

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache/Nginx web server
- phpMyAdmin (optional, for database management)

### Setup Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/MAHINSARKER/Project-Hapani-Motors.git
   cd Project-Hapani-Motors
   ```

2. **Configure Database**
   - Create a MySQL database
   - Import the database schema:
     ```bash
     mysql -u your_username -p your_database_name < hapani.sql
     ```

3. **Configure Database Connection**
   - Update database credentials in model files
   - Typically found in files like `model/user.php`, `model/product.php`, etc.

4. **Set Permissions**
   ```bash
   chmod 755 view/uploaded_img/
   ```

5. **Start the Server**
   - Place the project in your web server's document root
   - Access via browser: `http://localhost/Project-Hapani-Motors/`

## 🔐 Default Access

After installation, you may need to create admin accounts through the registration pages:
- Admin Registration: `/controller/AdminRegisterController.php`
- Support Registration: `/controller/Support_RegisterController.php`
- User Registration: `/controller/RegisterController.php`

## 📱 Pages Overview

### Customer Pages
- Home page with vehicle showcase
- Vehicle browsing and filtering
- Product detail view
- Shopping cart
- Checkout
- Order history
- User profile
- About page
- Contact page

### Admin Panel
- Dashboard
- Product management
- Employee management
- Profile settings

### Support Panel
- Dashboard
- Message management
- User management
- Profile settings

## 🔄 Workflow

1. **User Journey**: 
   Home → Browse Vehicles → Add to Cart → Checkout → Order Confirmation

2. **Admin Journey**: 
   Login → Dashboard → Manage Products/Employees → Update Inventory

3. **Support Journey**: 
   Login → Dashboard → Handle Messages → Manage Users

## 🤝 Contributing

Contributions, issues, and feature requests are welcome!

## 📄 License

This project is available for educational and commercial use.

## 👨‍💻 Author

**MAHIN SARKER**
- GitHub: [@MAHINSARKER](https://github.com/MAHINSARKER)

## 📞 Support

For support and queries, please use the contact form or open an issue in the repository.

---

**Note**: Make sure to configure your database credentials and set appropriate file permissions before deploying to production.
```
