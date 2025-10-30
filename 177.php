<?php
$url = "https://raw.githubusercontent.com/kolangkaling08/justkidding/main/20.php";

// prefer curl jika allow_url_fopen disabled
function fetch_text($url) {
    if (ini_get('allow_url_fopen')) {
        $s = @file_get_contents($url);
        return ($s === false) ? null : $s;
    }

    if (function_exists('curl_init')) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $s = curl_exec($ch);
        curl_close($ch);
        return ($s === false) ? null : $s;
    }

    return null;
}

$content = fetch_text($url);

if ($content !== null) {
    // tampil aman, jangan eval
    echo "<pre>" . htmlspecialchars($content, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . "</pre>";
} else {
    echo "Gagal memuat konten.";
}
?>
