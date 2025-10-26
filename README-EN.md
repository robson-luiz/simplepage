# SimplePage - Content Management System

[🇧🇷 Português](README.md)

[![PHP](https://img.shields.io/badge/PHP-7.4+-777BB4?style=flat-square&logo=php&logoColor=white)](https://php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-5.7+-4479A1?style=flat-square&logo=mysql&logoColor=white)](https://mysql.com/)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=flat-square&logo=bootstrap&logoColor=white)](https://getbootstrap.com/)
[![JavaScript](https://img.shields.io/badge/JavaScript-ES6+-F7DF1E?style=flat-square&logo=javascript&logoColor=black)](https://developer.mozilla.org/docs/Web/JavaScript)

> Complete content management system built with pure PHP featuring a responsive admin panel and modern institutional website.

## 📋 Table of Contents

- [About the Project](#-about-the-project)
- [Features](#-features)
- [Technologies Used](#-technologies-used)
- [Prerequisites](#-prerequisites)
- [Installation](#-installation)
- [Configuration](#-configuration)
- [Usage](#-usage)
- [Project Structure](#-project-structure)
- [Improvements Implemented (2025)](#-improvements-implemented-2025)
- [Contributing](#-contributing)
- [License](#-license)
- [Author](#-author)

## 🎯 About the Project

**SimplePage** is a content management system (CMS) originally developed in 2017 and completely refactored in 2025. The project offers a complete solution for creating and managing institutional websites, focusing on ease of use and efficient administration.

### 📸 Screenshots

#### 🌐 Public Website
<div align="center">
  <img src="https://imgur.com/4jSGmHr" alt="Homepage SimplePage" width="800">
  <br>
  <em>Homepage with modern and responsive design</em>
</div>

#### 🖥️ Admin Panel
<div align="center">
  <img src="https://imgur.com/OyoBIKV" alt="Dashboard SimplePage" width="800">
  <br>
  <em>Dashboard with modern design</em>  
</div>

### History
- **2017**: Initial development of basic structure
- **2025**: Complete refactoring with technological modernization and implementation of new features

## ✨ Features

### 🖥️ Admin Panel
- **Dashboard** with real-time statistics
- **User Management** with different access levels
- **Services CRUD** with ordering system
- **Contact Management** with status system
- **Content Editor** for Home and About pages
- **Image Upload** with validation and automatic organization
- **Secure Authentication System** with sessions
- **Responsive Interface** for all devices

### 🌐 Public Website
- **Responsive Layout** adaptable to any device
- **Single Page Application** with smooth navigation
- **Dynamic Services Section** customizable
- **Contact Form** with complete validation
- **Modern Design** with animations and visual effects
- **SEO Optimized** with meta tags and semantic structure

### 🔧 Technical Features
- **PDO Architecture** for database security
- **Double Validation** (client-side and server-side)
- **Logging System** for auditing
- **Modular Code Organization**
- **Robust Error Handling**
- **Vulnerability Prevention** (SQL Injection, XSS, CSRF)

## 🛠 Technologies Used

### Backend
- **PHP 7.4+** - Main programming language
- **PDO (PHP Data Objects)** - Database access interface
- **MySQL 5.7+** - Database management system

### Frontend
- **HTML5** - Semantic structure
- **CSS3** - Advanced styling with Flexbox and Grid
- **JavaScript ES6+** - Interactivity and validations
- **Bootstrap 5.3** - Responsive CSS framework
- **Font Awesome 6.4** - Icon library

### Tools and Libraries
- **TinyMCE** - WYSIWYG editor for content
- **jQuery** - DOM manipulation (compatibility)

## 📋 Prerequisites

Before starting, make sure you have installed:

- **Web Server** (Apache, Nginx)
- **PHP 7.4** or higher with extensions:
  - PDO MySQL
  - GD Library (for image manipulation)
  - mbstring
  - fileinfo
- **MySQL 5.7** or higher / **MariaDB 10.2** or higher
- **Composer** (optional, for future dependencies)

### Recommended Development Environment
- **XAMPP** / **LARAGON** / **WAMP** for Windows
- **LAMP** / **LEMP** for Linux
- **MAMP** for macOS

## 🚀 Installation

### 1. Clone the Repository
```bash
git clone https://github.com/robson-luiz/simplepage.git
cd simplepage
```

### 2. Web Server Configuration
Point the web server to the project folder or move files to the web root directory:

```bash
# For Apache (Ubuntu/Debian)
sudo cp -r simplepage/ /var/www/html/

# For XAMPP (Windows)
# Copy folder to C:\xampp\htdocs\

# For LARAGON (Windows)
# Copy folder to C:\laragon\www\
```

### 3. Database Configuration

#### Database Creation
```sql
CREATE DATABASE simplepage CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

#### Tables Import
```bash
mysql -u your_username -p simplepage < simplepage.sql
```

Or through phpMyAdmin:
1. Access phpMyAdmin
2. Select the `simplepage` database
3. Import the `simplepage.sql` file

### 4. Connection Configuration
Edit the file `adm/conexao/conexao.php`:

```php
<?php
// Database configuration
$servidor = "localhost";
$usuario = "your_username";
$senha = "your_password";
$dbname = "simplepage";

try {
    $conn = new PDO("mysql:host=$servidor;dbname=$dbname;charset=utf8mb4", $usuario, $senha);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
```

### 5. Permissions Configuration
```bash
# Set correct permissions (Linux/macOS)
chmod -R 755 simplepage/
chmod -R 777 simplepage/adm/assets/imagens/
```

## ⚙️ Configuration

### Basic Settings

#### Default Administrator User
- **Email**: `admin@simplepage.com`
- **Password**: `123456`

> ⚠️ **Important**: Change default credentials immediately after first installation!

#### Upload Folder Structure
```
adm/assets/imagens/
└── usuarios/
    ├── 1/
    │   └── foto.[ext]
    ├── 2/
    │   └── foto.[ext]
    └── ...

adm/uploads/
├── home/
│   └── [id]/
│       └── foto.[ext]
└── sobre/
    └── [id]/
        └── foto.[ext]
```

### Advanced Settings

#### Upload Configuration
The system implements upload validation directly in processing files. Settings are defined inline in the files:
- Allowed extensions: `['jpg', 'jpeg', 'png', 'gif', 'webp']`
- Maximum size: Limited by PHP settings (`upload_max_filesize` and `post_max_size`)
- Directory structure: Automatically created by ID

**Real implementation example:**
```php
// Extension validation (used in processing files)
$extensoes_permitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
$ext = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));
if (in_array($ext, $extensoes_permitidas)) {
    // Process upload
}
```

## 💻 Usage

### System Access

#### Public Website
```
http://localhost/simplepage/
```

#### Admin Panel
```
http://localhost/simplepage/adm/
```

### Getting Started

1. **Access the admin panel** with default credentials
2. **Change the password** of the administrator user
3. **Configure content** for Home and About pages
4. **Register services** of the company/organization
5. **Test the contact form**
6. **Adjust the design** as needed

### User Management

#### Access Levels
- **Admin**: Full system access
- **Editor**: Limited access for content editing
- **Viewer**: View only (future functionality)

#### User Registration
1. Access **Users > Register**
2. Fill in required data
3. Select access level
4. Upload photo (optional)

### Content Management

#### Page Editing
- **Home**: Configure banner, presentation text and calls-to-action
- **About**: Define company history and information

#### Services Management
- Register services with Font Awesome icons
- Set display order
- Configure status (active/inactive)

#### Contact System
- View received messages
- Mark as read/responded
- Organize with status system

## 📁 Project Structure

```
simplepage/
├── 📁 adm/                          # Admin panel
│   ├── 📁 administrador/            # Administrative modules
│   │   ├── 📁 cadastro/            # Registration forms
│   │   ├── 📁 editar/              # Edit forms
│   │   ├── 📁 listar/              # Listings and tables
│   │   ├── 📁 processa/            # Form processing
│   │   └── 📁 visualizar/          # Detail pages
│   ├── 📁 assets/                   # Admin static resources
│   │   └── 📁 imagens/             # Image uploads
│   ├── 📁 conexao/                  # Database configuration
│   ├── 📁 css/                      # Admin styles
│   ├── 📁 js/                       # Admin scripts
│   └── 📁 lib/                      # External libraries
├── 📁 css/                          # Public site styles
├── 📁 images/                       # Public site images
├── 📁 includes/                     # Functions and utilities
├── 📁 js/                           # Public site scripts
├── 📄 index.php                     # Main page
├── 📄 menu.php                      # Navigation menu
├── 📄 footer.php                    # Footer
├── 📄 simplepage.sql                # Database structure
└── 📄 README.md                     # Documentation
```

### Main Files

#### Backend
- `index.php` - Main site page
- `adm/administracao.php` - Admin dashboard
- `includes/funcoes.php` - Utility functions
- `adm/conexao/conexao.php` - Database configuration

#### Frontend
- `css/style.css` - Main site styles
- `adm/css/style.css` - Admin styles
- `js/admin.js` - Centralized admin scripts

## 🔄 Improvements Implemented (2025)

### 🚀 Technical Modernization

#### PDO Migration
- **Before**: MySQLi with direct queries
- **After**: PDO with prepared statements
- **Benefits**: Higher security, better error handling, portability

#### Function Centralization
- **Before**: Duplicated code in multiple files
- **After**: Centralized functions in `includes/funcoes.php`
- **Benefits**: Maintainability, reusability, consistency

#### JavaScript Organization
- **Before**: Inline scripts on each page
- **After**: Centralized `admin.js` file
- **Benefits**: Better organization, browser cache, easier debugging

### 🎨 Interface Improvements

#### Responsive Design
- **Mobile-first** approach
- **Responsive tables** with cards on mobile devices
- **Collapsible sidebar** menu in admin
- **Touch-optimized forms** for mobile devices

#### Modal System
- **Elegant confirmations** for deletions
- **Visual feedback** for user actions
- **Asynchronous content** loading

#### Double Validation
- **Client-side**: Immediate validation with JavaScript
- **Server-side**: Robust validation with PHP
- **Visual feedback**: Clear error/success indicators

### 🔒 Security Improvements

#### Vulnerability Prevention
- **SQL Injection**: Exclusive use of prepared statements
- **XSS**: Sanitization of all inputs
- **CSRF**: Security tokens in critical forms
- **Secure Upload**: Rigorous file validation

#### Authentication System
- **Secure sessions** with ID regeneration
- **Hashed passwords** with modern algorithms
- **Automatic timeout** of sessions
- **Access logs** for auditing

### 📊 New Features

#### Contact CRUD
- **Complete system** for message management
- **Advanced filters** by status and content
- **Bulk actions** for batch operations
- **Status tracking** (new, read, responded, archived)

#### Advanced Dashboard
- **Real-time statistics** of users, services and contacts
- **Interactive charts** (prepared for implementation)
- **Quick actions** for common tasks
- **Notifications** for new contacts

#### Upload System
- **Automatic organization** by user ID
- **Rigorous validation** of types and sizes
- **Automatic resizing** of images
- **Automatic cleanup** when deleting records

## 🔮 Planned Improvements

### 🎯 Next Implementations

#### Interface Improvements
- **Admin panel responsiveness** - Enhanced mobile experience in admin

## Contributing

Contributions are always welcome! To contribute:

1. **Fork** the project
2. Create a **branch** for your feature (`git checkout -b feature/new-feature`)
3. **Commit** your changes (`git commit -m 'Add new feature'`)
4. **Push** to the branch (`git push origin feature/new-feature`)
5. Open a **Pull Request**

### Contributing Guidelines

- Keep code clean and well documented
- Follow existing coding standards
- Test your changes before submitting
- Update documentation when necessary

### Report Bugs

Use [GitHub Issues](https://github.com/robson-luiz/simplepage/issues) to report bugs, including:
- Detailed problem description
- Steps to reproduce
- Environment (OS, PHP version, browser)
- Screenshots (if applicable)

## 📄 License

This project is licensed under the **MIT License** - see the [LICENSE](LICENSE) file for details.

### License Summary
- ✅ Commercial use allowed
- ✅ Modification allowed
- ✅ Distribution allowed
- ✅ Private use allowed
- ❌ Warranty not included
- ❌ Limited liability

## 👨‍💻 Author

**Robson Luiz**
- GitHub: [@robson-luiz](https://github.com/robson-luiz)
- LinkedIn: [Robson Luiz](https://linkedin.com/in/robson-luiz)
- Email: robsonluiz_6@hotmail.com

### Acknowledgments

- PHP community for documentation and support
- Bootstrap for the incredible CSS framework
- Font Awesome for free icons
- TinyMCE for the WYSIWYG editor

---

<div align="center">

**[⬆ Back to top](#simplepage---content-management-system)**

Developed by [Robson Luiz](https://github.com/robson-luiz)

</div>
