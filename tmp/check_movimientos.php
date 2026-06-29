<?php
$url = 'http://127.0.0.1:8000/admin/movimientos';
$context = stream_context_create(['http' => ['timeout' => 5]]);
$html = @file_get_contents($url, false, $context);
if ($html === false) {
    echo "ERROR_FETCH\n";
    exit(1);
}
 echo "OK\n";
 echo substr($html, 0, 2000);
