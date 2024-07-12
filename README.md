# MealFlow

MealFlow is a comprehensive B2B ERP-CRM system designed to manage and track meal plan deliveries. This platform offers various modules, including delivery real-time tracking, APIs for delivery uploads from client websites, fleet management, finances, HR, and more.

## Table of Contents

- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Running Migrations and Seeders](#running-migrations-and-seeders)
- [Usage](#usage)
- [Modules](#modules)

## Features

- Delivery Real-Time Tracking
- APIs for Delivery Uploads from Client Websites
- Fleet Management Module
- Finances Module
- HR Module
- User Authentication and Authorization
- Comprehensive Reporting and Analytics

## Requirements

- PHP >= 8.0
- Composer
- Laravel >= 8.0
- MySQL or PostgreSQL
- Node.js & NPM/Yarn

## Installation

1. **Clone the repository:**

    ```sh
    git clone https://github.com/yourusername/mealflow.git
    cd mealflow
    ```

2. **Install dependencies:**

    ```sh
    composer install
    npm install
    npm run dev
    ```

3. **Copy the .env.example file to .env:**

    ```sh
    cp .env.example .env
    ```

4. **Generate the application key:**

    ```sh
    php artisan key:generate
    ```

## Configuration

1. **Update your `.env` file with the following settings:**

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=mealflow
    DB_USERNAME=<db_name>
    DB_PASSWORD=<db_password>

    ```

2. **Set up your database:**

    ```sh
    php artisan migrate
    ```

## Running Migrations and Seeders

To run migrations and seeders, use the following commands:

1. **Run migrations:**

    ```sh
    php artisan migrate
    ```

2. **Run seeders:**

    ```sh
    php artisan db:seed
    ```

## Usage

To start the development server, run:

```sh
php artisan serve
 ```
Visit http://localhost:8000 in your browser to access the application.

## Modules
MealFlow consists of the following modules:

**Delivery Real-Time Tracking:** Monitor and manage deliveries in real-time.

**API Integration:** Upload deliveries from client websites via APIs.

**Fleet Management:** Manage and track fleet vehicles and drivers.

**Finances:** Track expenses, revenues, and generate financial reports.

**HR Module:** Manage employee data, payroll, and attendance.
