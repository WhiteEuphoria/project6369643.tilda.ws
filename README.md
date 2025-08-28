# Laravel User Admin System

<p align="center">
  A simple and powerful user administration system built with Laravel.
</p>

## About

This project provides a user administration panel built on the Laravel framework. It offers basic user management features including create, read, update, and delete (CRUD), plus authentication and authorization.

Key features:
* User management (CRUD)
* Authentication and authorization
* Built with [Laravel](https://laravel.com)

## Getting Started

Follow these steps to run the project locally.

### Prerequisites

Ensure you have PHP, Composer, and Node.js installed.

### Installation

1. Clone the repository
    ```sh
    git clone https://example.com/your_repository.git
    cd your_repository
    ```
2. Install PHP dependencies
    ```sh
    composer install
    ```
3. Create the `.env` file
    ```sh
    cp .env.example .env
    ```
4. Generate the application key
    ```sh
    php artisan key:generate
    ```
5. Configure your `.env` (database, mail, etc.)

6. Run database migrations
    ```sh
    php artisan migrate
    ```
7. (Optional) Seed the database
    ```sh
    php artisan db:seed
    ```
8. Start the development server
    ```sh
    php artisan serve
    ```

## Dev Monitoring

- Full dev stack (server, queue, logs, Vite):
  ```sh
  # install dependencies
  composer install
  npm install

  # run dev stack (one command)
  composer run dev
  ```
  The `composer run dev` script starts concurrently:
  - `php artisan serve`
  - `php artisan queue:listen --tries=1`
  - `php artisan pail --timeout=0` (log viewer)
  - `npm run dev` (Vite with HMR)

- Continuous test watcher:
  ```sh
  bash scripts/watch-tests.sh
  ```
  If `entr` is installed, it will be used for efficient file watching; otherwise the script falls back to a portable polling mode (1s).

Note: Make sure dependencies are installed first: `composer install` and `npm install`.

## License

This project is released under the MIT License. See `LICENSE` for details.
