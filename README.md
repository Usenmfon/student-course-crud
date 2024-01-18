 **# Student-Course Backend API**

**## Getting Started**

**1. Clone the repository:**

```bash
git clone https://github.com/Usenmfon/student-course-crud.git
```

**2. Install dependencies:**

```bash
composer install
```

**3. Create the `.env` file:**

```bash
cp .env.example .env
```

**4. Update database credentials in `.env`:**

- Set your database name, username, and password.

**5. Generate application key:**

```bash
php artisan key:generate
```

**6. Run database migrations:**

```bash
php artisan migrate
```

**7. (Optional) Run seeders:**

- **To run all seeders:**

   ```bash
   php artisan db:seed
   ```

- **To run specific seeders:**

   ```bash
   php artisan db:seed --class=StudentSeeder
   php artisan db:seed --class=CourseSeeder
   ```

**## Testing**

**1. Set up testing database:**

```bash
cp .env.testing.example .env.testing
php artisan migrate --env=testing
```

**2. Run tests:**

```bash
php artisan test
```

**## Using Postman**

- Import the Postman collection (provided in the `postman` directory).
- Set the base URL to `http://localhost:8000` (or your server's URL).
- Use the appropriate API endpoints for testing.

**## Additional Notes**

- Ensure you have PHP (version 8.0 or higher recommended) and Composer installed.

