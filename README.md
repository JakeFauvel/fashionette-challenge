# fashionette TVMaze GET request challenge

### Basic setup/running the project

Copy accross the config values from .env.example to a .env file, the TVMaze API / endpoints are in the example file.

If you are running on Mac, the project can be run using: `./vendor/bin/sail up` in the main directory (docker desktop is required).

In a second terminal session run the frontend using `npm run dev` (`npm install && npm run dev` on first run).

Running the project locally I used **fashionette.local** as my hosts entry.

### Basic usage
Basic usage instructions are included on the homepage of the application as well as a simple overview of some error codes.

### Unit tests
The application comes some basic unit tests, to run the tests run `php artisan test` from the project directory.
