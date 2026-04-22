# 🟢 Green Sports Club — Student Management System

> A full-stack web application built with **Laravel** for managing students, coaches, and sports activities across multiple disciplines at Green Sports Club.

---

## 📌 Project Overview

Green Sports Club SMS is a role-based web platform that streamlines the management of student enrollments, coach assignments, attendance tracking, and fee payments across six sports disciplines. The system is designed to reduce administrative overhead and provide a centralized hub for club operations.

---

## 🎯 Key Features

### 👤 Role-Based Access Control
| Role | Description |
|------|-------------|
| **Admin** | Full access — manage students, coaches, sports, fees, and reports |
| **Coach / Mentor** | View and manage assigned students, mark attendance, add performance notes |
| **Student** | View own profile, attendance records, schedule, and payment status |

---

### 🏅 Sports Disciplines
Students can be enrolled in one or more of the following disciplines:

- 🏋️ Gym
- 🏊 Swimming
- ⚽ Futsal
- 🏏 Cricket
- 🏀 Basketball

Each discipline has its own set of coaches, schedules, and enrolled students.

---

### 📋 Core Modules

#### 1. Student Management
- Register new students with personal details
- Assign students to one or multiple sports disciplines
- View, update, and deactivate student profiles
- Track enrollment history

#### 2. Coach / Mentor Management
- Register coaches and assign them to specific sports
- Manage coach profiles and availability
- Link coaches to student groups

#### 3. Attendance Tracking
- Coaches can mark daily attendance per sport session
- Admins can view attendance reports by student, sport, or date range
- Students can view their own attendance history

#### 4. Fee / Payment Management
- Set fee structures per sport discipline
- Track monthly/periodic payments per student
- Mark payments as paid, pending, or overdue
- Admin dashboard with financial summary

#### 5. Admin Dashboard
- Overview statistics (total students, coaches, pending fees, today's attendance)
- Quick access to all management modules
- Exportable reports

---

## 🛠️ Tech Stack

| Layer | Technology |
|-------|-----------|
| **Backend** | Laravel 11 (PHP) |
| **Frontend** | Blade Templates + Tailwind CSS |
| **Database** | SQLite (via Laravel's default DB driver) |
| **Authentication** | Laravel Breeze / Fortify (Role-based) |
| **Authorization** | Laravel Gates & Policies |
| **Version Control** | Git / GitHub |

---

## 🗄️ Database Schema (Key Tables)

```
users               → id, name, email, password, role (admin|coach|student)
students            → id, user_id, dob, address, phone, enrolled_at
coaches             → id, user_id, bio, specialization
sports              → id, name, description
student_sport       → student_id, sport_id, enrolled_date (pivot)
coach_sport         → coach_id, sport_id (pivot)
attendances         → id, student_id, sport_id, coach_id, date, status
fees                → id, sport_id, amount, period (monthly/yearly)
payments            → id, student_id, fee_id, amount_paid, paid_at, status
```

---

## 🚀 Getting Started

### Prerequisites
- PHP >= 8.2
- Composer
- Node.js & NPM
- SQLite (built into PHP — no separate installation needed)

### Installation

```bash
# Clone the repository
git clone https://github.com/yourusername/green-sports-club.git
cd green-sports-club

# Install PHP dependencies
composer install

# Install JS dependencies
npm install && npm run dev

# Set up environment
cp .env.example .env
php artisan key:generate

# Create the SQLite database file
touch database/database.sqlite

# Ensure .env has: DB_CONNECTION=sqlite (Laravel 11 default)
# Then run migrations & seeders
php artisan migrate --seed

# Serve the application
php artisan serve
```

### Default Credentials (Seeded)
| Role | Email | Password |
|------|-------|----------|
| Admin | admin@greensports.com | password |
| Coach | coach@greensports.com | password |
| Student | student@greensports.com | password |

---

## 📁 Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/          # AdminController, ReportController
│   │   ├── StudentController.php
│   │   ├── CoachController.php
│   │   ├── AttendanceController.php
│   │   └── PaymentController.php
│   └── Middleware/
│       └── RoleMiddleware.php
├── Models/
│   ├── User.php
│   ├── Student.php
│   ├── Coach.php
│   ├── Sport.php
│   ├── Attendance.php
│   └── Payment.php
resources/
└── views/
    ├── admin/
    ├── coach/
    └── student/
```

---

## 📸 Screenshots

> *(To be added after UI development)*

---

## 🔮 Future Enhancements

- [ ] SMS / Email notifications for fee reminders
- [ ] Student performance tracking & reports
- [ ] Mobile-responsive PWA
- [ ] Online payment gateway integration
- [ ] Parent/guardian portal

---

## 👨‍💻 Developer

**Prakrist Maharjan**
Built as a portfolio project to demonstrate full-stack Laravel development skills.

---

## 📄 License

This project is open-source and available under the [MIT License](LICENSE).