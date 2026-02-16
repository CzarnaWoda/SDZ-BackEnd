# 🐾 SDZ - System Zarządzania Schroniskiem dla Zwierząt

> Kompleksowe rozwiązanie webowe do zarządzania schroniskiem dla zwierząt oparte na frameworku Laravel

[![PHP Version](https://img.shields.io/badge/PHP-8.1%2B-blue.svg)](https://php.net)
[![Laravel](https://img.shields.io/badge/Laravel-10.x-red.svg)](https://laravel.com)
[![License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE)

## 📋 O Projekcie

System SDZ (Schronisko Dla Zwierząt) to nowoczesna aplikacja webowa zaprojektowana do kompleksowego zarządzania operacjami schroniska. Projekt łączy w sobie funkcjonalności administracyjne z interfejsem użytkownika, umożliwiając efektywne zarządzanie adopcjami, opieką nad zwierzętami oraz komunikacją z potencjalnymi adopcyjnymi rodzinami.

### ✨ Główne Funkcjonalności

- 🏠 **Zarządzanie zwierzętami** - pełna baza danych podopiecznych schroniska
- 📝 **System adopcji** - obsługa wniosków i procesu adopcyjnego
- 👥 **Panel administracyjny** - zarządzanie użytkownikami i uprawnieniami
- 📊 **Raporty i statystyki** - monitoring działalności schroniska
- 🖼️ **Galeria zdjęć** - prezentacja zwierząt czekających na adopcję
- 📱 **Responsywny interfejs** - dostępność na urządzeniach mobilnych

## 🚀 Technologie

- **Backend**: Laravel 10.x (PHP)
- **Frontend**: Blade Templates + Vite
- **Baza danych**: MySQL/PostgreSQL
- **Autentykacja**: Laravel Sanctum/Breeze
- **Testy**: PHPUnit
- **CI/CD**: GitHub Actions

## 📦 Wymagania

- PHP >= 8.1
- Composer
- Node.js >= 16.x
- MySQL >= 5.7 / PostgreSQL >= 10
- Nginx/Apache

## 🛠️ Instalacja

### 1. Klonowanie repozytorium

```bash
git clone https://github.com/CzarnaWoda/SDZ-BackEnd.git
cd SDZ-BackEnd
```

### 2. Instalacja zależności

```bash
# Instalacja pakietów PHP
composer install

# Instalacja pakietów Node.js
npm install
```

### 3. Konfiguracja środowiska

```bash
# Kopiowanie pliku konfiguracyjnego
cp .env.example .env

# Generowanie klucza aplikacji
php artisan key:generate
```

### 4. Konfiguracja bazy danych

Edytuj plik `.env` i ustaw parametry połączenia z bazą danych:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sdz_database
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Migracje i seeding

```bash
# Uruchomienie migracji
php artisan migrate

# (Opcjonalnie) Wypełnienie bazy testowymi danymi
php artisan db:seed
```

### 6. Budowanie assetów

```bash
# Development
npm run dev

# Production
npm run build
```

### 7. Uruchomienie serwera

```bash
php artisan serve
```

Aplikacja będzie dostępna pod adresem: `http://localhost:8000`

## 🧪 Testy

```bash
# Uruchomienie wszystkich testów
php artisan test

# Uruchomienie testów z pokryciem kodu
php artisan test --coverage
```

## 📁 Struktura Projektu

```
SDZ-BackEnd/
├── app/                    # Logika aplikacji (Models, Controllers, Services)
│   ├── Http/
│   ├── Models/
│   └── Services/
├── bootstrap/              # Pliki startowe aplikacji
├── config/                 # Konfiguracja aplikacji
├── database/              
│   ├── migrations/        # Migracje bazy danych
│   ├── seeders/          # Seedery danych testowych
│   └── factories/        # Fabryki do generowania danych
├── public/                # Publiczne pliki (CSS, JS, obrazy)
├── resources/            
│   ├── views/            # Szablony Blade
│   ├── css/              # Pliki stylów
│   └── js/               # Pliki JavaScript
├── routes/                # Definicje tras
│   ├── web.php
│   └── api.php
├── storage/               # Pliki generowane przez aplikację
├── tests/                 # Testy jednostkowe i integracyjne
└── vendor/                # Zależności Composer
```

## 🔐 Bezpieczeństwo

- Autentykacja użytkowników z hashowaniem haseł (bcrypt)
- CSRF protection dla wszystkich formularzy
- Sanityzacja danych wejściowych
- Walidacja po stronie serwera
- Rate limiting dla API


## 👨‍💻 Autor

**Mateusz** - [CzarnaWoda](https://github.com/CzarnaWoda)

## 📄 Licencja

Ten projekt został stworzony na potrzeby akademickie.

---

⭐ Jeśli projekt Ci się podoba, zostaw gwiazdkę!
