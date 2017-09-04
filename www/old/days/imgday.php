<?php

$full=imagecreatetruecolor(530, 400);
$head=imagecreatefrompng("d03.png");
$bottom=imagecreatefrompng("m04.png");

$transparent = imagecolorallocatealpha($full, 0, 0, 0, 127); 
imagefill($full, 0, 0, $transparent);

imagecopy($full, $head, 0, 0, 0, 0, 530, 270);
imagecopy($full, $bottom, 0, 270, 0, 0, 530, 400);

imagealphablending($full, false);
imagesavealpha($full, true);
header('Content-Type: image/png');
imagepng($full); 
imagedestroy($full);
?>