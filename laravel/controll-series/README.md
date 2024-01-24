
# Series Register System

This PHP system, built on the Laravel framework, is designed to manage a collection of series, allowing users to interact with both a web interface and an API. The system is focused on series registration, enabling users to list, create, and delete series. Additionally, users can upload covers for the registered series, manage seasons and episodes, and mark episodes as watched or unwatched.

## Web Interface and API

The system comes with a web interface for easy interaction, and it also provides a powerful API for programmatic access. The API supports various endpoints to perform CRUD (Create, Read, Update, Delete) operations on series and episodes. Authentication is handled using Laravel Sanctum, ensuring secure access to the API.

## Features

### Series Management

- **List Series:** Retrieve a list of registered series.
- **Create Series:** Add new series to the system.
- **Delete Series:** Remove a series from the collection.

### Cover Upload

- **Upload Cover:** Users can upload custom covers for each series.

### Episodes and Seasons

- **Get Seasons:** Retrieve a list of seasons for a specific series.
- **Get Episodes:** Fetch the episodes associated with a particular series.

### Watched Status

- **Update Watched Status:** Toggle the watched status of episodes.

## Getting Started

To set up and run this Laravel Series Register System, follow these steps:

1. **Navigate to the Project Directory:**
   ```bash
   cd series-register-system
   ```

2. **Install Dependencies:**
   ```bash
   composer install
   ```

3. **Create a Copy of the .env File:**
   ```bash
   cp .env.example .env
   ```

4. **Generate Application Key:**
   ```bash
   php artisan key:generate
   ```

5. **Configure Database:**
   Update the `.env` file with your database credentials.

6. **Run Migrations:**
   ```bash
   php artisan migrate
   ```

7. **Start the Laravel Service:**
   ```bash
   php artisan serve
   ```

   The Laravel development server will be accessible at `http://localhost:8000`.

Now, you have the Series Register System up and running. Access the web interface and explore the API to manage your series collection!

## API Routes

The API provides the following routes:

- **POST /api/login:** Endpoint to authenticate and obtain an access token.
  
- **Authenticated Routes (Middleware: auth:sanctum):**
  - **GET /api/series:** Retrieve a list of series.
  - **POST /api/series:** Create a new series.
  - **DELETE /api/series/{series}:** Delete a specific series.
  - **GET /api/series/{series}/seasons:** Retrieve seasons for a specific series.
  - **GET /api/series/{series}/episodes:** Retrieve episodes for a specific series.
  - **PATCH /api/episodes/{episode}:** Update the watched status of a specific episode.

Please refer to the controllers (`SeriesController`, `EpisodesController`, and `LoginController`) for detailed implementation.

Feel free to explore and enhance the system as needed for your specific requirements!

## License

This project is an open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
