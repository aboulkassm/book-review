# Book Review Application

A Laravel 11 application for browsing books and writing reviews with star ratings.

## Features

- 📚 Browse books with filtering and sorting options
- ⭐ Star rating system (1-5 stars)
- 📝 Write and submit book reviews
- 🔍 Filter books by title
- 📊 Sort books by various criteria (title, latest, popular, highest rated)
- ⏱️ Rate limiting on review submissions
- 🎨 Clean and responsive UI with Tailwind CSS

## Tech Stack

- **Laravel 11** - PHP Framework
- **SQLite** - Database
- **Tailwind CSS** - Styling
- **Blade** - Templating Engine
- **Vite** - Asset Bundling

## Models

- **Book** - Main book model with relationships to reviews
- **Review** - Reviews with rating (1-5) and review text

## Installation

### Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js & NPM

### Setup Steps

1. Clone the repository:
```bash
git clone https://github.com/aboulkassm/book-review.git
cd book-review
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install JavaScript dependencies:
```bash
npm install
```

4. Create a copy of the `.env` file:
```bash
cp .env.example .env
```

5. Generate application key:
```bash
php artisan key:generate
```

6. Run database migrations:
```bash
php artisan migrate
```

7. (Optional) Seed the database with sample data:
```bash
php artisan db:seed
```

8. Build assets:
```bash
npm run build
```

9. Start the development server:
```bash
php artisan serve
```

Visit `http://localhost:8000` in your browser.

## Usage

### Browsing Books

- Navigate to the home page to view all books
- Use the search box to filter books by title
- Use the "Filter by" dropdown to sort books:
  - Latest: Most recently added books
  - Popular: Books with the most reviews (last 6 months)
  - Highest Rated: Books with the best average rating (last 6 months)

### Adding Reviews

1. Click on a book to view its details
2. Click the "Rate this book" button
3. Select a star rating (1-5 stars)
4. Write your review in the text area
5. Submit your review

**Note:** Review submissions are rate-limited to prevent spam.

## Project Structure

```
app/
├── Http/Controllers/
│   ├── BookController.php      # Handles book listing and details
│   └── ReviewController.php    # Handles review creation
├── Models/
│   ├── Book.php               # Book model with scopes and relationships
│   └── Review.php             # Review model
└── View/Components/
    └── StarRating.php         # Star rating component

resources/
├── views/
│   ├── books/
│   │   ├── index.blade.php    # Books listing page
│   │   ├── show.blade.php     # Book details page
│   │   └── reviews/
│   │       └── create.blade.php # Review creation form
│   ├── components/
│   │   └── star-rating.blade.php # Star rating UI component
│   └── layouts/
│       └── app.blade.php      # Main layout template
```

## Database Schema

### Books Table
- `id` - Primary key
- `title` - Book title
- `author` - Book author
- `created_at` - Timestamp
- `updated_at` - Timestamp

### Reviews Table
- `id` - Primary key
- `book_id` - Foreign key to books
- `review` - Review text
- `rating` - Integer (1-5)
- `created_at` - Timestamp
- `updated_at` - Timestamp

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
