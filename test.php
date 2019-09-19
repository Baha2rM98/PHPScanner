<?php
require_once "vendor\autoload.php";

use Scanner\Scanner;

$scn = new Scanner();
$a = $scn->nextString();
print $a;

$n = $scn->nextGMP();
$m = $scn->nextInt();
print (gmp_pow($n, $m)) . "\n";

$a = array();
for ($i = 0; $i < 3; $i++) {
    $a[$i] = $scn->nextInt();
}
print_r($a);

$file_reader = new Scanner("C:\Users\Baha2r\Desktop\a.txt");
$file = "";
while ($file_reader->hasNext()) {
    $file .= $file_reader->nextLine();
}
$file_reader->close();
print $file;
echo "\n";