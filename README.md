# SkillSwap

A premium, modern, and responsive web platform built with Core PHP, HTML5, TailwindCSS, and MySQL. SkillSwap allows students and learners to share skills, find people to learn from, request learning sessions, and chat.

## Tech Stack
- **Backend:** Core PHP 8+ (Custom MVC implementation, OOP, PDO)
- **Frontend:** HTML5, Tailwind CSS via CDN, Vanilla JavaScript
- **Database:** MySQL

## Features Implemented
- **Custom Router & MVC:** Clean structure handling routes and controllers.
- **Authentication:** Register, login, session management, secure password hashing.
- **Modern UI:** Glassmorphism, TailwindCSS, custom animations, responsive layouts.
- **Dashboard:** Interactive dashboard overview.
- **AJAX Chat System:** Real-time-like chatting with polling setup.
- **Database Architecture:** Complete relational database schema with cascading relations.

## Setup Instructions

1. **Prerequisites**
   - XAMPP/WAMP or any server running PHP 8+ and MySQL.
   - Ensure `mod_rewrite` is enabled in Apache.

2. **Database Setup**
   - Open phpMyAdmin.
   - Create a new database named `skillswap`.
   - Import the `database/schema.sql` file into the `skillswap` database.

3. **Project Configuration**
   - Ensure the project is placed in your `htdocs` or web root directory, specifically in a folder named `skill-swap` (`c:/xampp/htdocs/skill-swap`).
   - Check `app/config/config.php` to ensure the database credentials and `BASE_URL` match your local setup.
   
4. **Running the Application**
   - Open your browser and navigate to `http://localhost/skill-swap/`.
   - The `.htaccess` file in the root will automatically route traffic to the `public/` directory where the front controller `index.php` handles routing.

## Folder Structure
- `/app` - Core logic (Controllers, Models, Views, config, core classes)
- `/public` - Front controller (`index.php`), CSS, JS, Images
- `/routes` - Route definitions (`web.php`)
- `/database` - SQL schema file

## Next Steps
- Implement logic for Skill Management, Searching, and Profile handling by replicating the MVC pattern used for Authentication and Home.
