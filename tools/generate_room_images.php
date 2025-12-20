<?php
// Simple script to generate PNG sample images using GD
$outDir = __DIR__ . '/../public/images/rooms';
if (!is_dir($outDir)) mkdir($outDir, 0755, true);

function makeImage($filename, $title, $subtitle, $w = 1200, $h = 800) {
    $im = imagecreatetruecolor($w, $h);
    // colors
    $bg = imagecolorallocate($im, rand(50,200), rand(100,200), rand(100,200));
    $white = imagecolorallocate($im, 255,255,255);
    $gray = imagecolorallocate($im, 230,230,230);
    imagefilledrectangle($im, 0,0,$w,$h,$bg);
    // draw box
    imagefilledrectangle($im, 100, 140, $w-100, $h-140, $gray);
    // text
    $font = __DIR__ . '/NotoSans-Regular.ttf'; // fallback if not exists
    $use_ttf = file_exists($font);
    if ($use_ttf) {
        imagettftext($im, 48, 0, 140, 260, $white, $font, $title);
        imagettftext($im, 20, 0, 140, 310, $white, $font, $subtitle);
    } else {
        // fallback to built-in font
        imagestring($im, 5, 140, 220, $title, $white);
        imagestring($im, 3, 140, 260, $subtitle, $white);
    }

    imagepng($im, $filename, 6);
    imagedestroy($im);
}

// Create two sample images
makeImage($outDir . '/sample-deluxe.png', 'Deluxe Room', 'Pemandangan laut • Fasilitas lengkap');
makeImage($outDir . '/sample-standard.png', 'Standard Room', 'Nyaman dan terjangkau');
// Also replace placeholder.png
makeImage($outDir . '/placeholder.png', 'No Image', 'Belum ada gambar kamar');

echo "Generated images in: $outDir\n";
