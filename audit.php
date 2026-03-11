<?php

$dir = __DIR__ . '/packages/Sharmindar';
$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
$bladeFiles = new RegexIterator($iterator, '/^.+\.blade\.php$/i', RecursiveRegexIterator::GET_MATCH);

$missingCsrf = [];

foreach ($bladeFiles as $file) {
    if (is_array($file))
        $file = $file[0];
    $content = file_get_contents($file);

    // Check if it has a POST/PUT/PATCH/DELETE form
    if (preg_match('/<form[^>]+method=["\']?(POST|PUT|PATCH|DELETE|post|put|patch|delete)["\']?[^>]*>/i', $content)) {
        // Does it have @csrf or csrf_field()?
        if (!preg_match('/@csrf|csrf_field\(\)/i', $content) && !preg_match('/<input[^>]+name=["\']_token["\']/i', $content)) {
            $missingCsrf[] = $file;
        }
    }
}

echo "Missing CSRF in Forms:\n";
print_r($missingCsrf);

// Audit routes
$routeFiles = new RegexIterator($iterator, '/routes[\\\\\/].+\.php$/i', RecursiveRegexIterator::GET_MATCH);
$unprotectedRoutes = [];

foreach ($routeFiles as $file) {
    if (is_array($file))
        $file = $file[0];
    $content = file_get_contents($file);

    // Just dump routes files to quickly verify their structure
    echo "Route file: $file \n";
    if (stripos($content, 'middleware') === false) {
        $unprotectedRoutes[] = $file;
    }
}

echo "Potentially Unprotected Route Files:\n";
print_r($unprotectedRoutes);
