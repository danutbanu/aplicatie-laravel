# Client Management

Laravel application for managing clients, with authentication, client CRUD, document upload, filtering, sorting and pagination.

## Features

- User registration
- User login
- User logout
- Protected client management routes
- Create client
- View client details
- Edit client
- Delete client
- Upload ID front photo
- Upload ID back photo
- View and download uploaded ID photos
- Delete uploaded photos when the client is deleted
- Search clients by first name or last name
- Filter clients by CNP, email, phone and county
- Sort clients by table columns
- Paginated client list
- Server-side validation

## Requirements

- Docker
- Laravel Sail

## Installation

Clone the repository:

```bash
git clone repository-url
cd project-folder
```

Copy the environment file:

```bash
cp .env.example .env
```

Install PHP dependencies:

```bash
sail composer install
```

Install JavaScript dependencies:

```bash
sail npm install
```

Start Docker containers:

```bash
sail up -d
```

Generate the application key:

```bash
sail artisan key:generate
```

Run database migrations:

```bash
sail artisan migrate
```

Create the storage symbolic link:

```bash
sail artisan storage:link
```

Build frontend assets:

```bash
sail npm run build
```

Open the application in the browser:

```txt
http://localhost
```

## Environment configuration

The project uses the `.env.example` file as a starting point for local configuration.

For local development:

```env
APP_ENV=local
APP_DEBUG=true
```

For production, internal errors and stack traces should not be displayed to final users:

```env
APP_ENV=production
APP_DEBUG=false
```

## Database

The project includes all necessary migrations.

The main client data is stored in the `clients` table.

## File storage

Client ID photos are stored using Laravel's public storage disk.

Uploaded files are saved in:

```txt
storage/app/public/clients
```

They are accessed publicly through:

```txt
public/storage
```

The following command must be executed once:

```bash
sail artisan storage:link
```

## Code structure

The project follows Laravel conventions.

Main files:

```txt
app/Http/Controllers/ClientController.php
app/Http/Requests/StoreClientRequest.php
app/Http/Requests/UpdateClientRequest.php
app/Models/Client.php
app/Services/ClientService.php
app/Services/ClientDocumentService.php
resources/views/clients/index.blade.php
resources/views/clients/create.blade.php
resources/views/clients/show.blade.php
resources/views/clients/edit.blade.php
database/migrations
routes/web.php
```

## Security

Client management routes are protected by authentication middleware.

Validation is handled server-side through Laravel Form Requests.

Business logic is separated from controllers and views using service classes.

## Testing the application

After installation, test the following:

- Register a new user
- Login
- Logout
- Create a client
- Upload front and back ID photos
- View client details
- Download ID photos
- Edit client data
- Replace ID photos
- Delete client
- Confirm uploaded files are deleted
- Search clients
- Filter clients
- Sort clients by table columns
- Test pagination
