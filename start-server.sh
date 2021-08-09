#!/bin/bash

cd publisher

php artisan serve --port=8000

cd ../subscriber

php artisan serve --port=9000



