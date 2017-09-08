<?php
//use session
session_start();
// Numerical paremeters
$tick=0.25;//0.25
$mark_length=0.1;
$x_range=2.5;//2.5
$y_range=2.5;//2.5
// Pixel paremeters
$t_pad=30;
$l_pad=30;
$tick_n2p=0.0;
$x_width=0.0;
$y_height=0.0;
$image_height=560;
$image_width=560;
// Adjust numerical and pixel paremeters by image_height
$y_height=$image_height-$t_pad*2;
$n2p=$y_height/$y_range;
$tick_n2p=$tick*$n2p;
$x_width=$x_range*$n2p;
if ($x_width < $image_width-2*$l_pad) {
    $l_pad=($image_width-$x_width)/2;
} else {
    $image_width=2*$l_pad+$x_width;
}
// Convert x y to pixels
function n2p($x,$y){
    global $l_pad;
    global $t_pad;
    global $image_height;
    global $n2p;
    $ans_x=$x*$n2p+$l_pad;
    $ans_y=$image_height-($y*$n2p+$t_pad); 
    return array($ans_x,$ans_y);
}
//$_SESSION['debug']=$varr[0];
// Create GD Image
$img = imagecreatetruecolor($image_width, $image_height);
// Assign some colour 
$black = imagecolorallocate($img, 0, 0, 0);
$white = imagecolorallocate($img, 255, 255, 255);
$red = imagecolorallocatealpha($img, 255, 153, 153,75);
$green = imagecolorallocatealpha($img, 153, 255, 153,75);
$blue = imagecolorallocatealpha($img, 153, 153, 255,75);
// Set background colour to white
imagefill($img, 0, 0, $white);
//load varibles from session
$row1x1=0.25;$row1y1=1.25;
$row1x2=1.25;$row1y2=0.25;
$row2x1=0.25;$row2y1=2.25;
$row2x2=1.25;$row2y2=1.25;
$row3x1=1.25;$row3y1=1.25;
$row3x2=2.25;$row3y2=0.25;
//
$y_up=$_SESSION['index-post']['yx1'];
$row1y1=$row1y1+$y_up;$row1y2=$row1y2+$y_up;
$x1x2=$_SESSION['index-post']['x1x2'];
$yx2=$_SESSION['index-post']['yx2'];
$res_y=1-$y_up;
//
$semi=$yx2 - $x1x2;
$semi_left = $semi / $res_y;
$non_left = $x1x2 / $y_up;
// test case is 0.5 0.1 0.35(<0.6)
if ($semi_left >= $non_left){$x3_left = $semi_left; $y3_up=$x1x2/$semi_left;};
// test case is 0.5 0.1 0.2
// test case is 0.5 0.1 0.15
if ($semi_left < $non_left){$x3_left = $non_left;$y3_up=1-$semi/$non_left;};

$row3y1=$row3y1+$y3_up;$row3y2=$row3y2+$y3_up;
$row3x1=$row3x1-$x3_left;$row3x2=$row3x2-$x3_left;
//
//$_SESSION['debug']=$row3x2;
// draw first rectangle
list($x1_p,$y1_p)=n2p((float) $row1x1, (float) $row1y1);
list($x2_p,$y2_p)=n2p((float) $row1x2, (float) $row1y2);
imagefilledrectangle($img, $x1_p, $y1_p, $x2_p, $y2_p, $red);
imagerectangle($img, $x1_p, $y1_p, $x2_p, $y2_p, $black);
// draw second rectangle
list($x1_p,$y1_p)=n2p((float) $row2x1, (float) $row2y1);
list($x2_p,$y2_p)=n2p((float) $row2x2, (float) $row2y2);
imagefilledrectangle($img, $x1_p, $y1_p, $x2_p, $y2_p, $green);
imagerectangle($img, $x1_p, $y1_p, $x2_p, $y2_p, $black);
// draw third rectangle
list($x1_p,$y1_p)=n2p((float) $row3x1, (float) $row3y1);
list($x2_p,$y2_p)=n2p((float) $row3x2, (float) $row3y2);
imagefilledrectangle($img, $x1_p, $y1_p, $x2_p, $y2_p, $blue);
imagerectangle($img, $x1_p, $y1_p, $x2_p, $y2_p, $black);
// Draw x-axis
// the imageline will automatically cast float type into interger.
list($x1,$y1)=n2p(0.0,0.0);
list($x2,$y2)=n2p($x_range,0.0);
imageline($img, $x1, $y1, $x2, $y2, $black);
// Draw y-axis
list($x1,$y1)=n2p(0.0,0.0);
list($x2,$y2)=n2p(0.0,$y_range);
imageline($img, $x1, $y1, $x2, $y2, $black);
$counter=1;
// Draw x ticks
$n = (int) ($x_range/$tick);
$x1=0.0;$y1=0.0;
$x2=0.0;$y2=$mark_length;
$short_y2=$y2/2.0;
for ($i=1;$i<=$n;$i++){
    $x1=$x1+$tick;
    $x2=$x2+$tick;
    list($x1_p,$y1_p)=n2p($x1,$y1);
    list($x2_p,$y2_p)=n2p($x2,$y2);
    if ($counter==2) {
        imageline($img, $x1_p, $y1_p, $x2_p, $y2_p, $black);
        imagestring($img,4,$x1_p,$y1_p,strval($x1),$black);
        $counter=1; } else { 
        $counter=$counter+1;
        list($x2_p,$y2_p)=n2p($x2,$short_y2);
        imageline($img, $x1_p, $y1_p, $x2_p, $y2_p, $black);
        };
}
$counter=1;
// Draw y ticks
$n = (int) ($y_range/$tick);
$x1=0.0;$y1=0.0;
$x2=$mark_length;$y2=0.0;
$short_x2=$x2/2.0;
for ($i=1;$i<=$n;$i++){
    $y1=$y1+$tick;
    $y2=$y2+$tick;
    list($x1_p,$y1_p)=n2p($x1,$y1);
    list($x2_p,$y2_p)=n2p($x2,$y2);
    if ($counter==2) {
        imageline($img, $x1_p, $y1_p, $x2_p, $y2_p, $black);
        imagestring($img,4,$x1_p-$l_pad,$y1_p,strval($y1),$black);
        $counter=1; } else {
        $counter=$counter+1;
        list($x2_p,$y2_p)=n2p($short_x2,$y2);
        imageline($img, $x1_p, $y1_p, $x2_p, $y2_p, $black);
        };
}
// Define output header
header('Content-Type: image/png');
// Output the png image
imagepng($img);
// Destroy GD image
imagedestroy($img);


