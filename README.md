# Laravel Project Setup Guide (Windows)

This guide will help you set up the Laravel project on a Windows system.

## Prerequisites

- Ensure you have Git, Composer, PHP, and WAMP/XAMPP (or equivalent) installed on your system.
- Node.js and NPM are required for managing front-end resources.

## Setup Instructions

1. **Clone the Repository**
   - Open Command Prompt or Git Bash.
   - Run `git clone [repository-url]` to clone the project.

2. **Install Composer Dependencies**
   - Navigate to the project directory: `cd [project-name]`.
   - Run `composer install`.

3. **Set Up Environment File**
   - Copy the `.env.example` file: `copy .env.example .env` (use `cp` in Git Bash).
   - Modify `.env` with your database and other environment settings.

4. **Generate Application Key**
   - Run `php artisan key:generate`.

5. **Database Setup**
   - Run `php artisan migrate` to create the database schema.

6. **Install NPM Dependencies (if needed)**
   - Run `npm install`.

7. **Compile Front-end Assets (if applicable)**
   - Run `npm run dev`.

8. **Run the Application**
   - Run `php artisan serve`.
   - Access the application at `http://localhost:8000`.

## Troubleshooting

- Ensure all prerequisites are correctly installed.
- Check `.env` settings if you encounter database or mail driver issues.
- Ensure WAMP/XAMPP servers are running for database connectivity.



# Laravel Project Setup Guide (Mac)

This guide will help you set up the Laravel project on a Mac system.

## Prerequisites

- Ensure you have Git, Composer, and PHP installed on your system.
- Node.js and NPM are required for managing front-end resources.

## Setup Instructions

1. **Clone the Repository**
   - Open Terminal.
   - Run `git clone [repository-url]` to clone the project.

2. **Install Composer Dependencies**
   - Navigate to the project directory: `cd [project-name]`.
   - Run `composer install`.

3. **Set Up Environment File**
   - Copy the `.env.example` file: `cp .env.example .env`.
   - Modify `.env` with your database and other environment settings.

4. **Generate Application Key**
   - Run `php artisan key:generate`.

5. **Database Setup**
   - Run `php artisan migrate` to create the database schema.

6. **Install NPM Dependencies (if needed)**
   - Run `npm install`.

7. **Compile Front-end Assets (if applicable)**
   - Run `npm run dev`.

8. **Run the Application**
   - Run `php artisan serve`.
   - Access the application at `http://localhost:8000`.

## Troubleshooting

- Ensure all prerequisites are correctly installed.
- Check `.env` settings if you encounter database or mail driver issues.