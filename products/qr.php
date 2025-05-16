<?php
require '../vendor/autoload.php';

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Label\LabelAlignment;
use Endroid\QrCode\Label\Font\OpenSans;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;

$code = $_GET['code'] ?? '';
if (empty($code)) {
    echo 'No code provided';
    exit;
}

$builder = new Builder(
    writer: new PngWriter(),
    writerOptions: [],
    validateResult: false,
    data: $code,
    encoding: new Encoding('UTF-8'),
    errorCorrectionLevel: ErrorCorrectionLevel::High,
    size: 300,
    margin: 10,
    roundBlockSizeMode: RoundBlockSizeMode::Margin,
    // logoPath: __DIR__.'/assets/bender.png',
    logoResizeToWidth: 50,
    logoPunchoutBackground: true,
    // labelText: 'This is the label',
    labelFont: new OpenSans(20),
    labelAlignment: LabelAlignment::Center
);

$result = $builder->build();

$fileName = $code . '.png';
$path = '../qr/' . $fileName;
echo $result->saveToFile($path);
