# South Cotabato - Complaint Monitoring System (SC-CMS)

## Table of Contents
- [Introduction](#introduction)
- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
- [Contributing](#contributing)
- [License](https://github.com/kad-f/South-Cotabato-Complaint-Monitoring-System/blob/main/LICENSE)

## Introduction

SC-CMS (South Cotabato Complaint Monitoring System) is a web-based application designed to facilitate the monitoring and resolution of complaints in the South Cotabato region. It provides a platform for efficient management of complaints, from registration to resolution.

## Features

- **Admin Dashboard:** View and manage all complaints, including total, resolved, pending, and high-priority complaints.
- **Police Dashboard:** Access a personalized dashboard to track assigned complaints, both resolved and pending.
- **Master Code Access:** Admins can access special functionalities using a master code.

## Installation

1. **Clone the Repository:**
   ```bash
   git clone https://github.com/your-username/sc-cms.git
1. Database Setup:

2. Import the provided SQL file into your MySQL/MariaDB database.
Configuration:

3. Update database connection details in database/connection.php.
Web Server:
Deploy the project on a web server (e.g., Apache, Nginx) or use PHP's built-in server for testing: cd sc-cms
php -S localhost:8000

# Usage
1. Admin Login:
Access the admin dashboard by logging in with admin credentials.
2. Police Login:
Police officers can log in to view and manage assigned complaints.
3. Master Code Access:
Admins can access additional functionalities using the master code.

# Contributing
Contributions are welcome! If you find a bug or have suggestions for improvements, please open an issue or create a pull request.

# License
This project is licensed under the MIT License.
