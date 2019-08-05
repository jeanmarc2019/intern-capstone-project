# intern-capstone-project
Summer 2019 intern capstone project deliverable

## Requirements:
* docker/docker-compose
* composer
* npm

## Installation:
`cd` into the `docker` folder and run `docker-compose build` and `docker-compose up`.  Then navigate to the `capstone` directory and run `composer install`.  After composer is finished installing dependencies, run `artisan migrate` and then finally `npm run watch` to have Vue automatically update while making changes.
