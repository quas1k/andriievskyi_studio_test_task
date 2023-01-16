<?php

use Bot\Kernel;

require_once 'vendor/autoload.php';

// Set memory threshold (in bytes)
$memoryThreshold = 100000000;
$countRestart = 0;

// Run script every n seconds
$sleep_time = 10;

// Creating kernel object
$kernel = new Kernel();

// Start infinite loop
while (true) {
    // Check current memory usage
    $memoryUsage = memory_get_usage();
    if ($memoryUsage > $memoryThreshold) {
        // Restart script if memory usage exceeds threshold
        $countRestart++;
        exec('php '.__FILE__.' &');
        file_put_contents('bot.log', "Restart script, Memory usage: $memoryUsage, Restart count: $countRestart\n", FILE_APPEND);
        exit();
    }
    file_put_contents('bot.log', "Running script, Memory usage: $memoryUsage\n", FILE_APPEND);
    gc_collect_cycles();
    // Call kernel handle
    $kernel->handle();
    // Sleep for a period of time
    sleep($sleep_time);
}