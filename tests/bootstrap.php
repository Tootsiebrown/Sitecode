<?php

//echo realpath();
//echo realpath("../vendor/autoload.php");

include "vendor/autoload.php";

chdir('../');

shell_exec('php artisan config:clear');
