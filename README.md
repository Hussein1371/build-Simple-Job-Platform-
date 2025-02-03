# build-Simple-Job-Platform-

# Simple Job Platform

This project is a web-based application designed to connect job seekers and employers. Our platform allows users to post jobs, search for jobs, upload resumes, and manage applications. The system is built using **PHP**, **MySQL**, and **CSS**.

---

## Features

### For Job Seekers:
- **User Account Management:**  
  Sign up, log in, and manage your profile.
- **Job Search:**  
  Find jobs using advanced filters such as job type, location, salary range, and company name.
- **Resume Upload:**  
  Easily upload your resume when applying for jobs.
- **Notifications:**  
  Get updates on your application status (e.g., pending, reviewed, shortlisted).
- **Password Reset:**  
  Securely reset your password using email verification and a reset code.

### For Employers:
- **Job Posting:**  
  Create and post job openings with detailed descriptions.
- **Application Management:**  
  Review and manage applications submitted by job seekers.
- **Status Tracking:**  
  Update and track application statuses (pending, reviewed, accepted, rejected).
- **Notifications:**  
  Receive alerts when new applications are submitted.

---

## Sprint History

### **Sprint 1: Initial Setup and Core Functionality**
- **What We Did:**
  - Implemented user registration and login.
  - Created basic dashboards for both job seekers and employers.
- **Focus:**
  - Establishing secure user authentication.
  - Setting up the foundation for the project.

### **Sprint 2: Job Posting, Search, and Resume Upload**
- **What We Did:**
  - Added job posting functionality for employers.
  - Implemented job search for job seekers.
  - Enabled resume uploads for job applications.
- **Focus:**
  - Integrating these core functionalities with the database.
  - Ensuring proper validations and file upload mechanisms.

### **Sprint 3: Advanced Features and Optimizations**
- **What We Did:**
  - Developed advanced search filters (by company name, salary range, job type, and location).
  - Optimized SQL queries for faster search responses.
  - Improved the UI for a more consistent and user-friendly experience.
- **Challenges Overcome:**
  - Optimizing dynamic SQL queries to handle complex filtering.
  - Resolving UI inconsistencies for a better overall design.

### **Sprint 4: Final Enhancements and Refinements**
- **What We Did:**
  - Implemented a secure password reset feature (including email input, reset code verification, and code expiration logic).
  - Enhanced the employer dashboard to allow dynamic updates of application statuses.
 - **Challenges & Improvements:**
  - Debugging AJAX interactions during the password reset process.
  - Allocating extra time for testing mobile responsiveness and UI improvements.
  - Improving team communication and task estimation.

---

## Installation and Setup

### Prerequisites:
- **XAMPP** (or any local server environment supporting Apache, MySQL, and PHP).
- A web browser to access the platform.
- **phpMyAdmin** for managing the database.

### How to Run the Project:

1. **Clone the Repository**
   ```bash
   git clone https://github.com/Hussein1371/build-Simple-Job-Platform.git
   cd build-Simple-Job-Platform
   ```

2. **Database Setup**
   - Open `phpMyAdmin`.
   - Create a new database named `job_platform`.
   - Import the SQL dump file (`job_platform.sql`):
     1. Click on the "Import" tab.
     2. Choose the `job_platform.sql` file.
     3. Click "Go" to import the database structure and sample data.

3. **Configure the Database Connection**
   - Open the `db.php` file and update it with your database credentials:
     ```php
     <?php
     $host = 'localhost';
     $db = 'job_platform';
     $user = 'root';
     $pass = ''; // Add your password here if needed
     $port = 3307; // Update this if your MySQL port is different
     $charset = 'utf8mb4';

     $dsn = "mysql:host=$host;dbname=$db;port=$port;charset=$charset";
     try {
         $pdo = new PDO($dsn, $user, $pass);
         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     } catch (PDOException $e) {
         die("Connection failed: " . $e->getMessage());
     }
     ?>
     ```

4. **Start Your Local Server**
   - Launch Apache and MySQL via XAMPP.
   - Open your browser and navigate to `http://localhost/Simple-Job-Platform/login.php` to start using the application.

---

## Folder Structure
```
/build-Simple-Job-Platform
├── dashboard.php            # Dashboard for job seekers and employers
├── db.php                   # Database connection file
├── job_platform.sql         # SQL dump for setting up the database
├── login.php                # User login page
├── logout.php               # Logout functionality
├── post_job.php             # Job posting page for employers
├── register.php             # User registration page
├── review_applications.php  # Application review page for employers
├── search_jobs.php          # Job search functionality
├── styles.css               # CSS styles for the platform
├── upload_resume.php        # Resume upload page for job seekers
```

---

## Screenshots

### Job Seeker Dashboard
![Job Seeker Dashboard](https://github.com/user-attachments/assets/cd97cb0a-9c70-4140-b732-0f9ad8bf8a97)

### Employer Dashboard
![Employer Dashboard](https://github.com/user-attachments/assets/f22ebfaa-1404-4f58-ace8-ea20b2a9fcf9)

### Advanced Job Search
![Advanced Job Search](https://github.com/user-attachments/assets/f37714dd-8a68-44dd-8df6-77920473f58b)

### Application Management
![Application Management](https://github.com/user-attachments/assets/f2643099-5f2c-43ec-835a-ca0714bbd3f5)

---

## Technology Stack
- **Frontend:** HTML, CSS
- **Backend:** PHP
- **Database:** MySQL

---

## Contact
If you have any questions or suggestions, feel free to reach out:
- **Email:** h13716745@gmail.com
- **GitHub:** [Hussein1371](https://github.com/Hussein1371)
 
