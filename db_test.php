<?php
$host = '127.0.0.1';
$user = 'root';
$passwords = ['', 'root', 'admin123', 'password', '12345678'];

foreach ($passwords as $pass) {
    try {
        $dsn = "mysql:host=$host;charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $pdo = new PDO($dsn, $user, $pass, $options);
        echo "SUCCESS: Password is '$pass'\n";
        exit(0);
    }
    catch (\PDOException $e) {
        echo "FAIL: Password '$pass' - " . $e->getMessage() . "\n";
    }
}
echo "ALL ATTEMPTS FAILED\n";
exit(1);
