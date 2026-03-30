# FlowerHub E-commerce Website

A PHP-based flower shop website with user authentication, shopping cart, and order management.

## Features

- User registration and login with PHP sessions
- Product catalog with flower categories
- Shopping cart functionality
- Order placement and management
- Responsive Bootstrap design

## Setup Instructions

### Prerequisites
- XAMPP (or any web server with PHP and MySQL)
- Web browser

### Installation Steps

1. **Copy files to XAMPP htdocs folder:**
   - Copy all files from this project to `C:\xampp\htdocs\flowerhub\` (or your XAMPP htdocs directory)

2. **Import the database:**
   - Start XAMPP and ensure Apache and MySQL are running
   - Open phpMyAdmin (http://localhost/phpmyadmin)
   - Create a new database named `flowerhub_db`
   - Import the `database.sql` file from this project

3. **Configure database connection:**
   - The `config.php` file is already configured for default XAMPP settings
   - If you have different MySQL credentials, update the constants in `config.php`

4. **Access the website:**
   - Open your browser and go to `http://localhost/flowerhub/estate.php`

### Database Structure

- **users**: User accounts with login credentials
- **products**: Flower products with prices and images
- **cart**: Shopping cart items for each user
- **orders**: Order records
- **order_items**: Individual items in each order

### File Structure

- `config.php`: Database connection and session management
- `database.sql`: Database schema and sample data
- `estate.php`: Home page
- `products.php`: Product catalog
- `login.php`: User login
- `signup.php`: User registration
- `view_cart.php`: Shopping cart
- `checkout.php`: Order checkout
- `order_success.php`: Order confirmation
- `logout.php`: User logout
- `add_to_cart.php`: Add items to cart

### Usage

1. Register a new account or login with existing credentials
2. Browse products in the Categories section
3. Add items to cart
4. Proceed to checkout
5. Complete the order

### Default Login

You can register new users or modify the database to add admin accounts.

### Security Notes

- Passwords are hashed using PHP's password_hash()
- User input is sanitized to prevent SQL injection
- Sessions are used for user authentication

### Customization

- Update product images in the `images/` folder
- Modify CSS styles in the HTML files
- Add more products through phpMyAdmin or create an admin panel

## Support

For issues or questions, check the PHP error logs in XAMPP or contact the developer.