# Laravel CRUD Application with Docker

## Description
This is a Laravel-based CRUD (Create, Read, Update, Delete) application running in Docker containers. It includes MySQL for the database and phpMyAdmin for database management.

## Prerequisites
Before you begin, ensure you have the following installed on your system:
- Docker
- Docker Compose
- Git

## Installation

1. **Clone the repository:**
    ```sh
    git clone https://github.com/your-username/laravel-crud-docker.git
    cd laravel-crud-docker
    ```

2. **Set up environment variables:**
    Copy the example environment file and adjust the settings as needed.
    ```sh
    cp .env.example .env
    ```

3. **Build and start the Docker containers:**
    ```sh
    docker-compose up -d --build
    ```

4. **Install PHP dependencies:**
    ```sh
    docker-compose exec app composer install
    ```

5. **Generate the application key:**
    ```sh
    docker-compose exec app php artisan key:generate
    ```

6. **Run database migrations:**
    ```sh
    docker-compose exec app php artisan migrate
    ```

## Usage

- Access the application at `http://localhost:9000`
- Access phpMyAdmin at `http://localhost:9001` (use the credentials from your `.env` file)

## Configuration
- **.env file:** Contains environment-specific settings for the Laravel application.
- **docker-compose.yml:** Defines the Docker services and their configuration.

## Running Tests
To run the application's tests, use the following command:
```sh
docker-compose exec app php artisan test
