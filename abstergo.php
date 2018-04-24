<?php

namespace PHPThread\Example;

use Imagick;
use BigV\ImageCompare;
use PHPThread\ThreadQueue;

require __DIR__ . '/libs/php-thread/vendor/autoload.php';
require __DIR__ . "/libs/PHP-Image-Compare/vendor/autoload.php";

if(mime_content_type('compare.jpg')=="image/gif") {
shell_exec("convert compare.jpg[0] compare.jpg");
}


if((mime_content_type('compare.jpg')=="image/png") || (mime_content_type('compare.jpg')=="image/jpeg") ) {
$image = new Imagick("compare.jpg");
$image->resizeImage(480,270, imagick::FILTER_LANCZOS, 1);
$image->setImageFormat("jpeg");
$photo = $image->getImageBlob();
$image->writeImage("compare.jpg");
$image->destroy();
}
else
{
die;
}

$GLOBALS['threads'] = 12;

// It is the function that will be called several times
function parallel_task($arg)
{
for($j=$arg; $j<=$GLOBALS['files']; $j=$j+$GLOBALS['threads'])
{

if((mime_content_type('database/'.$j.'.jpg')=="image/png") || (mime_content_type('database/'.$j.'.jpg')=="image/jpeg") ) {

if(@is_array(getimagesize('database/'.$j.'.jpg'))){


if(filesize('database/'.$j.'.jpg')!=0)
{
$image = new ImageCompare();
$value = $image->compare('compare.jpg','database/'.$j.'.jpg')."\n";


if( (!empty($value)) && ($value<=2) )
{
echo $j."\n";
}
}
}

}



}

}

// Create a queue instance with a callable function name
$TQ = new ThreadQueue("PHPThread\Example\parallel_task", $GLOBALS['threads']);

// Add tasks

// Count files
$directory = "database/";
$filecount = 0;
$files = glob($directory . "*");
if ($files){
 $filecount = count($files);
 $GLOBALS['files'] = $filecount;
}


for($i=1; $i<$threads+1; $i++)
{
$TQ->add($i);
}



// Wait until all threads exit
while (count($TQ->threads())) {
    sleep(1);    // optional
//    echo "Waiting for all jobs done...\n";
    $TQ->tick();    // mandatory!
}