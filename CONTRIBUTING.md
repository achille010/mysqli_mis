# Contributing to mysqli_mis

Thank you for your interest in contributing to mysqli_mis! This guide will help you get started.

---

## Table of Contents

- [Getting Started](#getting-started)
- [Development Setup](#development-setup)
- [How to Contribute](#how-to-contribute)
- [Code Standards](#code-standards)
- [Security Guidelines](#security-guidelines)
- [Database Changes](#database-changes)
- [Testing](#testing)
- [Pull Request Process](#pull-request-process)

---

## Getting Started

### Prerequisites

- **PHP** 7.4 or higher
- **MySQL** 5.7 or higher
- **Composer** for dependency management
- **Git** for version control
- A local web server (Apache/Nginx or PHP built-in)

### Required Knowledge

- PHP fundamentals and MySQLi
- HTML/CSS basics
- SQL and database design
- Security best practices

---

## Development Setup

### 1. Fork and Clone

```bash
git clone https://github.com/YOUR_USERNAME/mysqli_mis.git
cd mysqli_mis
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Set Up Database

```sql
CREATE DATABASE mysqli_mis;
USE mysqli_mis;

-- Run your schema.sql or create tables manually
```

### 4. Configure Environment

Create a `.env` file (never commit this!):

```env
DB_HOST=localhost
DB_USER=root
DB_PASS=your_password
DB_NAME=mysqli_mis

MAIL_HOST=smtp.gmail.com
MAIL_USER=your_email@gmail.com
MAIL_PASS=your_app_password
```

Update `connections.php` to use environment variables.

### 5. Start Development Server

```bash
php -S localhost:8000
```

Visit `http://localhost:8000` to see the application.

---

## How to Contribute

### Types of Contributions

- 🐛 **Bug Fixes** - Fix issues or unexpected behavior
- ✨ **New Features** - Add functionality
- 🔒 **Security** - Improve security
- 📝 **Documentation** - Improve docs or comments
- 🎨 **UI/UX** - Improve design and user experience
- 🗄️ **Database** - Schema improvements
- 🧪 **Testing** - Add tests

### Before You Start

1. Check [existing issues](https://github.com/achille010/mysqli_mis/issues)
2. Open an issue to discuss major changes
3. Keep contributions focused
4. Follow the code standards

---

## Code Standards

### PHP Coding Style

We follow PSR-12 coding standards.

#### General Rules

- Use **4 spaces** for indentation (not tabs)
- Opening braces `{` on the same line
- Closing braces `}` on their own line
- Use **meaningful variable names**
- Add **PHPDoc comments** for functions
- Keep functions **small and focused**
- **Always** validate inputs
- **Always** use prepared statements

#### Examples

**✅ GOOD:**

```php
<?php
/**
 * Validate and sanitize user input
 * 
 * @param string $input The input to validate
 * @param string $type The type of validation
 * @return mixed Validated input or false
 */
function validateInput($input, $type = 'string') {
    $input = trim($input);
    $input = stripslashes($input);
    
    switch ($type) {
        case 'email':
            return filter_var($input, FILTER_VALIDATE_EMAIL);
        case 'int':
            return filter_var($input, FILTER_VALIDATE_INT);
        case 'string':
            return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
        default:
            return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    }
}

/**
 * Get user by ID using prepared statement
 * 
 * @param mysqli $conn Database connection
 * @param int $userId User ID
 * @return array|null User data or null
 */
function getUserById($conn, $userId) {
    $stmt = $conn->prepare("SELECT id, username, email FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        return $result->fetch_assoc();
    }
    
    $stmt->close();
    return null;
}
```

**❌ BAD:**

```php
<?php
// No comments, unclear names, no validation
function g($i) {
    return mysqli_query($conn, "SELECT * FROM users WHERE id=$i");
}

// SQL injection vulnerable!
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($sql);

// No error handling
$stmt->execute();
```

### HTML/CSS Standards

- Use **semantic HTML5** tags
- Keep CSS organized and commented
- Use **mobile-first** responsive design
- Follow **accessibility** guidelines
- Escape all user-generated content

```html
<!-- ✅ GOOD -->
<form method="POST" action="login.php">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
    
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>
    
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    
    <button type="submit">Login</button>
</form>

<!-- ❌ BAD - No CSRF protection, no labels -->
<form method="POST">
    <input name="user">
    <input name="pass" type="password">
    <input type="submit">
</form>
```

### SQL Standards

- Use **prepared statements** for ALL queries
- Use **meaningful table/column names**
- Add **indexes** for frequently queried columns
- Include **foreign key constraints**
- Write **clear comments** for complex queries

```sql
-- ✅ GOOD
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user',
    is_verified TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_username (username),
    INDEX idx_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ❌ BAD - No constraints, poor naming
CREATE TABLE tbl1 (
    i INT,
    n VARCHAR(50),
    p VARCHAR(50)
);
```

### File Naming

| Type | Convention | Example |
|------|------------|---------|
| PHP files | camelCase.php | `landingPage.php` |
| Config files | lowercase.php | `connections.php` |
| CSS files | kebab-case.css | `main-style.css` |
| SQL files | lowercase.sql | `schema.sql` |

---

## Security Guidelines

### Critical Security Rules

1. **NEVER** use string concatenation in SQL queries
2. **ALWAYS** use prepared statements
3. **ALWAYS** hash passwords with `password_hash()`
4. **ALWAYS** validate and sanitize inputs
5. **ALWAYS** escape outputs with `htmlspecialchars()`
6. **NEVER** commit `.env` or database credentials
7. **ALWAYS** use CSRF tokens on forms
8. **ALWAYS** check authentication on protected pages

### Security Checklist

Before submitting code:

- [ ] All SQL queries use prepared statements
- [ ] All user inputs validated
- [ ] All outputs escaped
- [ ] Passwords hashed, never stored plain
- [ ] CSRF tokens on all forms
- [ ] Session security properly configured
- [ ] No sensitive data in error messages
- [ ] Authentication checked on protected pages

### Example - Secure CRUD Operation

**Create (INSERT):**

```php
<?php
session_start();
require_once 'connections.php';

// Check authentication
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate CSRF token
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'] ?? '')) {
        die("CSRF validation failed");
    }
    
    // Validate inputs
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $age = filter_var($_POST['age'], FILTER_VALIDATE_INT);
    
    if (empty($name) || !$email || !$age) {
        $error = "Please fill in all fields correctly";
    } else {
        // Prepared statement
        $stmt = $conn->prepare("INSERT INTO records (name, email, age, user_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssii", $name, $email, $age, $_SESSION['user_id']);
        
        if ($stmt->execute()) {
            header("Location: read.php?success=1");
            exit();
        } else {
            error_log("Insert failed: " . $stmt->error);
            $error = "Failed to create record";
        }
        $stmt->close();
    }
}
?>
```

---

## Database Changes

### Making Schema Changes

1. **Never** modify production database directly
2. Create a migration SQL file
3. Document the change
4. Test on development database first

### Migration File Example

Create `migrations/001_add_user_roles.sql`:

```sql
-- Migration: Add role column to users table
-- Date: 2026-03-18
-- Author: Your Name

-- Add role column
ALTER TABLE users 
ADD COLUMN role ENUM('user', 'admin') DEFAULT 'user' AFTER password;

-- Add index
CREATE INDEX idx_role ON users(role);

-- Update existing users (optional)
UPDATE users SET role = 'admin' WHERE username = 'admin';
```

### Documenting Database Changes

Update `database_schema.md`:

```markdown
## Users Table

| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| id | INT | PRIMARY KEY, AUTO_INCREMENT | User ID |
| username | VARCHAR(50) | UNIQUE, NOT NULL | Username |
| email | VARCHAR(100) | UNIQUE, NOT NULL | Email address |
| password | VARCHAR(255) | NOT NULL | Hashed password |
| role | ENUM('user','admin') | DEFAULT 'user' | User role |
| is_verified | TINYINT(1) | DEFAULT 0 | Email verified |
| created_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP | Creation time |
```

---

## Testing

### Manual Testing Checklist

Before submitting a PR, test:

#### Authentication
- [ ] Registration with valid data
- [ ] Registration with invalid data
- [ ] Email verification link
- [ ] Login with correct credentials
- [ ] Login with incorrect credentials
- [ ] Logout functionality
- [ ] Session persistence

#### CRUD Operations
- [ ] Create new record
- [ ] Read/view records
- [ ] Update existing record
- [ ] Delete record
- [ ] Input validation
- [ ] Error handling

#### Security
- [ ] SQL injection attempts
- [ ] XSS attempts
- [ ] CSRF protection
- [ ] Authentication bypass attempts
- [ ] Session hijacking prevention

### Test Scenarios

**SQL Injection Test:**

```
Username: admin' OR '1'='1
Password: anything
Expected: Login fails, no SQL error shown
```

**XSS Test:**

```
Name: <script>alert('XSS')</script>
Expected: Script tags escaped, alert doesn't fire
```

---

## Pull Request Process

### 1. Create a Branch

```bash
git checkout -b feature/add-password-reset
# or
git checkout -b fix/login-session-bug
```

### 2. Make Changes

- Write clean code
- Follow security guidelines
- Add comments
- Test thoroughly

### 3. Commit Changes

```bash
git add .
git commit -m "feat: add password reset functionality"
```

**Commit Message Format:**

```
<type>: <description>

[optional body]

[optional footer]
```

**Types:**
- `feat` - New feature
- `fix` - Bug fix
- `security` - Security fix
- `docs` - Documentation
- `style` - Code style/formatting
- `refactor` - Code refactoring
- `test` - Adding tests
- `chore` - Maintenance

### 4. Push to Your Fork

```bash
git push origin feature/add-password-reset
```

### 5. Open Pull Request

**Title:**
```
feat: Add password reset functionality
```

**Description Template:**

```markdown
## Description
Brief description of what this PR does.

## Type of Change
- [ ] Bug fix
- [ ] New feature
- [ ] Security fix
- [ ] Breaking change
- [ ] Documentation update

## Changes Made
- Added password reset request page
- Implemented email with reset token
- Created password reset form
- Updated database schema

## Security Considerations
- Uses secure random tokens
- Token expires after 1 hour
- Rate limited to prevent abuse
- All inputs validated and sanitized

## Testing
- [ ] Tested registration flow
- [ ] Tested reset email delivery
- [ ] Tested token validation
- [ ] Tested password update
- [ ] Tested expired tokens
- [ ] Tested invalid tokens

## Database Changes
- [ ] Added `password_reset_tokens` table
- [ ] Migration file included
- [ ] Schema documented

## Checklist
- [ ] Code follows project standards
- [ ] Security guidelines followed
- [ ] All inputs validated
- [ ] All queries use prepared statements
- [ ] Documentation updated
- [ ] Manually tested
- [ ] No sensitive data in commits

## Screenshots
[Add screenshots if UI changes]
```

### 6. Code Review

- Address feedback promptly
- Push additional commits to same branch
- Discuss changes constructively

---

## Code Review Guidelines

### For Contributors

- Be responsive to feedback
- Accept criticism gracefully
- Explain your approach
- Ask for clarification if needed

### For Reviewers

- Be constructive and kind
- Focus on code, not the person
- Explain reasoning
- Acknowledge good work
- Check for security issues

**Review Checklist:**

- [ ] Code follows standards
- [ ] Security guidelines met
- [ ] SQL injection prevented
- [ ] XSS prevented
- [ ] CSRF protection included
- [ ] Authentication properly checked
- [ ] Inputs validated
- [ ] Outputs escaped
- [ ] Error handling appropriate
- [ ] No credentials in code
- [ ] Documentation updated

---

## Getting Help

### Resources

- [README.md](README.md) - Project overview
- [SECURITY.md](SECURITY.md) - Security guidelines
- [Issues](https://github.com/achille010/mysqli_mis/issues) - Bug reports and features

### Questions?

1. Check existing documentation
2. Search issues
3. Open a new issue with "question" label
4. Be specific and provide context

---

## Recognition

Contributors will be recognized in:

- GitHub contributors list
- Release notes
- README acknowledgments (major contributions)

---

## Code of Conduct

Follow our [Code of Conduct](CODE_OF_CONDUCT.md). Be respectful, professional, and collaborative.

---

## License

By contributing, you agree your contributions will be licensed under the MIT License.

---

**Thank you for contributing to mysqli_mis!** 🙏

Your contributions make this project better and help others learn PHP/MySQL development.

---

**Last Updated**: March 2026  
**Maintained by**: achille010