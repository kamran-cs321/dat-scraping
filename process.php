<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $url = $_POST['url'];

    // Validate the URL
    if (!filter_var($url, FILTER_VALIDATE_URL)) {
        echo 'Invalid URL';
        exit;
    }

    // Fetch content using cURL
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $html = curl_exec($ch);
    curl_close($ch);

    // Check if cURL request was successful
    if ($html === false) {
        echo 'Failed to fetch content';
        exit;
    }

    // Parse HTML using fully qualified name
    require 'vendor/autoload.php'; // Include the Composer autoloader
    $dom = \Sunra\PhpSimple\HtmlDomParser::str_get_html($html);

    // The rest of your code remains unchanged...

    // Release the memory associated with the Simple HTML DOM Parser object
    $dom->clear();
    unset($dom);
} else {
    echo 'Invalid request method';
}
?>
