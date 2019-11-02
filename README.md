PHPScanner
==========
This library contains efficient classes and methods to work with input stream data for example: get numbers and 
strings from input stream(keyboard), also have some features for open and read files.

This library inspired from Scanner class in Java.

Features
--------
Get input stream as integer, float, bigInteger (GMP in PHP), string etc.
Also it provide some methods to open and read files.

You can find more information in documentation.

**[Change Input Radix] Added**

Installation
------------
Use [Composer] to install this package:

```
$ composer require baha2rmirzazadeh/phpscanner
```

Example
-------

```php
use PHPScanner\Scanner\Scanner;

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

$file_reader = new Scanner("C:\Users\Baha2r\Desktop\A.txt");
$file = "";
while ($file_reader->hasNext()) {
    $file .= $file_reader->nextLine();
}
$file_reader->close();
print $file;
echo "\n";
```

### Classes and Methods description
All of classes and methods have documentation, you can read them and figure out how they work

Authors
-------

* [Bahador Mirzazadeh]
* E-Mail: [baha2r.mirzazadeh98@gmail.com]

License
-------

All contents of this package library are licensed under the [MIT license].   