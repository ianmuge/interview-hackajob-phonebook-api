# Hackajob Phonebook API Submission
## Dependencies
This project is built on lumen (A laravel MicroFramework) and backed by SQLite. \
Requirements: 
- PHP >= 7.2
- Composer
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
## Requirements Covered
- Contacts CRUD and simplified search
- Authentication (Using JWT)
- Unit and Functional Tests
## Deploy and run instructions
### Setup
- Go to project root
- Fetch vendor required code and dependecies \
```composer require```
- Change the absolute path of the ``DB_DATABASE`` variable in the .env file to point to the projects SQLITE database, located in the database folder. *It needs to be an absolute path. It ships with sample data*
- Start built-in PHP development server \
``` php -S localhost:8000 -t public```
- The API is now available on http://localhost:8000\
#### Reinitializing
To reinitialize the application you can rerun the migration script: ``php artisan migrate:fresh --seed`` from the project root
### Testing
- From the project root run  
``./vendor/bin/phpunit --debug --verbose`` to run phpunit tests
## API Functionality
You can use POSTman to test the APIs
### Authentication
- The authentication endpoint is ``http://localhost:8000/auth/login``. You can use the sample credentials:
```
email: user@example.com
password: AGoodPassword
```
- You will get an authentication token you will use for the other restricted routes
### Contacts CRUD and search
The endpoints are: 
```
(a) GET: '/contact/' 
(b) POST: '/contact/' 
(c) GET: '/contact/{id}'
(d) PATCH: '/contact/{id}'
(e) DELETE: '/contact/{id}'
(f) GET: '/contact/search/?q={query}'
```
All these endpoints require a token passed as GET parameter labeled 'token' or in the request header with the format:
```
Authorization: Bearer {token}
```
The {id} parameters need to be numeric values.\
The POST and PATCH methods payload is similar to the one below. The name and phonenumber are required values.
```
name: {name}
phonenumber: {phone number}
address: {address}
```
* A sample postman collection can be found at: https://www.getpostman.com/collections/d9a5786a61d2e4c287f9
