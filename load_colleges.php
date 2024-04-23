<?php
$folder = 'clgImage/'; // Path to the image folder
$files = scandir($folder); // Read all files in the folder
$images = array_filter($files, function ($file) use ($folder) {
    return is_file($folder . $file) && in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']);
});

// Determine start and count from GET parameters
$start = isset($_GET['start']) ? intval($_GET['start']) : 0;
$count = isset($_GET['count']) ? intval($_GET['count']) : 3; // Default load 3 cards

$selectedImages = array_slice($images, $start, $count);

header('Content-Type: application/json');
$result = [];
foreach ($selectedImages as $img) {
    $name = pathinfo($img, PATHINFO_FILENAME);
    $collegeName = ucwords(str_replace(['_', '-'], ' ', $name));
    $result[] = [
        'imgSrc' => $folder . $img,
        'name' => $collegeName
    ];
}

echo json_encode($result);
?>
