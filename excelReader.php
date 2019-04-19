<?php
/**
 * Created by PhpStorm.
 * User: Rafael
 * Date: 19.04.2019
 * Time: 17:54
 * Libary: PhpSpreadsheet
 * https://phpspreadsheet.readthedocs.io
 * Installation
 * composer require phpoffice/phpspreadsheet
 */

require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

/*
 *array[ROW][Column]
 * $sheetData[1]["Vorname"] enthält den Vornamen der ersten Reihe
*/
function readXlsxFile($XlsxFilePath){
    $spreadsheet = IOFactory::load($XlsxFilePath);
    $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
    var_dump($sheetData);
    return $sheetData;
}


function showXlsxFileContent($XlsxFilePath){
    $spreadsheet = IOFactory::load($XlsxFilePath);
    $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
    var_dump($sheetData);
}
