<?php
include 'init.php';

$dist = 5;
$timeMin = 100;
$age = 30;
$priceDist = 10;
$priceTime = 3;
$addGPS = true;
$base = new BaseTariff($dist, $timeMin, $age, ['addGPS' => $addGPS]);
echo '<br><br>';
echo '('. $dist . ' км * ' . $priceDist . ' р. + ' . $timeMin . ' мин. * ' .$priceTime . ' р.) * ' . $base->indexAge($age) . ($addGPS ? ' + GPS' : '') . ' = ' . $base->calculate() . ' р.';
echo '<br><br>';

$dist = 20;
$timeMin = 150;
$age = 30;
$priceDist = 0;
$priceTime = 200;
$timeMin = ($timeMin < 1) ? 1 : $timeMin;
$hour = (bcmod($timeMin, 60) > 0) ? 1 : 0;
$timeHour = intdiv($timeMin, 60) + $hour;
$addGPS = true;
$addDriver = true;
$hourly  = new HourlyTariff($dist, $timeMin, $age, ['addGPS' => $addGPS, 'addDriver' => $addDriver]);
echo '<br><br>';
echo '('. $dist . ' км * ' . $priceDist . ' р. + ' . $timeHour . ' ч. * ' .$priceTime . ' р.) * ' . $hourly->indexAge($age) . ($addGPS ? ' + GPS' : '') . ($addDriver ? ' + Driver' : '') . ' = ' . $hourly->calculate() . ' р.';
echo '<br><br>';

$dist = 200;
$timeMin = 1500;
$age = 30;
$priceDist = 1;
$priceTime = 1000;
$timeMin = ($timeMin < 30) ? 30 : $timeMin;
$day = (bcmod($timeMin, 1470) > 0) ? 1 : 0;
$timeDay = intdiv($timeMin, 1470) + $day;
$addGPS = true;
$addDriver = false;
$daily  = new DailyTariff($dist, $timeMin, $age, ['addGPS' => $addGPS, 'addDriver' => $addDriver]);
echo '<br><br>';
echo '('. $dist . ' км. * ' . $priceDist . ' р. + ' . $timeDay . ' сут. * ' .$priceTime . ' р.) * ' . $daily->indexAge($age) . ($addGPS ? ' + GPS' : '') . ($addDriver ? ' + Driver' : '') . ' = ' . $daily->calculate() . ' р.';
echo '<br><br>';

$dist = 50;
$timeMin = 120;
$age = 27;
$priceDist = 4;
$priceTime = 1;
$addGPS = true;
$stud  = new StudentTariff($dist, $timeMin, $age, ['addGPS' => $addGPS]);
echo '<br><br>';
echo '('. $dist . ' км * ' . $priceDist . ' р. + ' . $timeMin . ' мин. * ' .$priceTime . ' р.) * ' . $stud->indexAge($age) . ($addGPS ? ' + GPS' : '') . ' = ' . $stud->calculate() . ' р.';
echo '<br><br>';

