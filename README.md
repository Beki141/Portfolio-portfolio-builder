# README.md

# Portfolio Project

This project is a simple portfolio builder that allows users to create and manage their personal portfolios. Users can add personal information, skills, and projects, and manage multiple user entries.

## File defination

- **include/**

  - `Database.php`: Defines the `Database` class for handling MySQL database connections and queries.
  - `Portfolio.php`: Defines the `Portfolio` class for managing portfolio data, including fetching and adding entries.

- **uploads/**: Directory for storing uploaded files, such as user profile images and project images.

- **index.html**: Main user interface for the portfolio project. Contains forms for inserting personal information, skills, and projects, along with a button to manage users.

- **insert_person.php**: Processes form submissions for adding personal information, including file uploads.

- **insert_projects.php**: Processes form submissions for adding projects, including handling project image uploads.

- **insert_skills.php**: Processes form submissions for adding skills associated with a fixed user ID.

- **manage_users.php**: Allows users to view, update, and delete existing user entries from the database.

- **portfolio.php**: Displays the user's portfolio, including personal information, skills, and projects.

## Setup Instructions

1. Clone the repository to your local machine.
2. Create a MySQL database named `portofolio_builder`.
3. Update the database connection details in `include/Database.php` if necessary.
4. Run the SQL scripts to create the necessary tables in the database.
5. Open `index.html` in your web browser to start using the portfolio builder.

## Usage Guidelines

- Fill out the forms in `index.html` to add personal information, skills, and projects.
- Use the "Manage Users" button to view, update, or delete existing users.
- Uploaded images will be stored in the `uploads/` directory.

# databse

CREATE DATABASE portfolio_builder;

USE portfolio_builder;

CREATE TABLE person (
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(255) NOT NULL,
picture VARCHAR(255),
description TEXT NOT NULL
);

CREATE TABLE skills (
id INT AUTO_INCREMENT PRIMARY KEY,
person_id INT NOT NULL,
skill_name VARCHAR(255) NOT NULL,
skill_level VARCHAR(50) NOT NULL,
FOREIGN KEY (person_id) REFERENCES person(id) ON DELETE CASCADE
);

CREATE TABLE projects (
id INT AUTO_INCREMENT PRIMARY KEY,
person_id INT NOT NULL,
project_title VARCHAR(255) NOT NULL,
project_description TEXT NOT NULL,
project_image VARCHAR(255),
FOREIGN KEY (person_id) REFERENCES person(id) ON DELETE CASCADE
);

CREATE TABLE contact (
id INT AUTO_INCREMENT PRIMARY KEY,
person_id INT NOT NULL,
email VARCHAR(255) NOT NULL,
phone VARCHAR(20),
message TEXT NOT NULL,
FOREIGN KEY (person_id) REFERENCES person(id) ON DELETE CASCADE
);

CREATE TABLE testimonial (
id INT AUTO_INCREMENT PRIMARY KEY,
person_id INT NOT NULL,
client_name VARCHAR(255) NOT NULL,
feedback TEXT NOT NULL,
FOREIGN KEY (person_id) REFERENCES person(id) ON DELETE CASCADE
);
