#!/bin/sh

git clone https://github.com/vajiralasantha/PHP-Image-Compare
cd PHP-Image-Compare
composer install
cd ..
git clone https://github.com/dsoms/php-thread
cd php-thread
composer install
cd ..