Intinte Abstergo
___

Intinte Abstergo is a project to create an engine to detect similar images. Based on the local image database (JPEG by default), it makes comparisons with the graphic file. If it finds a similar one, it returns the file ID number.

The system includes multithreading support (by default it is set to 12, if you have more or less cores, change the value of $GLOBALS['threads'] in line 30), which significantly speeds up searching for similar images.

The program displays information on the output, which file is similar / the same.

I recommend creating a database (eg SQLite) that stores links to the original versions of the images.

Each image on the disk is at 480x270 resolution to save space and speed up data reading.

## Install

* Install Imagemagick, GD (for PHP)
* Install Imagemagick (Linux)
* Use PHP 7.0 or newest

## PHP Interpreter or HHVM?

PHP Interpreter. Much faster (not sure why :D)

## Can I help you?

Sure thing!
