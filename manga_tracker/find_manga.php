<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['description'])) {
    
    $description = $_POST['description'];
} else {
    $description = '';
}
$apiKey = 'AIzaSyD5G7R_LaFj0rzcTP2sHD2Al9REX-jSof8';
$_data = [
    "contents" => [
        ["parts" => [["text" => "Identify the manga based on this description: 
            " .$description]]]
    ]
];
?>