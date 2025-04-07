# Book Library API

A RESTful API for a mobile application to manage a digital book library, built with Laravel 10 and PHP 8.2.

---

## 🚀 Features

- User registration and login with token authentication (Sanctum)
- Book CRUD operations (create, read, update, soft-delete, restore)
- Access control to user libraries
- Search books via external Google Books API
- Save external books into personal library
- Upload book content via `.txt` file
- RESTful JSON API structure

---

## ⚙️ Requirements

- PHP >= 8.2
- Composer
- MySQL 8 or SQLite
- Laravel 10

---

## 🛠 Installation

```bash
git clone https://github.com/your-username/book-library-api.git
cd book-library-api
composer install
cp .env.example .env
php artisan key:generate
```

### Configure `.env`
Update your `.env` file with database credentials.

### Migrate database
```bash
php artisan migrate
```

---

## ▶️ Run the server

```bash
php artisan serve
```

API will be available at: `http://127.0.0.1:8000`

---

## 🧪 API Testing

Use the provided Postman collection:

📁 `book-library-api-final.postman_collection.json`

Don't forget to set the variables:
- `{{base_url}}` → `http://127.0.0.1:8000`
- `{{token}}` → Your user token from `/api/login`

---

## 📂 Project structure

- `app/Models` — Eloquent models
- `app/Http/Controllers` — API controllers
- `routes/api.php` — All API routes
- `database/migrations` — Table structure

---

## ✅ API endpoints overview

| Method | Endpoint                   | Description                     |
|--------|----------------------------|---------------------------------|
| POST   | /api/register              | Register a new user             |
| POST   | /api/login                 | Login and receive token         |
| GET    | /api/users                 | Get list of all users           |
| POST   | /api/library/access        | Grant access to user's library |
| GET    | /api/books                 | List user's books               |
| POST   | /api/books                 | Create a new book               |
| GET    | /api/books/{id}           | View a book by ID               |
| PUT    | /api/books/{id}           | Update a book                   |
| DELETE | /api/books/{id}           | Soft delete a book              |
| PATCH  | /api/books/{id}/restore   | Restore a soft-deleted book     |
| GET    | /api/users/{id}/books     | View another user's books       |
| GET    | /api/books/search         | Search books via Google API     |
| POST   | /api/books/save           | Save external book              |

---

## 🧹 Code formatting

To auto-format code using PHP-CS-Fixer:

```bash
composer require --dev friendsofphp/php-cs-fixer
vendor/bin/php-cs-fixer fix
```

---

## 📝 License

MIT — feel free to use, modify, and share.
