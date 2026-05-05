<?php
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

$templatePath = 'storage/app/templates/PRA_PK_.xlsx';
$spreadsheet = IOFactory::load($templatePath);
$ws = $spreadsheet->getSheetByName('FORM -01');

for ($i = 1; $i <= 300; $i++) {
    $val = $ws->getCell("B$i")->getValue();
    if (str_contains($val, 'MEMBERIKAN ASUHAN KEPERAWATAN')) {
        echo "FOUND_ROW: " . $i;
        break;
    }
}
