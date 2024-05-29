# CRUD Todo App

This is a simple CRUD (Create, complete, Update, Delete) application built with PHP and MySQL. The application allows you to:

- Add new todos
- view existing todos
- Delete todos
- Mark todos as complete
- update todos 

## Files and Structure

- `index.php`: Displays a table with all student records and provides options to add, update, and delete records.
- `insert_data.php`: Handles the insertion of new todo records into the database.
- `update_page_1.php`: Displays a form to update todo lista information and updates the database accordingly.
- `delete_page.php`: Deletes a  todo record from the database based on the provided ID.
- `dbcon.php`: Establishes a connection to the MySQL database using PDO.
- `mark_complete`:Mark todos as completed by clicking the checkbox next to each todo .

## Technologies Used

- PHP
- MySQL
- Bootstrap (for styling)

## Setup

1. Clone the repository
2. Set up a Docker environment with PHP and MySQL
3. Import the database 
4. Update `dbcon.php` with your database credentials
5. run 'php -S localhost:8000 in the terminal and select the open in brwoser option'.

## How to Use

1. Access `index.php` to view the list of todo and perform CRUD operations.
2. Click the "Add Todo" button to add a new student.
3. Use the dropdown menu in each row to update or delete a student record.
4. Fill out the form in `update_page_1.php` to update a information.
5. Click the "UPDATE" button to save the changes.
6. Click the "Delete" option in the dropdown menu to delete a student record.
7. 

## Database Monitoring with Adminer

To monitor and manage the database, follow these steps:

1. Open a new tab and enter `localhost:8080`. This will take you to Adminer.
2. Provide the following credentials:
    - **Server**: `db`
    - **Username**: `root`
    - **Password**: `mariadb`
    - **Database**: `m04Crud-Todo-app`
