## Installation

 Clone the repository

    git clone https://github.com/Pitaka5/task-app.git

Switch to the repo folder

    cd task-app

Install all the dependencies using composer

    composer install

Copy the example env file

    cp .env.example .env

Make the required configuration changes in the .env file

    DB_DATABASE= <database name>
    DB_USERNAME= <username>
    DB_PASSWORD= <password>
    
**Create a new database in MySQL.**

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate
       
Generate a new application key

    php artisan key:generate

Start the local development server

    php artisan serve
