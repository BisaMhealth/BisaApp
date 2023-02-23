# Bisa Health

Bisa Health is a mobile and web application built to improve access to healthcare services for people in Ghana and other African countries. The application is built with Flutter for the mobile app and Laravel and Vue.js for the web application.

## Features

- Find healthcare providers near you
- Book appointments with healthcare providers
- Chat with healthcare providers in real-time
- Track your health progress
- Receive reminders for your health appointments and medications

## Installation

### Mobile App

##This repository contains the following branches

-Backend(Containing all APIs for both web and mobile), 
-Admin(Which has project files for the Administrator dashboard), 
-Frontend(Which represents the BisaApp web version) and 
-mobile(which contains the mobile app)

To run the Bisa Health mobile app, follow these steps:

1. Clone the repository to your local machine
2. Navigate to the `mobile` directory
3. Run `flutter pub get` to install the app's dependencies
4. Run `flutter run` to start the app on an emulator or physical device

### Web Application

To run the Bisa Health web application, follow these steps:

1. Clone the repository to your local machine
2. Navigate to the `web` directory
3. Run `composer install` to install the application's dependencies
4. Create a new MySQL database for the application
5. Copy the `.env.example` file to `.env` and set your database credentials
6. Run `php artisan migrate` to create the database tables
7. Run `npm install` to install the application's front-end dependencies
8. Run `npm run dev` to build the application's front-end assets
9. Run `php artisan serve` to start the application on a local web server

## Usage

To use the Bisa Health mobile app, simply open the app and search for healthcare providers near you. You can then book appointments and chat with providers to receive medical advice and treatment.

To use the Bisa Health web application, open the application in your web browser and create an account. Once you have an account, you can search for healthcare providers and book appointments. You can also chat with healthcare providers and track your health progress using the application's dashboard.

## Contributing

If you would like to contribute to the Bisa Health application, please follow these steps:

1. Fork the repository to your GitHub account
2. Create a new branch for your changes
3. Make your changes to the code
4. Write tests for your changes
5. Submit a pull request to the main repository

## License

The Bisa Health application is licensed under the MIT license. See the [LICENSE](./LICENSE) file for more information.
