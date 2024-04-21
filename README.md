# CRUD Todo App

This is a simple CRUD (Create, Read, Update, Delete) application built with PHP and MySQL. The application allows you to:

- Add new students
- Update student information
- Delete students
- index.php a list of all students records 

## Files and Structure

- `index.php`: Displays a table with all student records and provides options to add, update, and delete records.
- `insert_data.php`: Handles the insertion of new student records into the database.
- `update_page_1.php`: Displays a form to update student information and updates the database accordingly.
- `delete_page.php`: Deletes a student record from the database based on the provided ID.
- `dbcon.php`: Establishes a connection to the MySQL database using PDO.

## Technologies Used

- PHP
- MySQL
- Bootstrap (for styling)

## Setup

1. Clone the repository
2. Set up a Docker environment with PHP and MySQL
3. Import the database schema (`04Crud-Todo-app.sql`) into MySQL
4. Update `dbcon.php` with your database credentials
5. run 'php -S localhost:8000 in the terminal and select the open in brwoser option'.

## How to Use

1. Access `index.php` to view the list of students and perform CRUD operations.
2. Click the "Add Students" button to add a new student.
3. Use the dropdown menu in each row to update or delete a student record.
4. Fill out the form in `update_page_1.php` to update a student's information.
5. Click the "UPDATE" button to save the changes.
6. Click the "Delete" option in the dropdown menu to delete a student record.
7. 

## Database Monitoring with Adminer

To monitor and manage the database, follow these steps:

1. Open a new tab and enter `localhost:8000`. This will take you to Adminer.
2. Provide the following credentials:
    - **Server**: `db`
    - **Username**: `root`
    - **Password**: `mariadb`
    - **Database**: `m04Crud-Todo-app`
3. This page enables you to observe real-time changes reflected on the database.
