<?php

$exclude = ['.git', 'vendor', 'node_modules', 'storage', 'public/build'];

$directory = new RecursiveDirectoryIterator(__DIR__, FilesystemIterator::SKIP_DOTS);
$iterator = new RecursiveIteratorIterator($directory);

$filesWithKrayin = [];

foreach ($iterator as $file) {
    $path = $file->getPathname();

    $skip = false;
    foreach ($exclude as $ex) {
        if (strpos($path, DIRECTORY_SEPARATOR . $ex . DIRECTORY_SEPARATOR) !== false ||
        strpos($path, __DIR__ . DIRECTORY_SEPARATOR . $ex) === 0) {
            $skip = true;
            break;
        }
    }

    if ($skip)
        continue;

    if ($file->isFile() && in_array(strtolower($file->getExtension()), ['php', 'json', 'md', 'js', 'css', 'vue', 'txt', 'csv'])) {
        $content = file_get_contents($path);
        if (stripos($content, 'krayin') !== false) {
            $filesWithKrayin[] = str_replace(__DIR__ . DIRECTORY_SEPARATOR, '', $path);
        }
    }
}

file_put_contents('krayin_files.txt', implode("\n", $filesWithKrayin));
echo count($filesWithKrayin) . " files found.\n";
