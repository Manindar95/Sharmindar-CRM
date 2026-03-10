<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$stages = DB::table('lead_pipeline_stages')->orderBy('sort_order')->get();
$content = "";
foreach ($stages as $stage) {
    $content .= "ID: {$stage->id} | Name: {$stage->name} | Code: {$stage->code} | Pipeline: {$stage->lead_pipeline_id} | Order: {$stage->sort_order}\n";
}
file_put_contents(__DIR__ . '/stages_output.txt', $content);
echo "Stages written to stages_output.txt\n";
