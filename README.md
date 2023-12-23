# Laravel Project Setup Guide (Windows)

This guide will help you set up the Laravel project on a Windows system.

## Prerequisites

- **Install XAMPP**: Ensure you have XAMPP installed with at least PHP version 8.3. You can download it from [the official XAMPP website](https://www.apachefriends.org/index.html).
- **Install Composer**: After installing XAMPP, install the latest version of Composer. Download it from [the Composer website](https://getcomposer.org/). When prompted in the installer, select the php.exe file that is located in the xampp/php folder (composer usually selects this by default).
- Ensure you have Git installed on your system.
- **Install Node.js**: Ensure you have Node.js version 18 installed. Download it from [the Node.js website](https://nodejs.org/).

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

6. **Install NPM Dependencies**
   - Run `npm install`.

7. **Compile Front-end Assets**
   - Run `npm run dev`.

8. **Run the Application**
   - Run `php artisan serve`.
   - Access the application at `http://localhost:8000`.

## Troubleshooting

- Ensure all prerequisites, including XAMPP, Composer, and Node.js version 18, are correctly installed.
- Check `.env` settings if you encounter database or mail driver issues.
- Ensure XAMPP servers are running for database connectivity.

# Laravel Project Setup Guide (Mac)

This guide will help you set up the Laravel project on a Mac system.

## Prerequisites

- Ensure you have Git, Composer, and PHP installed on your system.
- **Install Node.js**: Ensure you have Node.js version 18 installed. Download it from [the Node.js website](https://nodejs.org/).

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

6. **Install NPM Dependencies**
   - Run `npm install`.

7. **Compile Front-end Assets**
   - Run `npm run dev`.

8. **Run the Application**
   - Run `php artisan serve`.
   - Access the application at `http://localhost:8000`.

## Troubleshooting

- Ensure all prerequisites, including Composer and Node.js version 18, are correctly installed.
- Check `.env` settings if you encounter database or mail driver issues.
