# mysqli_mis

<div align="center">
<img src="https://skillicons.dev/icons?i=php,mysql,html,css&theme=dark&perline=4" />

**Built with PHP, MySQL, HTML, and CSS**
</div>

A Management Information System built with PHP and MySQLi featuring user authentication, CRUD operations, and admin panel.

## Overview

mysqli_mis is a complete web-based management system that demonstrates secure user authentication, database operations, and administrative functionality using PHP and MySQLi. The system includes user registration with email verification, secure login, and full CRUD (Create, Read, Update, Delete) capabilities.

## Features

- **User Authentication**
  - Secure user registration
  - Email verification system
  - Password hashing and encryption
  - Session management
  - Login/logout functionality

- **CRUD Operations**
  - Create new records
  - Read and display data
  - Update existing records
  - Delete records with confirmation

- **Admin Panel**
  - Secure admin access
  - User management
  - Data oversight
  - Administrative controls

- **Security**
  - SQL injection prevention
  - XSS protection
  - Password hashing
  - Session security
  - Input validation and sanitization

## Project Structure

```
mysqli_mis/
├── connections.php          # Database connection configuration
├── login.php               # User login page
├── signup.php              # User registration page
├── verify.php              # Email verification handler
├── signupSuccess.php       # Registration success page
├── logout.php              # Logout handler
├── landingPage.php         # Main landing page
├── SecureAdminPage.php     # Admin dashboard
├── create.php              # Create new records
├── read.php                # Display records
├── edit.php                # Edit existing records
├── delete.php              # Delete records
├── style.css               # Styling
├── composer.json           # PHP dependencies
├── composer.lock           # Locked dependencies
└── .gitignore             # Git ignore rules
```

## Prerequisites

Before running this project, ensure you have:

- **PHP** 7.4 or higher
- **MySQL** 5.7 or higher (or MariaDB)
- **Web Server** (Apache, Nginx, or built-in PHP server)
- **Composer** (for dependency management)
- **PHPMailer** (for email verification)

## Installation

### 1. Clone the Repository

```bash
git clone https://github.com/achille010/mysqli_mis.git
cd mysqli_mis
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Configure Database

Create a MySQL database:

```sql
CREATE DATABASE mysqli_mis;
USE mysqli_mis;

-- Create users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    verification_code VARCHAR(100),
    is_verified TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create your data tables as needed
```

### 4. Update Database Credentials

Edit `connections.php` with your database credentials:

```php
<?php
$servername = "localhost";
$username = "your_db_username";
$password = "your_db_password";
$database = "mysqli_mis";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
```

### 5. Configure Email Settings

Update email configuration in `signup.php` or `verify.php` for the verification system:

```php
// Example using PHPMailer
$mail->Host = 'smtp.your-email-provider.com';
$mail->Username = 'your-email@example.com';
$mail->Password = 'your-email-password';
$mail->setFrom('noreply@example.com', 'mysqli_mis');
```

### 6. Start the Server

Using PHP built-in server:

```bash
php -S localhost:8000
```

Or configure Apache/Nginx to point to the project directory.

### 7. Access the Application

Open your browser and navigate to:
```
http://localhost:8000
```

## Usage

### User Registration

1. Navigate to `signup.php`
2. Fill in username, email, and password
3. Check your email for verification link
4. Click verification link to activate account

### User Login

1. Navigate to `login.php`
2. Enter your credentials
3. Access the system dashboard

### CRUD Operations

**Create:**
- Navigate to `create.php`
- Fill in the form
- Submit to add new record

**Read:**
- Navigate to `read.php`
- View all records in a table format

**Update:**
- Click edit button on any record
- Modify the information in `edit.php`
- Save changes

**Delete:**
- Click delete button on any record
- Confirm deletion in `delete.php`

### Admin Access

1. Login with admin credentials
2. Access `SecureAdminPage.php`
3. Manage users and system data

## Security Features

### Implemented Security Measures

- **Password Hashing**: Uses `password_hash()` with bcrypt
- **Prepared Statements**: All database queries use prepared statements
- **Input Validation**: Server-side validation on all inputs
- **Session Management**: Secure session handling
- **HTTPS Ready**: Configured for SSL/TLS
- **SQL Injection Prevention**: MySQLi prepared statements
- **XSS Protection**: Input sanitization and output escaping
- **CSRF Protection**: Token validation on forms

### Best Practices

- Never store passwords in plain text
- Always validate user inputs
- Use HTTPS in production
- Keep dependencies updated
- Regular security audits

## Database Schema

### Users Table

```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    verification_code VARCHAR(100),
    is_verified TINYINT(1) DEFAULT 0,
    role ENUM('user', 'admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

Add your own tables for the management system as needed.

## Technologies Used

- **Backend**: PHP 7.4+
- **Database**: MySQL/MySQLi
- **Frontend**: HTML5, CSS3
- **Email**: PHPMailer
- **Dependencies**: Managed with Composer

## Configuration

### Environment Variables

Create a `.env` file (not committed to Git):

```env
DB_HOST=localhost
DB_USER=your_username
DB_PASS=your_password
DB_NAME=mysqli_mis

MAIL_HOST=smtp.gmail.com
MAIL_USER=your_email@gmail.com
MAIL_PASS=your_app_password
MAIL_FROM=noreply@yourdomain.com
```

### Apache Configuration

```apache
<VirtualHost *:80>
    ServerName mysqli-mis.local
    DocumentRoot /path/to/mysqli_mis
    
    <Directory /path/to/mysqli_mis>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

## Troubleshooting

### Common Issues

**Database Connection Failed:**
```
Error: Connection failed: Access denied
```
Solution: Check database credentials in `connections.php`

**Email Verification Not Working:**
```
Error: Could not send verification email
```
Solution: Verify SMTP settings and email credentials

**Session Errors:**
```
Warning: session_start()
```
Solution: Ensure sessions are properly started and writable directory exists

## Future Enhancements

- [ ] Password reset functionality
- [ ] Two-factor authentication
- [ ] Advanced user roles and permissions
- [ ] Activity logging and audit trails
- [ ] API endpoints for mobile access
- [ ] File upload capabilities
- [ ] Advanced search and filtering
- [ ] Export data to CSV/PDF
- [ ] Dashboard analytics
- [ ] Multi-language support

## Contributing

Contributions are welcome! Please see [CONTRIBUTING.md](CONTRIBUTING.md) for guidelines.

## Security

For security vulnerabilities, see [SECURITY.md](SECURITY.md) for reporting instructions.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Acknowledgments

- PHPMailer for email functionality
- Bootstrap (if used) for responsive design
- MySQL for database management

---

*Built as a learning project to demonstrate PHP/MySQLi CRUD operations and secure authentication*