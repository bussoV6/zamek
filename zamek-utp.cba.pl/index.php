<?php

// tu ma być połączenie z bazą

$log = fopen("logi.txt", "a"); //tymczasowe logi

$dane=$_GET['key']. "\n\r ";
fputs($log, $dane);

fclose($log);


?>