# Store Management System

## Overview

The Store Management System is a web application designed to manage various aspects of a store. It includes functionalities for managing employees, items, transactions, and generating bills. The system uses PHP, MySQL, HTML, CSS, and JavaScript.

## Features

- **Employee Management**: Admins can view, add, edit, and delete employee records.
- **Item Management**: Admins can view, add, edit, and delete item records.
- **Bill Generation**: Employees can create bills for items, which updates item stock and records transactions.
- **Transaction Records**: Admins can view all transactions with filtering options and aggregated data.

## Project Structure

- `index.php`: Main dashboard and navigation page.
- `employee.php`: Page for viewing and managing employee records.
- `item.php`: Page for viewing and managing item records.
- `bill.php`: Page for generating bills and updating item stock.
- `transaction.php`: Page for viewing transaction records with filtering and aggregate data.
- `add.php`: Page for adding new employees.
- `edit.php`: Page for editing existing employees.
- `delete.php`: Script for deleting employees.
- `additem.php`: Page for adding new items.
- `edititem.php`: Page for editing existing items.
- `deleteitem.php`: Script for deleting items.
- `auth.php`: Authentication script for user login validation.
- `connectionString.php`: Database connection script.

## Installation

1. **download the zip file**
 
2. **after extracting the zip file** 
 - put the folder student-management-project in  (`xampp/htdocs`) into your MySQL database.

3. **Set Up Database**

   - Import the database schema (`dummy dataset/dummyset.sql`) into your MySQL database.

4. **Configure Database Connection**

   - Update `connectionString.php` with your MySQL database credentials:

     ```php
     <?php
     $host = "localhost"; // Database host
     $user = "root"; // Database username
     $password = ""; // Database password
     $database = "your_database"; // Database name
     
     $con = mysqli_connect($host, $user, $password, $database);
     
     if (mysqli_connect_errno()) {
         die("Failed to connect to MySQL: " . mysqli_connect_error());
     }
     ?>
     ```

5. **Run the Application**

   - Start a local server (e.g., using XAMPP, WAMP, or any other PHP server).
   - Open the application in your web browser:

     ```
     http://localhost/store-management-system/
     ```

## Usage

- **Login**: Use the login page to authenticate users. Admins, managers, and employees have different access levels.
- **Manage Employees**: Access the employee management page to view, add, edit, or delete employee records.
- **Manage Items**: Use the item management page to view, add, edit, or delete item records.
- **Generate Bills**: Employees can generate bills for items on the billing page, which updates the item stock and records transactions.
- **View Transactions**: Admins can view and filter transaction records and see aggregate totals on the transaction page.



### Notes:



- **Database Schema (`dummy dataset`)**: Include a `dummyset.sql` file in your project that defines the structure of your MySQL database tables (`user`,`item_table`,`transaction`)


- **Use credential (`for login as super admin`)**: (`shrish`,`1234`) or (`admin`,`1234`)