# Enterprise AI Society Management Platform (AISMS)

Welcome to the **Enterprise AI Society Management Platform (AISMS)**. This platform is built for the AI Society of Khyber Pakhtunkhwa to seamlessly manage members, events, research, learning hubs, and career opportunities.

## 🚀 Tech Stack

**Backend:**
- **Laravel 13** (PHP 8.4+)
- **Livewire 4**
- **MySQL 8+**

**Frontend:**
- **Tailwind CSS v4** (Modern Design System with glassmorphism)
- **Alpine.js**
- **Vite**

**Packages & Tools:**
- **Spatie Permission** (Robust Role-Based Access Control)
- **Spatie Media Library** (File and Media Management)
- **Spatie Activitylog** (Audit trailing and logging)
- **Pest PHP v4** (Testing)
- **SweetAlert2** & **Notyf** (Alerts & Notifications)

## 📦 Features Included in Phase 1

1. **Robust Admin Portal & Authentication**
   - Full Livewire Auth Flow (Login, Register, Password Reset)
   - Data-rich Admin Dashboard
   - 19 fully functioning CRUD modules built with Livewire MFCs (Multi-File Components).

2. **Extensive Database Schema**
   - 35 migration files mapping 60+ tables.
   - Modules: Settings, Menus, Pages, Blogs, Events, Learning Hub, Research, Career Center, and more.

3. **Modern Design System**
   - Dark mode support out of the box.
   - Reusable Blade UI Component library (Buttons, Modals, Tables, Forms, etc.).

## ⚙️ Installation & Setup

1. **Clone the repository:**
   ```bash
   git clone https://github.com/TheKhanSoft/AISMP.git
   cd AISMP
   ```

2. **Install Composer dependencies:**
   ```bash
   composer install
   ```

3. **Install NPM dependencies:**
   ```bash
   npm install
   npm run build
   ```

4. **Environment Setup:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *Update your `.env` to point to a database named `ai_society`.*

5. **Run Migrations & Seeders:**
   ```bash
   php artisan migrate:fresh --seed
   ```
   *This will seed the default roles, permissions, settings, and the Super Admin user.*

6. **Serve the Application:**
   ```bash
   php artisan serve
   ```

## 🔑 Default Credentials

- **Email:** `admin@aisocietykp.org`
- **Password:** `password`

## 👨‍💻 Development

This platform uses strict typing (`declare(strict_types=1);`) and modern object-oriented principles. Ensure any new PHP code adheres to these standards.

---
*Built with ❤️ for the AI Society.*
