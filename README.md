Here’s a comprehensive `README.md` for your Laravel elearning project. This file will help users and developers understand the project, set it up, and contribute to it.

---

# Laravel Chatbot with Deepseek API

A Laravel-based chatbot that answers questions related to PHP and Laravel using the Deepseek API. The chatbot filters questions to ensure they are relevant to PHP and Laravel, and it provides a user-friendly interface for interaction.

---

## Features

- **PHP/Laravel-Specific Chatbot**: Only answers questions related to PHP and Laravel.
- **Markdown Support**: Renders bot responses with markdown formatting.
- **Syntax Highlighting**: Highlights code blocks in bot responses.
- **Real-Time Interaction**: Smooth, real-time chat interface without page reloads.
- **Authentication**: User authentication using Laravel Jetstream.
- **Chat History**: Saves chat history for authenticated users.
- **Error Handling**: Graceful error handling for API failures and invalid questions.

---

## Prerequisites

Before you begin, ensure you have the following installed:

- PHP 8.0 or higher
- Composer
- Node.js and npm
- MySQL or any other supported database
- Deepseek API key (or OpenRouter API key if using OpenRouter)

---

## Installation

1. **Clone the Repository**
   ```bash
   git clone https://github.com/yourusername/laravel-chatbot.git
   cd laravel-chatbot
   ```

2. **Install PHP Dependencies**
   ```bash
   composer install
   ```

3. **Install JavaScript Dependencies**
   ```bash
   npm install
   ```

4. **Set Up Environment Variables**
   Copy the `.env.example` file to `.env` and update the following variables:
   ```env
   APP_NAME="Laravel Chatbot"
   APP_URL=http://localhost:8000

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=laravel_chatbot
   DB_USERNAME=root
   DB_PASSWORD=

   DEEPSEEK_API_KEY=your_deepseek_api_key_here
   ```

5. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

6. **Run Migrations**
   ```bash
   php artisan migrate
   ```

7. **Compile Assets**
   ```bash
   npm run dev
   ```

8. **Start the Development Server**
   ```bash
   php artisan serve
   ```

9. **Access the Application**
   Open your browser and navigate to:
   ```
   http://localhost:8000
   ```

---

## Configuration

### **1. Deepseek API**
- Obtain an API key from [Deepseek](https://deepseek.com) or [OpenRouter](https://openrouter.ai).
- Add the API key to your `.env` file:
  ```env
  DEEPSEEK_API_KEY=your_api_key_here
  ```

### **2. Markdown and Syntax Highlighting**
- The chatbot uses `marked.js` for markdown parsing and `highlight.js` for syntax highlighting.
- Ensure these dependencies are installed:
  ```bash
  npm install marked highlight.js
  ```

### **3. Authentication**
- The project uses Laravel Jetstream for authentication.
- To scaffold authentication views, run:
  ```bash
  php artisan jetstream:install livewire
  npm install && npm run dev
  php artisan migrate
  ```

---

## Usage

1. **Register or Log In**
   - Create an account or log in to access the chatbot.

2. **Ask Questions**
   - Type your PHP or Laravel-related questions in the chat input.
   - The chatbot will respond with relevant answers.

3. **View Chat History**
   - Authenticated users can view their chat history.

---

## Project Structure

```
laravel-chatbot/
├── app/
│   ├── Http/Controllers/
│   │   └── ChatController.php
│   ├── Models/
│   │   └── Chat.php
│   └── Providers/
├── config/
├── database/
│   ├── migrations/
│   └── seeders/
├── public/
├── resources/
│   ├── js/
│   │   └── app.js
│   ├── views/
│   │   └── chat.blade.php
│   └── lang/
├── routes/
│   └── web.php
├── tests/
├── .env.example
├── .gitignore
├── composer.json
├── package.json
├── README.md
└── vite.config.js
```

---

## API Integration

The chatbot uses the Deepseek API to generate responses. The API request is handled in `ChatController.php`:

```php
$response = Http::timeout(60)
    ->withHeaders([
        'Authorization' => 'Bearer ' . config('services.deepseek.key'),
        'Content-Type' => 'application/json',
    ])->post('https://api.deepseek.com/v1/chat/completions', [
        'model' => 'deepseek-chat',
        'messages' => [
            [
                'role' => 'user',
                'content' => $question
            ]
        ],
        'temperature' => 0.7,
        'max_tokens' => 1000,
    ]);
```

---

## Error Handling

- **Invalid Questions**: If a question is not related to PHP or Laravel, the chatbot will respond with:
  ```
  Please ask questions related to PHP and Laravel only.
  ```
- **API Errors**: If the API request fails, the chatbot will respond with:
  ```
  Error processing your request. Please try again.
  ```

---

## Contributing

1. Fork the repository.
2. Create a new branch:
   ```bash
   git checkout -b feature/your-feature-name
   ```
3. Commit your changes:
   ```bash
   git commit -m "Add your feature"
   ```
4. Push to the branch:
   ```bash
   git push origin feature/your-feature-name
   ```
5. Open a pull request.

---

## License

This project is open-source and available under the [MIT License](LICENSE).

---

## Acknowledgments

- [Laravel](https://laravel.com) for the PHP framework.
- [Deepseek](https://deepseek.com) for the chatbot API.
- [Marked.js](https://marked.js.org) for markdown parsing.
- [Highlight.js](https://highlightjs.org) for syntax highlighting.

---

## Support

For issues or questions, please [open an issue](https://github.com/yourusername/laravel-chatbot/issues) or contact the maintainer.

---

Enjoy using the Laravel Chatbot! 🚀