# README.md

## Project Name: Noche Kitchen Sales Management

This project is a web-based application designed to streamline day-to-day sales operations for Noche Kitchen.  It provides a system for recording transactions, managing orders, and potentially generating reports, helping staff efficiently handle sales and track key business data.

### Project Purpose

This application aims to replace manual sales tracking methods with a digital solution.  It will allow Noche Kitchen staff to quickly and accurately record customer orders, calculate totals, and manage transactions.  Future enhancements may include inventory management, sales reporting, and user role management.

### Technologies Used

*   PHP
*   CodeIgniter 4 (Framework)
*   MySQL (Database)
*   HTML, CSS, JavaScript (Frontend)

### Installation

1.  **Clone the Repository:**
    ```bash
    git clone https://github.com/Xioketh/CodeIgniter-POS.git
    ```

2.  **Install Dependencies:**
    ```bash
    composer install
    ```

3.  **Database Configuration:**
    *   Create a MySQL database named `noche_kitchen`.
    *   Open the `.env` file and configure the database connection settings:
        ```
        database.default.hostname = localhost
        database.default.username = your_db_username
        database.default.password = your_db_password
        database.default.database = noche_kitchen
        ```

4.  **Create Database Tables:**
    ```bash
    php spark migrate
    ```
    This command will run all pending migrations and create the necessary database tables.  If you have specific migration files, you can run them individually:
    ```bash
    php spark migrate -n CreateFoodsTable // Example: Runs only the CreateFoodsTable migration
    ```

5.  **Seed the Database (Optional):**
    If you have seed data (like initial food items), run:
    ```bash
    php spark db:seed FoodSeeder  // Example: Run the FoodSeeder
    ```

6.  **Start the Development Server:**
    ```bash
    php spark serve
    ```

7.  **Access the Application:**
    Open your web browser and go to `http://localhost:8080` (or the URL provided by `php spark serve`).

### Setting up the Project (PHP Spark Migrate)

CodeIgniter 4's `php spark migrate` command manages your database schema.

1.  **Create Migrations:**
    ```bash
    php spark migrate:create CreateFoodsTable // Creates a migration file
    ```

2.  **Write Migration Code (Example):**
    ```php
    <?php
    namespace App\Database\Migrations;
    use CodeIgniter\Database\Migration;

    class CreateFoodsTable extends Migration
    {
        public function up()
        {
            $this->forge->addField([
                //... your table fields...
            ]);
            $this->forge->addKey('id', true);
            $this->forge->createTable('foods');
        }

        public function down()
        {
            $this->forge->dropTable('foods');
        }
    }
    ```

3.  **Run Migrations:**
    ```bash
    php spark migrate
    ```

4.  **Rollback Migrations:**
    ```bash
    php spark migrate:rollback
    ```

5.  **Other Migration Commands:**
    *   `php spark migrate:status`
    *   `php spark migrate:refresh` (Use with caution!)

### Contributing

[Add contribution guidelines if applicable]

### License

Copyright (c) 2023 Kethaka Janadithya Ranasinghe