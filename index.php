<?php

include_once 'IvsBuilder.php';

$testValuesList = [365, 185, 275, 785, 650, 485, 1452, 852, 190, 780, 772, 1750, 275, 380, 365, 1500, 340, 456, 950, 1100];

$ivsBuilder = new IvsBuilder($testValuesList);

var_dump($ivsBuilder->buildIvs());


