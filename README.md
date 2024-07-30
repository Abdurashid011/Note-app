# NOTE App

This project is a Note App that allows users to manage their personal notes. The application is built using PHP and MySQL, and it can also be managed via a Telegram bot.

## Installation

1. **Clone the repository**:
    ```bash
    git clone https://github.com/USERNAME/NOTE.git
    cd NOTE
    ```

2. **Set up MySQL database**:
    - Create a database named `NOTES`.
    - Run the following SQL query:
        ```sql
        CREATE DATABASE NOTES;
        USE NOTES;

        CREATE TABLE notes (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            content TEXT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );
        ```

3. **Install Composer packages**:
    ```bash
    composer install
    ```

4. **Set up Telegram bot**:
    - Create a bot using [BotFather](https://core.telegram.org/bots#botfather) and obtain the token.
    - Enter the token in the `bot.php` file.

5. **Configuration**:
    - Create a `config.php` file and enter the following information:
        ```php
        <?php
        return [
            'db' => [
                'host' => 'localhost',
                'dbname' => 'NOTES',
                'user' => 'root',
                'password' => '',
            ],
            'telegram' => [
                'bot_token' => 'YOUR_TELEGRAM_BOT_TOKEN'
            ]
        ];
        ```

## Usage

1. **Via web interface**:
    - Start the `index.php` file:
        ```bash
        php -S localhost:8000
        ```
    - Go to `http://localhost:8000` in your browser.

2. **Via Telegram bot**:
    - Open the bot and send the `/start` command.

## Project Structure

- `index.php`: Main file, displays the web interface.
- `config.php`: Configuration file, includes database connection and Telegram bot token.
- `bot.php`: Main file for the Telegram bot.
- `src/Database.php`: Class for interacting with the database.
- `src/Note.php`: Class for handling notes.
- `src/Bot.php`: Contains the logic for the Telegram bot.

## Features

- **Add Note**: Add new notes.
- **View Notes**: View all notes.
- **Delete Notes**: Delete notes.
- **Manage via Telegram**: Manage notes via Telegram bot.
