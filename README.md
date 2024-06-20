# Diffie-Hellman Key Exchange Attack

This project demonstrates an attack on the Diffie-Hellman key exchange by solving the discrete logarithm problem using the baby-step giant-step algorithm. The implementation is done in a Laravel controller.

## Prerequisites

- PHP 7.4 or higher with GMP extension
- Composer
- Laravel 8.x or 9.x
- A web server like Apache or Nginx
- MySQL or any other database supported by Laravel

## Installation

1. **Clone the repository:**

   
    git clone https://github.com/yourusername/diffie-hellman-attack.git
    cd diffie-hellman-attack

    composer install

    cp .env.example .env

    php artisan key:generate

    Ensure GMP extension is enabled:

    Make sure the gmp extension is enabled in your php.ini file. If it's not, enable it by uncommenting the following line
    extension=gmp

    Start the development server:
    php artisan serve
    
    Open your web browser and go to http://localhost:8000

    GET /api/diffie-hellman

    This endpoint will return the private key a and the shared secret key K.
