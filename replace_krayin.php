<?php

$file_list = 'krayin_files_utf8.txt';
if (!file_exists($file_list)) {
    die("File list not found.\n");
}

$lines = file($file_list, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$files_modified = 0;

foreach ($lines as $line) {
    // Make sure we skip the old webkul directories so we don't accidentally modify backups
    if (strpos($line, 'laravel-crm') === 0 || strpos($line, 'laravel-crm/') !== false) {
        continue;
    }

    $path = __DIR__ . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $line);

    if (file_exists($path) && is_file($path)) {
        $content = file_get_contents($path);
        if ($content !== false && stripos($content, 'krayin') !== false) {
            // Perform replacements
            $new_content = preg_replace('/\bKrayin\b/', 'Sharmindar', $content);
            $new_content = preg_replace('/\bkrayin\b/', 'sharmindar', $new_content);
            $new_content = preg_replace('/\bKRAYIN\b/', 'SHARMINDAR', $new_content);

            // Specific case for composer packages
            $new_content = str_replace('krayin/laravel-', 'sharmindar/laravel-', $new_content);

            if ($new_content !== $content) {
                file_put_contents($path, $new_content);
                $files_modified++;
                echo "Updated: $line\n";
            }
        }
    }
}

echo "Total files modified: $files_modified\n";

// Rename the config file
$old_file = __DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'krayin-vite.php';
$new_file = __DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'sharmindar-vite.php';

if (file_exists($old_file)) {
    rename($old_file, $new_file);
    echo "Renamed config/krayin-vite.php to config/sharmindar-vite.php\n";
}
