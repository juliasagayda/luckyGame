Lucky Game 🎲

Lucky Game is a Laravel-based application that lets you test your luck! Follow the steps below to set up and run the project locally.

📥 Cloning the Repository

Clone the project from GitHub: git clone https://github.com/juliasagayda/luckyGame.git

Navigate to the project directory:

🔧 Environment Setup

Create a copy of the environment configuration file: .env

Generate the application key:
php artisan key:generate to generate app key in .env

💾 Database Setup

Create the database folder: mkdir -p database 

Create the SQLite database file: touch database/database.sqlite

Add the database path to the .env file: DB_DATABASE=./database/database.sqlite

Refresh the configuration cache: php artisan config:cache

Run the database migrations: php artisan migrate

📦 Installing Dependencies

Install PHP dependencies: composer install

Install Node.js dependencies: npm install

🛠️ Building the Frontend

Build the assets for development: npm run dev

🚀 Running the Application

Start the Laravel development server: run php artisan serve

Open your browser at http://127.0.0.1:8000

✅ Enjoy!

Now you can enjoy your Lucky Game! 🎉
