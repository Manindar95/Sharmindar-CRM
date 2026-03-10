<?php
$hosts = ['127.0.0.1', 'localhost', '::1'];
$user = 'root';
$pass = '';

foreach ($hosts as $host) {
    echo "Testing host: $host\n";
    try {
        $pdo = new PDO("mysql:host=$host", $user, $pass);
        echo "SUCCESS: Connected via $host\n";
        exit(0);
    }
    catch (PDOException $e) {
        echo "FAIL: " . $e->getMessage() . "\n";
    }
}
exit(1);
