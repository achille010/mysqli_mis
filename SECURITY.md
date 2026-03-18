# Security Policy

## Supported Versions

We take security seriously in this PHP/MySQLi project. The following versions are currently supported with security updates:

| Version | Supported          |
| ------- | ------------------ |
| Latest (master) | :white_check_mark: |
| Development branches | :white_check_mark: |
| Archived versions    | :x:                |

## Reporting a Vulnerability

### How to Report

If you discover a security vulnerability in mysqli_mis, please report it responsibly:

### 1. Do Not Create Public Issues

**Never** open a public issue for security vulnerabilities. This could expose users to attacks.

### 2. Report Privately

Contact the repository maintainer directly:

- **GitHub**: Open a private security advisory
- **Email**: [Your secure email]
- **Direct**: Private message on GitHub

### 3. Include in Your Report

```
Subject: [SECURITY] [Severity] Brief Description

Vulnerability Type: [SQL Injection/XSS/Authentication Bypass/etc.]

Affected Files: [List specific PHP files]

Description:
[Detailed explanation of the vulnerability]

Steps to Reproduce:
1. [Step 1]
2. [Step 2]
3. [Step 3]

Impact:
[What data could be accessed? What actions could be performed?]

Proof of Concept:
[Code or screenshots demonstrating the issue]

Suggested Fix:
[Your recommendations if any]

Environment:
- PHP Version:
- MySQL Version:
- Web Server:
```

### 4. Response Timeline

- **Acknowledgment**: Within 48 hours
- **Initial Assessment**: Within 5 business days
- **Status Updates**: Weekly until resolved
- **Fix Timeline**:
  - Critical (data breach, remote code execution): 3-7 days
  - High (authentication bypass, SQL injection): 7-14 days
  - Medium (XSS, CSRF): 14-30 days
  - Low (information disclosure): Next release

---

## Common PHP/MySQL Security Risks

### 1. SQL Injection

**Risk**: Attackers can manipulate database queries  
**Status**: Protected via prepared statements

**❌ Vulnerable Code:**
```php
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($sql);
```

**✅ Secure Code:**
```php
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
```

### 2. Cross-Site Scripting (XSS)

**Risk**: Malicious scripts executed in users' browsers  
**Status**: Protected via output escaping

**❌ Vulnerable Code:**
```php
echo "<p>Welcome " . $_POST['username'] . "</p>";
```

**✅ Secure Code:**
```php
echo "<p>Welcome " . htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8') . "</p>";
```

### 3. Password Security

**Risk**: Weak password storage or hashing  
**Status**: Uses password_hash() with bcrypt

**❌ Vulnerable Code:**
```php
$password = md5($_POST['password']);  // MD5 is broken!
```

**✅ Secure Code:**
```php
$hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Verification
if (password_verify($_POST['password'], $hashedPassword)) {
    // Password is correct
}
```

### 4. Session Hijacking

**Risk**: Attackers steal or manipulate sessions  
**Prevention**:

```php
// In all authenticated pages
session_start();

// Regenerate session ID on login
session_regenerate_id(true);

// Set secure session parameters
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);  // If using HTTPS
ini_set('session.use_strict_mode', 1);
```

### 5. File Upload Vulnerabilities

**Risk**: Malicious file uploads (if implemented)  
**Prevention**:

```php
// Validate file type
$allowed = ['jpg', 'jpeg', 'png', 'pdf'];
$ext = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));

if (!in_array($ext, $allowed)) {
    die("Invalid file type");
}

// Validate file size (5MB max)
if ($_FILES['file']['size'] > 5242880) {
    die("File too large");
}

// Use random filename
$newName = bin2hex(random_bytes(16)) . '.' . $ext;

// Store outside web root if possible
move_uploaded_file($_FILES['file']['tmp_name'], '/secure/uploads/' . $newName);
```

### 6. CSRF (Cross-Site Request Forgery)

**Risk**: Unauthorized actions performed on behalf of authenticated users  
**Prevention**:

```php
// Generate CSRF token
session_start();
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// In forms
<input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

// Validate on submission
if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
    die("CSRF token validation failed");
}
```

### 7. Authentication Bypass

**Risk**: Unauthorized access to protected pages  
**Prevention**:

```php
// At the top of every protected page
session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit();
}

// For admin pages
if ($_SESSION['role'] !== 'admin') {
    header("Location: landingPage.php");
    exit();
}
```

### 8. Email Header Injection

**Risk**: Spam or phishing via email forms  
**Prevention**:

```php
// Validate email
$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
if (!$email) {
    die("Invalid email");
}

// Remove newlines from inputs
$email = str_replace(["\r", "\n"], '', $email);
$name = str_replace(["\r", "\n"], '', $_POST['name']);

// Use PHPMailer instead of mail()
```

---

## Security Checklist

### Before Every Commit

- [ ] No hardcoded database credentials
- [ ] All user inputs validated and sanitized
- [ ] SQL queries use prepared statements
- [ ] Output escaped with htmlspecialchars()
- [ ] Passwords hashed with password_hash()
- [ ] Session security configured
- [ ] No sensitive data in error messages

### Database Security

- [ ] Use prepared statements for ALL queries
- [ ] Limit database user permissions
- [ ] Use different database users for different operations
- [ ] Never display raw SQL errors to users
- [ ] Regular database backups

**Example - Limited Database User:**
```sql
-- Create read-only user for SELECT operations
CREATE USER 'app_reader'@'localhost' IDENTIFIED BY 'strong_password';
GRANT SELECT ON mysqli_mis.* TO 'app_reader'@'localhost';

-- Create write user for INSERT, UPDATE, DELETE
CREATE USER 'app_writer'@'localhost' IDENTIFIED BY 'strong_password';
GRANT SELECT, INSERT, UPDATE, DELETE ON mysqli_mis.* TO 'app_writer'@'localhost';

FLUSH PRIVILEGES;
```

### Input Validation

```php
// Validate all inputs
function validateInput($data, $type) {
    $data = trim($data);
    $data = stripslashes($data);
    
    switch($type) {
        case 'email':
            return filter_var($data, FILTER_VALIDATE_EMAIL);
        case 'int':
            return filter_var($data, FILTER_VALIDATE_INT);
        case 'string':
            return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
        case 'username':
            // Alphanumeric only, 3-20 chars
            return preg_match('/^[a-zA-Z0-9]{3,20}$/', $data) ? $data : false;
        default:
            return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    }
}

// Usage
$username = validateInput($_POST['username'], 'username');
$email = validateInput($_POST['email'], 'email');
$age = validateInput($_POST['age'], 'int');
```

### Configuration Security

**php.ini Settings:**

```ini
; Hide PHP version
expose_php = Off

; Disable dangerous functions
disable_functions = exec,passthru,shell_exec,system,proc_open,popen

; Error handling (production)
display_errors = Off
log_errors = On
error_log = /var/log/php_errors.log

; Session security
session.cookie_httponly = 1
session.cookie_secure = 1
session.use_strict_mode = 1
session.cookie_samesite = "Strict"
```

**.htaccess Protection:**

```apache
# Prevent directory listing
Options -Indexes

# Protect connections.php
<Files connections.php>
    Order Allow,Deny
    Deny from all
</Files>

# Protect composer files
<FilesMatch "(composer\.(json|lock)|\.env)">
    Order Allow,Deny
    Deny from all
</FilesMatch>

# Force HTTPS (if available)
RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

---

## Secure Coding Practices

### 1. Database Connection

**connections.php (Secure Version):**

```php
<?php
// Load environment variables
require_once 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Database configuration
$servername = $_ENV['DB_HOST'] ?? 'localhost';
$username = $_ENV['DB_USER'];
$password = $_ENV['DB_PASS'];
$database = $_ENV['DB_NAME'];

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    error_log("Database connection failed: " . $conn->connect_error);
    die("Connection failed. Please try again later.");
}

// Set charset to prevent SQL injection via charset
$conn->set_charset("utf8mb4");
?>
```

### 2. Secure Login

**login.php (Secure Version):**

```php
<?php
session_start();
require_once 'connections.php';

// Generate CSRF token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate CSRF token
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'] ?? '')) {
        die("CSRF validation failed");
    }
    
    // Validate inputs
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = $_POST['password'];
    
    if (empty($username) || empty($password)) {
        $error = "Please fill in all fields";
    } else {
        // Prepare statement
        $stmt = $conn->prepare("SELECT id, username, password, role, is_verified FROM users WHERE username = ? LIMIT 1");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            
            // Verify password
            if (password_verify($password, $user['password'])) {
                // Check if verified
                if ($user['is_verified'] == 0) {
                    $error = "Please verify your email first";
                } else {
                    // Regenerate session ID
                    session_regenerate_id(true);
                    
                    // Set session variables
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['role'] = $user['role'];
                    $_SESSION['logged_in'] = true;
                    
                    // Redirect
                    header("Location: landingPage.php");
                    exit();
                }
            } else {
                $error = "Invalid username or password";
            }
        } else {
            $error = "Invalid username or password";
        }
        $stmt->close();
    }
}
?>
```

### 3. Secure Registration

**signup.php (Secure Version):**

```php
<?php
require_once 'connections.php';
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate inputs
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    
    $errors = [];
    
    // Validation
    if (empty($username) || !preg_match('/^[a-zA-Z0-9]{3,20}$/', $username)) {
        $errors[] = "Username must be 3-20 alphanumeric characters";
    }
    
    if (!$email) {
        $errors[] = "Invalid email address";
    }
    
    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters";
    }
    
    if ($password !== $confirmPassword) {
        $errors[] = "Passwords do not match";
    }
    
    if (empty($errors)) {
        // Check if username/email exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        
        if ($stmt->get_result()->num_rows > 0) {
            $errors[] = "Username or email already exists";
        } else {
            // Hash password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            // Generate verification code
            $verificationCode = bin2hex(random_bytes(32));
            
            // Insert user
            $stmt = $conn->prepare("INSERT INTO users (username, email, password, verification_code) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $username, $email, $hashedPassword, $verificationCode);
            
            if ($stmt->execute()) {
                // Send verification email (implement with PHPMailer)
                header("Location: signupSuccess.php");
                exit();
            } else {
                $errors[] = "Registration failed. Please try again.";
            }
        }
        $stmt->close();
    }
}
?>
```

---

## Security Tools

### Recommended Tools

1. **OWASP ZAP** - Web application security scanner
2. **SQLMap** - SQL injection testing
3. **Burp Suite** - Web vulnerability scanner
4. **PHP Security Checker** - Dependency vulnerability scanner
5. **SonarQube** - Code quality and security analysis

### Running Security Scans

```bash
# Check for vulnerable dependencies
composer require --dev sensiolabs/security-checker
php vendor/bin/security-checker security:check composer.lock

# Static analysis
composer require --dev phpstan/phpstan
vendor/bin/phpstan analyse src/
```

---

## Incident Response

### If a Breach Occurs

1. **Immediately**:
   - Take affected systems offline
   - Change all passwords and API keys
   - Preserve logs for investigation

2. **Within 24 hours**:
   - Notify affected users
   - Document the incident
   - Begin forensic analysis

3. **Within 72 hours**:
   - Implement fixes
   - Deploy patches
   - Conduct security audit

---

## Security Contacts

**Repository Owner**: achille010  
**Security Email**: [Your secure email]  
**Emergency**: [Emergency contact method]

## Security Updates

This security policy is reviewed and updated quarterly.

**Last Reviewed**: March 2026  
**Next Review**: June 2026

---

*Thank you for helping keep mysqli_mis secure!* 🔒