# Book Library API (v1.0.0)

A RESTful API and frontend SPA for managing personal and shared book collections.

---

## Features

- User registration and login (via Laravel Sanctum)
- JWT-based cookie authentication
- CSRF protection (for SPA usage)
- Book management (CRUD + soft deletes + restore)
- Access control: grant access to your library
- View books of users who granted access
- Vue 3 + Vite frontend with login/register/books interface
- Dark mode toggle with persistent storage
- Toast notifications for actions

---

## Stack

- PHP 8.2, Laravel 12
- MySQL 8
- Vue 3 (Composition API)
- Vite, Toastification, MDB UI Kit

---

## Setup

### Backend (Laravel API)

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

Ensure Sanctum is configured correctly in `.env`:
```
SESSION_DOMAIN=localhost
SANCTUM_STATEFUL_DOMAINS=localhost:5173
```

### Frontend (Vue SPA)

```bash
cd laravel-spa
npm install
npm run dev
```

App available at: http://localhost:5173

---

## API Endpoints

| Method | Endpoint                 | Description |
|--------|--------------------------|-------------|
| POST   | /api/register            | Register user |
| POST   | /api/login               | Login user (returns cookie) |
| POST   | /api/logout              | Logout |
| GET    | /api/user                | Get current user info |
| GET    | /api/users               | List all users |
| POST   | /api/grant-access/{id}   | Grant access to your books |
| GET    | /api/books               | Get books you own or have access to |
| POST   | /api/books               | Create book |
| GET    | /api/books/{id}          | View single book |
| PUT    | /api/books/{id}          | Update book |
| DELETE | /api/books/{id}          | Soft delete book |
| GET    | /api/books/trashed       | List deleted books |
| POST   | /api/books/{id}/restore  | Restore deleted book |

All protected routes require `X-XSRF-TOKEN` header and authentication cookies.

---

## Not Implemented Yet

- Book search via Google Books / MIF external API
- Upload and parse text file for book content
- Granting access screen (frontend)
- Viewing another user's books (frontend)

---

## Postman Collection

📬 A complete collection with authentication and headers is included.

See: `book-library-api.postman_collection.json`

---

## License

MIT

# API «Библиотека книг» (v1.0.0)

REST API и SPA-интерфейс для управления личной и общей библиотекой книг.

---

## Возможности

- Регистрация и вход пользователей (Laravel Sanctum)
- Аутентификация по куки с JWT и CSRF-защитой
- CRUD для книг + мягкое удаление и восстановление
- Предоставление доступа к своей библиотеке другим пользователям
- Просмотр книг пользователей, которые выдали вам доступ
- SPA-интерфейс на Vue 3: формы входа, регистрации, книги
- Поддержка тёмной темы
- Всплывающие уведомления об успешных действиях

---

## Стек технологий

- PHP 8.2, Laravel 12
- MySQL 8
- Vue 3 (Composition API), Vite
- MDB UI Kit, Toastification

---

## Установка

### Бэкенд (Laravel API)

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

Файл `.env`:
```
SESSION_DOMAIN=localhost
SANCTUM_STATEFUL_DOMAINS=localhost:5173
```

### Фронтенд (SPA на Vue)

```bash
cd laravel-spa
npm install
npm run dev
```

Доступно по адресу: http://localhost:5173

---

## API эндпоинты

| Метод | Маршрут                   | Описание |
|--------|----------------------------|----------|
| POST   | /api/register              | Регистрация пользователя |
| POST   | /api/login                 | Авторизация (куки) |
| POST   | /api/logout                | Выход |
| GET    | /api/user                  | Текущий пользователь |
| GET    | /api/users                 | Список всех пользователей |
| POST   | /api/grant-access/{id}     | Выдать доступ к библиотеке |
| GET    | /api/books                 | Получить доступные книги |
| POST   | /api/books                 | Создать книгу |
| GET    | /api/books/{id}            | Посмотреть книгу |
| PUT    | /api/books/{id}            | Обновить книгу |
| DELETE | /api/books/{id}            | Удалить книгу (мягко) |
| GET    | /api/books/trashed         | Удалённые книги |
| POST   | /api/books/{id}/restore    | Восстановить книгу |

Защищённые маршруты требуют `X-XSRF-TOKEN` и куки.

---

## Что не реализовано

- Поиск книг через Google Books или МИФ API
- Загрузка текстового файла с книгой
- Экран предоставления доступа (во фронте)
- Интерфейс просмотра чужих книг

---

## Коллекция Postman

📬 В комплекте — готовая коллекция с авторизацией и заголовками: `book-library-api.postman_collection.json`

---

## Лицензия

MIT

