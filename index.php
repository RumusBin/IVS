<?php

require_once  'IvsBuilder.php';
require_once 'helpers/DateKeysProcessor.php';

$testValuesList = [365, 185, 680, 785, 650, 872, 1452, 852, 190, 780, 772, 1750, 1001, 380, 365, 1500, 820, 456, 950, 1100];

$ivsBuilder = new IvsBuilder($testValuesList);
$dateToMonthKey = new DateKeysProcessor();

$ivsSeries = $ivsBuilder->buildIvs();
$total = $ivsSeries['totalVariants'];

echo 'Company employee turnover by period is:<br>';

foreach ($ivsSeries['series'] as $series) {
    if ($series['countVars']) {
        $from = $dateToMonthKey->daysToStringMonthKey($series['minVal']);
        $to = $dateToMonthKey->daysToStringMonthKey($series['maxVal']);
        echo 'For ' . $from . '-' . $to . ' month = ' . $series['countVars']/$total*100 . '% <br>';
    }
}
echo '---------!!!!!!!!!!!!!!!!!------------';


