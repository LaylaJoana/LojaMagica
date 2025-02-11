# php-routing-system

This project is a simple PHP routing system that demonstrates how to manage routes and controllers in a structured way.

## Project Structure

```
php-routing-system
├── src
│   ├── controllers
│   │   └── HomeController.php
│   ├── core
│   │   ├── Router.php
│   │   └── Request.php
│   └── views
│       └── home.php
├── public
│   └── index.php
├── composer.json
└── README.md
```

## Components

- **HomeController.php**: Contains the `HomeController` class with an `index` method that handles the logic for the home route.
  
- **Router.php**: Implements the `Router` class that manages routing logic, capturing routes, matching them against incoming requests, and calling the appropriate controller methods.
  
- **Request.php**: Defines the `Request` class that handles HTTP request data, providing methods to retrieve parameters, headers, and other request-related information.
  
- **home.php**: Contains the HTML structure for the home page, rendered by the `HomeController`.
  
- **index.php**: The entry point of the application that initializes the `Router`, processes incoming requests, and dispatches them to the appropriate controller.

## Installation

1. Clone the repository:
   ```
   git clone <repository-url>
   ```

2. Navigate to the project directory:
   ```
   cd php-routing-system
   ```

3. Install dependencies using Composer:
   ```
   composer install
   ```

## Usage

To run the application, ensure you have a local server set up (e.g., Apache, Nginx) and point it to the `public` directory. Access the application via your web browser at `http://localhost/`.

## License

This project is open-source and available under the MIT License.