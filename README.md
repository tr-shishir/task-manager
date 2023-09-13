# Laravel Task Management Web Application

This is a simple web application built with Laravel for managing tasks within different projects. Users can create, edit, delete tasks, reorder tasks via drag-and-drop, and filter tasks by project.

## Features

- Create tasks with a name and priority.
- Edit existing tasks.
- Delete tasks.
- Reorder tasks with drag-and-drop, automatically updating priorities.
- Assign tasks to projects.
- Filter tasks by project.

## Requirements

- PHP 8.1 or later
- Composer
- MySQL or another compatible database

## Installation

**Follow those process one after one:**

   ```bash
   git clone https://github.com/tr-shishir/task-manager
   cd task-management
   composer install
   cp .env.example .env
   php artisan key:generate
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_username
   DB_PASSWORD=your_database_password
   php artisan migrate
   php artisan serve
```








