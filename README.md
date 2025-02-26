# Famous Spies Assignment

Welcome to the application which will host the most famous spies in the World.

## Overview

This project is a Laravel application containerized using Docker.

It includes database migrations and seeders for initializing the database with sample data.

The application is designed to be easily set up and run in a local development environment.

---

## Features

- **Laravel Framework**: Our beloved Framework.
- **Dockerized Environment**: Simplified setup using Docker and Docker Compose.
- **Database Migrations**: Manage database schema.
- **Seeders**: Populate the database with sample data.

---

## Prerequisites

Before setting up the project, ensure you have the following installed:

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)
- [Composer](https://getcomposer.org/)

---

## Setup Instructions

Follow these steps to set up and run the project:

### 1. Clone the Repository
    I would suggest to use SSH to clone the project.

    HTTPS: https://github.com/panagiotiskanaris/famous-spies.git
    SSH: git clone git@github.com:panagiotiskanaris/famous-spies.git

### 2. Set Up Environment Variables
    Copy the .env.example file to .env and configure it as needed: cp .env.example .env

    * Ensure the database credentials in the .env file match the Docker database service configuration.

### 3. Build and Start Docker Containers]
    Run the following command to build and start the Docker containers:

    docker-compose build
    docker-compose up -d

    This will start the application, database, and any other services defined in the docker-compose.yml file.

### 4. Install Dependencies
    Run the following command inside the application container to install PHP dependencies:

    docker exec -it main_application composer install

### 5. Run Migrations and Seeders
    Run the following commands to set up the database schema and seed it with data:

    docker exec -it main_application php artisan migrate:fresh --seed

### 6. Access the Application
    The application should now be running. Open your browser and navigate to:

    > http://localhost:8000

## Code Architecture

- The /app directory contains the core business logic of the application. It is further divided into subdirectories:

- Actions: Contains action classes tha handle the create, update and delete of entities. This is the source of truth for an entity action.

- Events: Contains event classes, such as SpyTransferred, which are used to trigger specific actions in the application.

- Http: Contains controllers, form requests, and resources for handling HTTP requests and responses.
  - Only Resource Controllers and Invokable Controllers.

- Models: Contains Eloquent models that represent database tables and handle data interactions.

- Filters: Contains Filter classes based on each model separately.

- Services: Contains service classes for encapsulating reusable business logic.

## TODO

- Authentication: Use refresh token with specific expiration to fetch a new token.

- Add the Notification feature by using a service like Pusher.

- Create a new endpoint to assign a Spy to an existing Mission.

- Missions CRUD

- Spy Update Endpoint

- More Tests for the ordering in the Spy Index Endpoint.
