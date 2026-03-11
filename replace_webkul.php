<?php

$file_list = 'webkul_references_utf8.txt';
if (!file_exists($file_list)) {
    die("File list not found.\n");
}

$lines = file($file_list, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$files_modified = 0;
$processed_files = [];

foreach ($lines as $line) {
    if (strpos($line, 'laravel-crm') === 0 || strpos($line, 'laravel-crm/') !== false || strpos($line, 'final_sanitization_check.csv') !== false || strpos($line, 'webkul_matches.csv') !== false || strpos($line, 'webkul_references.txt') !== false || strpos($line, 'webkul_references_utf8.txt') !== false || strpos($line, 'replace_webkul.php') !== false) {
        continue;
    }

    // Extract filename from grep output format: filename:line_content or process directly
    $parts = explode(':', $line, 2);
    $relative_path = $parts[0];

    // Some lines might just be filenames if from a different command
    if (file_exists(__DIR__ . DIRECTORY_SEPARATOR . $relative_path) && !isset($processed_files[$relative_path])) {
        $path = __DIR__ . DIRECTORY_SEPARATOR . $relative_path;
        $processed_files[$relative_path] = true;

        $content = file_get_contents($path);
        if ($content !== false && stripos($content, 'webkul') !== false) {

            // 1. Author config (composer.json)
            $new_content = str_replace('"Jitendra Singh"', '"Sharmindar Team"', $content);
            $new_content = str_replace('"jitendra@webkul.com"', '"admin@sharmindarcrm.com"', $new_content);

            // 2. URLs and domains
            $new_content = str_replace('webkul.com', 'sharmindarcrm.com', $new_content);
            $new_content = preg_replace('/https?:\/\/webkul\.com\/?/', 'https://sharmindarcrm.com', $new_content);

            // 3. Translations & Text
            $new_content = str_replace(', an open-source project by :webkul', '', $new_content);
            $new_content = str_replace(', un proyecto de c?digo abierto de :webkul', '', $new_content);
            $new_content = preg_replace('/,\s*un\s+proyecto\s+de\s+c.*?digo\s+abierto\s+de\s*:webkul/i', '', $new_content);
            $new_content = preg_replace('/,\s*um\s+projeto\s+de\s+c.*?digo\s+aberto\s+da\s*:webkul/i', '', $new_content);
            $new_content = str_replace('Webkul taraf?ndan geli?tirilen', 'Sharmindar taraf?ndan geli?tirilen', $new_content);
            $new_content = preg_replace('/,\s*m.*?t\s+d.*?\s+.*?n\s+m.*?\s+ngu.*?n\s+m.*?\s+.*?\s+ph.*?t\s+tri.*?n\s+b.*?i\s*:webkul/i', '', $new_content);

            // Handle specific fa/vi/ar leftovers by just removing the webkul suffix if possible
            $new_content = preg_replace('/(:webkul)/i', ':sharmindar_team', $new_content);
            $new_content = preg_replace("/'webkul'\s*=>\s*'Webkul'/", "'webkul' => 'Sharmindar Team'", $new_content);
            $new_content = preg_replace("/'webkul'\s*=>\s*'.*?'/", "'webkul' => 'Sharmindar Team'", $new_content);

            // 4. Comments and docs
            $new_content = str_replace('@devansh-webkul', '@sharmindar-team', $new_content);
            $new_content = str_replace('@suraj-webkul', '@sharmindar-team', $new_content);
            $new_content = str_replace('Webkul CRM', 'Sharmindar CRM', $new_content);
            $new_content = str_replace('Webkul login', 'Sharmindar login', $new_content);
            $new_content = preg_replace('/Webkul Core doesn\'t/', 'Sharmindar Core doesn\'t', $new_content);
            $new_content = preg_replace('/Webkul Software/', 'Sharmindar CRM', $new_content);
            $new_content = preg_replace('/by \[Webkul\]\(.*?\)/', 'by the Sharmindar CRM Contributors', $new_content);

            if ($new_content !== $content) {
                file_put_contents($path, $new_content);
                $files_modified++;
                echo "Updated: $relative_path\n";
            }
        }
    }
}

// Cleanup old log files
$files_to_delete = [
    'final_sanitization_check.csv',
    'webkul_matches.csv',
    'webkul_references.txt',
    'webkul_references_utf8.txt'
];

foreach ($files_to_delete as $file) {
    if (file_exists(__DIR__ . DIRECTORY_SEPARATOR . $file)) {
        unlink(__DIR__ . DIRECTORY_SEPARATOR . $file);
        echo "Deleted: $file\n";
    }
}

echo "Total files modified: $files_modified\n";
