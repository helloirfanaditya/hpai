# Take Home Test API - Laravel

This repository contains a **REST API** built using **Laravel** that implements user management with authentication using **JWT (JSON Web Token)**.

## Requirements

✅ Laravel (PHP-based API)  
✅ Uses JWT for authentication (`Authorization: Bearer <token>`)  
✅ Implements Docker for containerization  
✅ Includes Unit Tests for API endpoints  

---

## API Endpoints

### **Authentication**
#### **1. Login**
- **Endpoint:** `POST /api/login`
- **Request:******
    ```json
    {
      "email": "user@example.com",
      "password": "password123"
    }
- **Response:**
    ```json
    {
        "status": true,
        "message": "OK",
        "data": {
            "token":"bearer_token here"
        }
    }


### **User Management**
#### **2. Get All Users**
- **Endpoint:** `GET /api/users`
- **Headers:**
    ```json
    {
      "Authorization": "Bearer your_jwt_token"
    }
- **Request:**
    ```json
    {
      "limit": 10, // the default is 10
      "next_page": 2,
      "prev_page": 1,
      "search": "john" // nullable
    }
- **Response:**
    ```json
    {
    "status": true,
    "message": "OK",
    "data": {
        "list_data": [
            {
                "id": 11,
                "role_id": 1,
                "role_name": "admin",
                "name": "Ms. Leora Abernathy IV",
                "email": "davis.madyson@example.org",
                "raw_created_at": "2025-03-09T19:03:48.000000Z",
                "parse_created_at": "2025-03-09 19:03:48"
            },
        ],
    "total_data": 100,
    "total_page": 10,
    "next_page": 2,
    "current_page": 1

#### **3. Create Users**
- **Endpoint:** `POST /api/users`
- **Headers:**
    ```json
    {
        "Authorization": "Bearer your_jwt_token"
    }
- **Request:**
    ```json
    {
        "name":"Scroll Pesnuk",
        "email":"awaawa@gmaila.com",
        "password":"password",
        "role":"1"
    }
- **Response:**
    ```json
    {
        "status": true,
        "message": "OK",
        "data": "OK"
    }

#### **4. Detail Users**
- **Endpoint:** `GET /api/users/:id`
- **Headers:**
    ```json
    {
        "Authorization": "Bearer your_jwt_token"
    }
- **Request:**
    ```json
    {}
- **Response:**
    ```json
    {
        "status": true,
        "message": "OK",
        "data": {
            "id": 19,
            "role_id": 1,
            "name": "Icie Steuber",
            "email": "xkris@example.net",
            "created_at": "2025-03-09T19:03:49.000000Z",
            "updated_at": "2025-03-09T19:03:49.000000Z",
            "deleted_at": null,
            "role": {
                "id": 1,
                "role": "admin",
                "created_at": "2025-03-09T19:00:57.000000Z",
                "updated_at": "2025-03-09T19:00:57.000000Z"
            }
        }
    }
    
#### **5. Delete Users**
- **Endpoint:** `DELETE /api/users/:id`
- **Headers:**
    ```json
    {
        "Authorization": "Bearer your_jwt_token"
    }
- **Request:**
    ```json
    {}
- **Response:**
    ```json
    {
        "status": true,
        "message": "OK",
        "data": "User has been successfully deleted."
    }
    

# Setup & Installation Guide

This guide provides step-by-step instructions to set up and run the Laravel-based REST API.

---

## **Prerequisites**

Before proceeding, ensure you have the following installed:

- **PHP** (≥ 8.1)
- **Composer**
- **Laravel 11**
- **Docker & Docker Compose**
- **PostgreSQL** (or any preferred database)
- **Git**

---

## **1. Clone the Repository**
First, clone the repository from GitHub:
```sh
  git clone https://github.com/helloirfanaditya/hpai.git
  cd hpai
```
## **2. Install Dependencies**
Install all required dependencies using Composer:
```sh
  composer install
```
## **3. Set Up Environment Variables**
Copy the `.env.example` file and rename it to `.env`:
```sh
  cp .env.example .env
```
Then, update the following values in `.env`:
```sh
  APP_NAME="Laravel API"
  APP_ENV=local
  APP_KEY=base64:GENERATED_KEY_HERE
  APP_DEBUG=true
  APP_URL=http://localhost

  DB_CONNECTION=pgsql
  DB_HOST=postgres
  DB_PORT=5432
  DB_DATABASE=your_database_name
  DB_USERNAME=your_database_user
  DB_PASSWORD=your_database_password

  JWT_SECRET=your_jwt_secret_key
```
Generate the application key:
```sh
  php artisan key:generate
```
Generate the application jwt secret:
```sh
  php artisan jwt:secret
```
## **4. Run Migrations & Seed Database**
Run the following command to create tables and seed test data:
```sh
  php artisan migrate
  php artisan db:seed
```
## **5. Start Docker Containers**
To run the application inside Docker, use:
```sh
  docker-compose up -d
```
## **6. Start the Laravel API**
Install all required dependencies using Composer:
```sh
  php artisan serve
```
By default, the API will be accessible at:
```sh
  http://127.0.0.1:8000
```
7. Running Unit Tests
Install all required dependencies using Composer:
```sh
  php artisan test
```
