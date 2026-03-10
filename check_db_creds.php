<?php
$host = '127.0.0.1';
$user = 'root';
$passwords = ['', 'admin123', 'root', 'password'];

foreach ($passwords as $pass) {
    try {
        $pdo = new PDO("mysql:host=$host", $user, $pass);
        echo "SUCCESS: Password is '$pass'\n";
        exit(0);
    }
    catch (PDOException $e) {
        echo "FAIL: Password '$pass' - " . $e->getMessage() . "\n";
    }
}
exit(1);
