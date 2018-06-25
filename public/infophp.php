<?php

ob_start();

phpinfo();

$x = ob_get_contents();

ob_end_clean();	

$file = fopen('inffo.txt', 'w+');
fwrite($file, $x);
fclose($file);
