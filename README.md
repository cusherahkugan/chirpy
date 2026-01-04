# Chirpy 🐦

Chirpy is a **microblogging web application** built with **Laravel**.  
It was originally created as a learning project following the **Laravel Learn free course**, and has been extended with **custom functionalities** to make it a full-featured social platform.

---

## Features ✨

- **User Authentication** – Sign up, sign in, and logout securely.  
- **Profile Management** – Upload and edit profile picture, update user information.  
- **Posts** – Create posts, like posts, and add comments.  
- **Responsive Design** – Built with Tailwind CSS and DaisyUI for a modern look.  
- **SQLite Database** – Lightweight, fast, and easy to set up.  
- **Notifications & Feedback** – Success toasts for interactions like posting or liking.  

---


## Installation & Setup ⚡

1. **Clone the repository:**
```bash
git clone https://github.com/cusherahkugan/chirpy.git
cd chirpy

Install dependencies:
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate

Serve the application:
php artisan serve
Visit the app:
Open http://localhost:8000 in your browser.

Project Structure 🏗️
chirpy/
├── app/               # Laravel backend code (Models, Controllers)
├── database/          # Migrations and SQLite database
├── resources/         # Blade templates & assets (CSS, JS)
├── routes/            # Web & API routes
├── public/            # Public assets (images, CSS, JS)
├── composer.json      # PHP dependencies
└── README.md          # Project documentation

Technologies Used 🛠️
Backend: Laravel 12.44.0
Frontend: Blade Templates + Tailwind CSS + DaisyUI
Database: SQLite
Extras: Profile picture upload, likes & comments system, toast notifications

Contributing 🤝
This project was built as a learning exercise, but contributions are welcome!
Feel free to:
Open issues for bugs or feature requests.
Submit pull requests to improve functionality or styling.
