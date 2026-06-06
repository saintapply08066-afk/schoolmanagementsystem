# School Management System

A comprehensive PHP-based school management system for handling student applications, admissions, grades, attendance, and more.

## Features

- **Student Management**: Manage student applications, admissions, and records
- **Teacher Management**: Manage teacher information and assignments
- **Grades Management**: Track and manage student grades
- **Classes Management**: Organize classes and class assignments
- **Attendance Tracking**: Monitor student attendance
- **Admin Dashboard**: Central control panel for administrators

## Project Structure

```
schoolmanagementsystem/
├── admin/
│   ├── applications.php
│   ├── approve_application.php
│   └── dashboard.php
├── includes/
│   └── db.php
├── auth/
│   └── login.php
└── README.md
```

## Setup Instructions

1. **Database Setup**
   - Create a MySQL database for the application
   - Update database connection in `includes/db.php`

2. **Installation**
   - Clone/download this repository
   - Place files in your web server directory
   - Update database credentials

3. **Access**
   - Admin Login: `auth/login.php`
   - Admin Dashboard: `admin/dashboard.php`

## Technology Stack

- PHP (Server-side scripting)
- MySQL (Database)
- HTML/CSS (Frontend)

## Features Overview

### Admin Panel
- View pending student applications
- Approve or reject applications
- Auto-generate admission numbers
- Create student accounts with login credentials
- View admin dashboard

## Default Credentials

Application approval creates default student credentials:
- **Username**: Admission number
- **Password**: student123

## Security Notes

- Change default passwords immediately after first use
- Use password hashing for all user accounts
- Implement input validation and sanitization
- Use prepared statements for database queries

## Future Enhancements

- Student portal for grade viewing
- Teacher interface for grade entry
- Parent notification system
- Attendance management dashboard
- Report generation
- Payment management

## Support

For issues or questions, please create an issue in the repository.
