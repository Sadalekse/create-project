# Book Library API (Laravel + Vue)

This project is a Book Library API built with Laravel (backend) and Vue 3 (frontend SPA). It is a qualification project to demonstrate knowledge of REST API design, Laravel Sanctum authentication, and SPA integration.

## Features
- User registration & login with Laravel Sanctum (cookie-based authentication)
- Display list of all users (participants)
- Grant access to personal book library for specific users
- CRUD operations for books (Create, View, Update, Delete)
- Soft delete and restore functionality for books
- View another user's book list (if access granted)
- Dark/light theme toggle in SPA
- Responsive UI using MDB Vue UI Kit
- SPA built with Vue 3, Vue Router, and Toast notifications

## Not Yet Implemented / In Progress
- Book search using Google Books / MIF APIs (external search)
- Save found books from external search
- File upload for book text / cover
- Full dark mode theming for all pages
- Complete frontend forms and UI polish

## Technologies
- PHP 8.2, Laravel 12+, Sanctum, MySQL 8
- Vue 3, Vite, vue-router, Toastification, MDB UI Kit
- REST API architecture, JSON format, 3NF-compliant DB

## Setup
### Backend (Laravel)
```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

### Frontend (Vue SPA)
```bash
cd laravel-spa
npm install
npm run dev
```

## API Routes Summary
- `POST /api/register` – User registration
- `POST /api/login` – Login
- `POST /api/logout` – Logout
- `GET /api/user` – Current user info
- `GET /api/users` – All users
- `POST /api/grant-access/{user}` – Grant book access
- `GET /api/books` – List books (own + shared)
- `POST /api/books` – Create book
- `GET /api/books/{id}` – View book
- `PUT /api/books/{id}` – Update book
- `DELETE /api/books/{id}` – Soft delete book
- `GET /api/books/trashed` – List deleted books
- `POST /api/books/{id}/restore` – Restore book

## Notes
- CSRF protection is enabled
- Sanctum used with SPA cookie authentication
- API responses in JSON format

---

# Библиотека книг (Laravel + Vue)

Этот проект реализует REST API для мобильного приложения библиотеки книг. Поддерживает Laravel Sanctum, SPA-интерфейс на Vue 3, темную/светлую тему.

## Реализовано
- Регистрация и вход пользователей (с Sanctum)
- Список всех участников
- Выдача доступа к личной библиотеке
- CRUD книг (создание, редактирование, удаление, восстановление)
- Показ книг других пользователей (при наличии доступа)
- SPA на Vue 3 c переключением темы

## Частично / не сделано
- Поиск книг (внешний API Google / МИФ)
- Сохранение найденных книг
- Файлы (текст/обложка)
- Стилизация всех форм и доработка UI

## Установка Laravel
```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

## Установка SPA
```bash
cd laravel-spa
npm install
npm run dev
```

## Важно
- Sanctum с cookie-авторизацией
- Защита CSRF для SPA
- JSON ответы API

