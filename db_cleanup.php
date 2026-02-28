<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;

try {
    echo "Checking for tables...\n";
    if (Schema::hasTable('employee_profiles')) {
        echo "employee_profiles exists. Dropping...\n";
        Schema::drop('employee_profiles');
        echo "Dropped employee_profiles.\n";
    }
    if (Schema::hasTable('user_meta')) {
        echo "user_meta exists. Dropping...\n";
        Schema::drop('user_meta');
        echo "Dropped user_meta.\n";
    }
    echo "Cleanup complete.\n";
}
catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
