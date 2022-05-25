<?php
require __DIR__ . '/vendor/autoload.php';

$start = microtime(true);
try {
    $ssh = new \Meklis\Network\Console\Telnet();
    $ssh->setDeviceHelper(new \Meklis\Network\Console\Helpers\ZTE());
    $ssh->connect("10.0.0.2");
    $ssh->login("helper", "bbF3e43G5G");
    echo $ssh->exec("show card");
} catch (\Exception $e) {
    echo $e->getMessage() . "\n\n";
}
echo "\n";
$time_elapsed_secs = microtime(true) - $start;
echo "\n";
printf("Executed time: %f\n", $time_elapsed_secs);
