<?php

use MongoDB\BSON\ObjectID;

// function png_to_jpg($filePath) {
//     $image = imagecreatefrompng($filePath);
//     $bg = imagecreatetruecolor(imagesx($image), imagesy($image));
//     imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
//     imagealphablending($bg, TRUE);
//     imagecopy($bg, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
//     imagedestroy($image);
//     $quality = 100;
//     imagejpeg($bg, $filePath . ".jpg", $quality);
//     imagedestroy($bg);
// }

function create_thumbnail($file_path, $thumb_file, $width, $height, $file_type) {
    $original_info = getimagesize($file_path);
    $original_w = $original_info[0];
    $original_h = $original_info[1];

    if($file_type == "png") {
        $original_img = imagecreatefrompng($file_path);
    }
    else {
        $original_img = imagecreatefromjpeg($file_path);
    }
    $thumb_img = imagecreatetruecolor($width, $height);
    imagecopyresampled($thumb_img, $original_img, 0, 0, 0, 0, $width, $height, $original_w, $original_h);
    
    if($file_type == "png") {
        imagejpeg($thumb_img, $thumb_file);
    }
    else {
        imagepng($thumb_img, $thumb_file);
    }
    imagedestroy($thumb_img);
    imagedestroy($original_img);
}

function create_watermark($original_file, $watermark_file, $watermark_text, $file_type) {
    if($file_type == "png") {
        $image = imagecreatefrompng($original_file);
    }
    else {
        $image = imagecreatefromjpeg($original_file);
    }

    $stamp = imagecreatetruecolor(200, 70);

    imagefilledrectangle($stamp, 0, 0, 199, 169, 0x0000FF);
    imagefilledrectangle($stamp, 9, 9, 190, 60, 0xFFFFFF);
    imagestring($stamp, 5, 20, 20, $watermark_text, 0x0000FF);
    imagestring($stamp, 3, 20, 40, '(c) 2022', 0x0000FF);

    $right = 10;
    $bottom = 10;
    $sx = imagesx($stamp);
    $sy = imagesy($stamp);

    imagecopymerge($image, $stamp, imagesx($image) - $sx - $right, imagesy($image) - $sy - $bottom, 0, 0, imagesx($stamp), imagesy($stamp), 70);

    if($file_type == "png") {
        imagejpeg($image, $watermark_file);
    }
    else {
        imagepng($image, $watermark_file);
    }
    imagedestroy($image);
}

function convert_image($target_file, $image_id, $watermark_text) {
    $original_dir = "images/original/";
    $thumb_dir = "images/min/";
    $watermark_dir = "images/watermark/";

    $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $file_name = $image_id . "." . $image_file_type;

    $original_file = $original_dir . $file_name;
    $thumb_file = $thumb_dir . $file_name;
    $watermark_file = $watermark_dir . $file_name;

    // Move original file
    rename($target_file, $original_file);

    // Create thumbnail
    create_thumbnail($original_file, $thumb_file, 200, 125, $image_file_type);

    // Create watermark
    create_watermark($original_file, $watermark_file, $watermark_text, $image_file_type);
}

function get_db() {
    $mongo = new MongoDB\Client(
        "mongodb://localhost:27017/wai", [
            'username' => 'wai_web',
            'password' => 'w@i_w3b',
        ]
    );
    
    $db = $mongo->wai;

    return $db;
}


/*
function get_products()
{
    $db = get_db();
    return $db->products->find()->toArray();
}

function get_products_by_category($cat)
{
    $db = get_db();
    $products = $db->products->find(['cat' => $cat]);
    return $products;
}

function get_product($id)
{
    $db = get_db();
    return $db->products->findOne(['_id' => new ObjectID($id)]);
}

function save_product($id, $product)
{
    $db = get_db();

    if ($id == null) {
        $db->products->insertOne($product);
    } else {
        $db->products->replaceOne(['_id' => new ObjectID($id)], $product);
    }

    return true;
}

function delete_product($id)
{
    $db = get_db();
    $db->products->deleteOne(['_id' => new ObjectID($id)]);
}
*/
