🛒 WachZiaan - Prduct Scanner App

## 📱 Overview
WachmZiaan is a mobile application that allows users to scan product barcodes to retrieve detailed product information, including ingredients, nutritional values, and allergens. The app helps users make informed decisions about the products they consume.

## ✨ Features

### Product Scanning
- 📸 Barcode scanning functionality
- 🔍 Quick product lookup
- 📊 Detailed product information

### Product Details
- 🏷️ Product name and brand
- 📝 Ingredients list
- ⚠️ Allergen information
- 🥗 Nutritional information (Nutri-Score)
- 🧪 Additives and their effects

### User Experience
- 🌓 Dark/Light theme support
- 🔄 Offline access to recently viewed products
- ⚡ Fast and responsive UI

## 🛠️ Tech Stack

### Backend
- **Framework**: Laravel 10.x
- **API**: RESTful API
- **Database**: MySQL
- **Authentication**: Laravel Sanctum

### Frontend
- **Language**: Kotlin
- **Architecture**: MVVM
- **Libraries**:
  - Retrofit for API calls
  - CameraX for barcode scanning
  - Room for local storage
  - Coroutines & Flow for async operations

## 📁 Project Structure

```
mobile-app/
├── backend/           # Laravel backend
│   ├── app/
│   ├── config/
│   ├── database/
│   ├── routes/
│   └── ...
└── frontend/          # Android app
    └── app/
        ├── src/main/
        │   ├── java/com/example/wachmziaan/
        │   │   ├── models/     # Data models
        │   │   ├── ui/         # Activities & Fragments
        │   │   ├── viewmodels/ # ViewModels
        │   │   └── utils/      # Utility classes
        │   └── res/            # Resources
        └── build.gradle.kts
```

## 🚀 Getting Started

### Prerequisites
- Android Studio (latest stable version)
- Java Development Kit (JDK) 11 or higher
- PHP 8.1+
- Composer
- MySQL 8.0+

### Installation

#### Backend Setup
1. Clone the repository
2. Navigate to the backend directory: `cd backend`
3. Install dependencies: `composer install`
4. Copy `.env.example` to `.env` and configure your database
5. Generate application key: `php artisan key:generate`
6. Run migrations: `php artisan migrate`
7. Start the server: `php artisan serve`

#### Frontend Setup
1. Open the project in Android Studio
2. Sync project with Gradle files
3. Update the API base URL in `NetworkModule.kt`
4. Build and run the app on an emulator or physical device

## 📝 API Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | /api/products | Get all products |
| GET | /api/products/{product} | Get product by ID |
| POST | /api/products | Add new product |

## 🤝 Contributing
Contributions are welcome! Please feel free to submit a Pull Request.

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📄 License
This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 📧 Contact
For any inquiries, please open an issue on GitHub or contact the project maintainers.
