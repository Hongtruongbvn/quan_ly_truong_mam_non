<img width="2559" height="1389" alt="image" src="https://github.com/user-attachments/assets/36f8ccdf-959a-42fb-be09-f0c10eafbf02" />
home page
Nursery School Management System
Overview

This project is a Nursery School Management System built with Laravel.
The system is designed to help schools manage student information, learning progress, classroom activities, and school facilities in a more efficient and modern way.

The platform allows teachers and parents to monitor student performance and daily activities online, helping reduce unnecessary parent meetings and improving communication between schools and families.

Live Deployment:
Nursery School Management System

Main Features
Student Management
Manage student profiles and personal information
Attendance tracking
Health and behavior records
Learning progress monitoring
Academic Evaluation
Daily reports and evaluations
Score management
Teacher comments and feedback
Progress tracking for each student
Parent Support
Online student updates
Notifications and announcements
Transparent communication between teachers and parents
Reduced parent meeting time
Facility Management
Classroom management
School equipment tracking
Facility maintenance management
Payment System
Tuition fee management
Stripe payment integration
Payment history tracking
Tech Stack
Backend
Laravel
PHP
MySQL
Laravel Mail
Stripe API
Frontend
Blade Templates
Bootstrap
JavaScript
CSS
Environment Variables

Create a .env file in the root directory and configure your environment variables like the example below:

APP_NAME=your_app_name
APP_KEY=your_app_key
APP_ENV=production
APP_DEBUG=false
APP_URL=your_app_url

# Database Configuration
DB_CONNECTION=your_database_connection
DB_HOST=your_database_host
DB_PORT=your_database_port
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password

# Mail Configuration
MAIL_MAILER=smtp
MAIL_HOST=your_mail_host
MAIL_PORT=your_mail_port
MAIL_USERNAME=your_mail_username
MAIL_PASSWORD=your_mail_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email_address
MAIL_FROM_NAME="your_app_name"

# Stripe Configuration
STRIPE_KEY=your_stripe_public_key
STRIPE_SECRET=your_stripe_secret_key

# Redis Configuration
REDIS_HOST=your_redis_host
REDIS_PASSWORD=your_redis_password
REDIS_PORT=your_redis_port
Installation

Clone the repository:

git clone <your-repository-url>

Install dependencies:

composer install
npm install

Generate application key:

php artisan key:generate

Run database migrations:

php artisan migrate

Start the development server:

php artisan serve
System Benefits
Reduces paperwork and manual management
Saves time for teachers and parents
Improves communication efficiency
Provides transparent student progress tracking
Supports digital transformation in education management
Future Improvements
Mobile application support
Real-time parent-teacher chat
AI-based learning analysis
QR code attendance system
Online learning materials integration
Security
Secure authentication system
Password encryption using bcrypt
Session protection
Secure payment processing with Stripe
Database security with Laravel ORM
Deployment

This project is deployed on Render:

Live Demo Deployment
