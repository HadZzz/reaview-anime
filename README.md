# AnimeVault

AnimeVault is a modern web application for anime enthusiasts to discover, track, and manage their anime watching experience. Built with Laravel and powered by the Jikan API, it offers a comprehensive set of features for anime lovers.

## Features

### 🔍 Anime Discovery
- Search through a vast database of anime
- View detailed information about each anime
- Browse anime by genres, seasons, and popularity
- Get personalized anime recommendations

### 📝 Review System
- Write and share your reviews
- Rate anime on a scale of 1-10
- Read other users' reviews
- Edit or delete your own reviews

### 📋 Watchlist Management
- Add anime to your personal watchlist
- Track your watching status (Planning, Watching, Completed, Dropped)
- Sort and filter your watchlist
- Quick status updates
- View watching statistics and progress
- Search within your watchlist
- Sort by title or date added

### 🎨 User Interface
- Modern and responsive design
- Dark/Light mode toggle
- Mobile-friendly interface
- Intuitive navigation
- Real-time search functionality

## Technologies Used

- **Backend:** Laravel 11
- **Frontend:** Tailwind CSS, Alpine.js
- **API:** Jikan API (MyAnimeList)
- **Database:** MySQL
- **Authentication:** Laravel Breeze

## Requirements

- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL

## Installation

1. Clone the repository:
```bash
git clone https://github.com/yourusername/animevault.git
cd animevault
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install NPM dependencies:
```bash
npm install
```

4. Create and configure your environment file:
```bash
cp .env.example .env
php artisan key:generate
```

5. Configure your database in `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=animevault
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

6. Run migrations:
```bash
php artisan migrate
```

7. Build assets:
```bash
npm run build
```

8. Start the development server:
```bash
php artisan serve
```

## Usage

1. Register a new account or login
2. Search for anime using the search bar
3. Click on an anime to view details
4. Add anime to your watchlist
5. Update watching status as you progress
6. Write reviews and rate anime
7. Use the dark/light mode toggle for comfortable viewing

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Contact

Your Name - your.email@example.com

Project Link: [https://github.com/yourusername/animevault](https://github.com/yourusername/animevault)

## Acknowledgments

- [Jikan API](https://jikan.moe/)
- [Laravel](https://laravel.com/)
- [Tailwind CSS](https://tailwindcss.com/)
- [Alpine.js](https://alpinejs.dev/)
