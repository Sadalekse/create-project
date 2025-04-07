# Book Library API

RESTful API для мобильного приложения по управлению цифровой библиотекой книг. Реализовано на Laravel 10 и PHP 8.2.

---

## 🚀 Возможности

- Регистрация и вход с токенами (Laravel Sanctum)
- CRUD-операции над книгами (создание, чтение, обновление, удаление, восстановление)
- Выдача доступа к библиотеке другим пользователям
- Поиск книг через внешний API (Google Books)
- Сохранение найденных книг в свою библиотеку
- Загрузка содержимого книги из `.txt` файла
- API возвращает ответы в формате JSON

---

## ⚙️ Требования

- PHP >= 8.2
- Composer
- MySQL 8 или SQLite
- Laravel 10

---

## 🛠 Установка

```bash
git clone https://github.com/your-username/book-library-api.git
cd book-library-api
composer install
cp .env.example .env
php artisan key:generate
```

### Настройка `.env`
Укажи свои данные доступа к базе данных.

### Выполнение миграций
```bash
php artisan migrate
```

---

## ▶️ Запуск сервера

```bash
php artisan serve
```

API будет доступно по адресу: `http://127.0.0.1:8000`

---

## 🧪 Тестирование API

Используй прилагаемую коллекцию Postman:

📁 `book-library-api-final.postman_collection.json`

Не забудь установить переменные:
- `{{base_url}}` → `http://127.0.0.1:8000`
- `{{token}}` → Токен пользователя, полученный после `/api/login`

---

## 📂 Структура проекта

- `app/Models` — Eloquent модели
- `app/Http/Controllers` — Контроллеры API
- `routes/api.php` — Все маршруты API
- `database/migrations` — Структура таблиц БД

---

## ✅ Обзор маршрутов API

| Метод | Endpoint                   | Описание                          |
|--------|----------------------------|-----------------------------------|
| POST   | /api/register              | Регистрация пользователя          |
| POST   | /api/login                 | Вход и получение токена           |
| GET    | /api/users                 | Список всех пользователей         |
| POST   | /api/library/access        | Выдать доступ к своей библиотеке |
| GET    | /api/books                 | Список книг пользователя          |
| POST   | /api/books                 | Создание новой книги              |
| GET    | /api/books/{id}           | Просмотр книги по ID              |
| PUT    | /api/books/{id}           | Обновление книги                  |
| DELETE | /api/books/{id}           | Удаление книги (мягкое)           |
| PATCH  | /api/books/{id}/restore   | Восстановление удалённой книги    |
| GET    | /api/users/{id}/books     | Просмотр чужих книг (если есть доступ) |
| GET    | /api/books/search         | Поиск книг через Google API       |
| POST   | /api/books/save           | Сохранение найденной книги        |

---

## 🧹 Форматирование кода

Для автоформатирования с помощью PHP-CS-Fixer:

```bash
composer require --dev friendsofphp/php-cs-fixer
vendor/bin/php-cs-fixer fix
```

---

## 📝 Лицензия

MIT — можно свободно использовать, изменять и распространять.
