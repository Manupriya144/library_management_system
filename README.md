-start_date 2026_01_02
# 📚 Library Management System

![License](https://img.shields.io/badge/license-MIT-green)
![PHP](https://img.shields.io/badge/PHP-7%2B-blue)
![Database](https://img.shields.io/badge/Database-MySQL%2FMariaDB-orange)
![Frontend](https://img.shields.io/badge/Frontend-Bootstrap%205-purple)
![HTML](https://img.shields.io/badge/HTML-5-red)
![CSS](https://img.shields.io/badge/CSS-3-blue)
![Last Commit](https://img.shields.io/github/last-commit/Manupriya144/library_management_system)
![Issues](https://img.shields.io/github/issues/Manupriya144/library_management_system)
![Pull Requests](https://img.shields.io/github/issues-pr/Manupriya144/library_management_system)
![Stars](https://img.shields.io/github/stars/Manupriya144/library_management_system)


Library Management System is a web-based application designed to manage and automate library operations such as book management, user management, and book issuing/returning. Built using **PHP** and **MySQL** with a responsive **Bootstrap** frontend, this system provides an efficient and user-friendly solution for libraries.

---

## 🌟 Overview

The Library Management System helps librarians and administrators manage library resources digitally. It simplifies day-to-day operations by centralizing book records, member data, and transaction history.

### Key Benefits:
- Organized book and user management
- Easy tracking of issued and returned books
- Secure admin authentication
- Clean and responsive user interface

---

## ✨ Features

- **Admin Authentication**  
  Secure login and logout system for administrators

- **Book Management**  
  Add, update, view, and delete book records

- **User Management**  
  Manage library members and their details

- **Issue & Return Books**  
  Track book lending and returns efficiently

- **Database Integration**  
  MySQL database for persistent and reliable data storage

- **Responsive UI**  
  Mobile-friendly interface using Bootstrap

---

## 🛠️ Tech Stack

- **Backend:** PHP  
- **Frontend:** HTML, CSS, Bootstrap  
- **Database:** MySQL / MariaDB  
- **Server:** Apache (XAMPP / WAMP / LAMP)  

---

## 📦 Installation

### 1️⃣ Clone the Repository
```bash
git clone https://github.com/Manupriya144/library_management_system.git
```

2. **Move to Web Server Directory**:
    - Copy the project to your web server’s directory (e.g., `htdocs` for XAMPP).

3. **Configure Database**:
    - Update the database connection in `config.php`:
```php
<?php 


define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','library');
// Establish database connection.
try
{
$db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}
?>
```

4. **Set Up Database**:
    - Import the SQL schema.

5. **Start Server**:
    - Launch your server (e.g., XAMPP, WAMP, or LAMP).
    - Navigate to `http://localhost/library_management_system` in your browser.



## 🗄️ Database Schema
```sql
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

SET time_zone = '+05:30';   -- Sri Lanka / IST

START TRANSACTION;

CREATE DATABASE library;
USE ibrary;
The database consists of the following tables:
```
### admin
```sql
CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `FullName` varchar(100) DEFAULT NULL,
  `AdminEmail` varchar(120) DEFAULT NULL UNIQUE,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

```

### tblauthors
```sql
CREATE TABLE `tblauthors` (
  `id` int(11) NOT NULL,
  `AuthorName` varchar(159) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

```

### tblbooks
```sql
CREATE TABLE `tblbooks` (
  `id` int(11) NOT NULL,
  `BookName` varchar(255) DEFAULT NULL,
  `CatId` int(11) DEFAULT NULL,
  `AuthorId` int(11) DEFAULT NULL,
  `ISBNNumber` int(11) DEFAULT NULL,
  `BookPrice` int(11) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
```

### tblcategory
```sql
CREATE TABLE `tblcategory` (
  `id` int(11) NOT NULL,
  `CategoryName` varchar(150) DEFAULT NULL,
  `Status` int(1) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
```

### tblissuedbookdetails
```sql
CREATE TABLE `tblissuedbookdetails` (
  `id` int(11) NOT NULL,
  `BookId` int(11) DEFAULT NULL,
  `StudentID` varchar(150) DEFAULT NULL,
  `IssuesDate` timestamp NULL DEFAULT current_timestamp(),
  `ReturnDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `RetrunStatus` int(1) DEFAULT NULL,
  `fine` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
```
### tblstudents
```sql
CREATE TABLE `tblstudents` (
  `id` int(11) NOT NULL,
  `StudentId` varchar(100) DEFAULT NULL,
  `FullName` varchar(120) DEFAULT NULL,
  `EmailId` varchar(120) DEFAULT NULL,
  `MobileNumber` char(11) DEFAULT NULL,
  `Password` varchar(120) DEFAULT NULL,
  `Status` int(1) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
```



## 🚀 Usage
1. Navigate to `http://localhost/library_management_system` in your browser.
2. Register or log in to access the platform.
3.Add books and manage inventory.
4. Register users.
5.Issue and return books.
6.Monitor library activity through records.



## 🔮 Future Enhancements
-- Role-based access (Admin / Librarian / Member).
- Book search and filtering.
- Fine calculation for late returns.
- Email notifications.
- Report generation (PDF / Excel).
- UI enhancements.


## 🧑‍💻 Contributing
1. **Fork** the repository.
2. Create a new branch.
3. Add features, improve the UI, or enhance backend functionality.
4.Commit changes.
5.Submit a pull request with a clear description.

## 👨‍💻 Author
Developed by [Manupriya Ranjika](https://github.com/Manupriya144).
-published on 2026-01-22.
