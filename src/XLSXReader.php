<?php
/**
 * Created by PhpStorm.
 * User: Rafael
 * Date: 19.04.2019
 * Time: 17:54
 * Library: PhpSpreadsheet
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

class XLSXReader{
    public static function readXlsxFile($XlsxFilePath){
        $spreadsheet = IOFactory::load($XlsxFilePath);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        foreach ($sheetData as $key => $row){
            if(empty($row['A']) || empty($row['B']) || empty($row['C']) || empty($row['D'])){
                unset($sheetData[$key]);
                array_values($sheetData);
            }
        }
        //var_dump($sheetData);
        return $sheetData;
    }


    public static function showXlsxFileContent($XlsxFilePath){
        $spreadsheet = IOFactory::load($XlsxFilePath);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        foreach ($sheetData as $key => $row){
            if(empty($row['A']) || empty($row['B']) || empty($row['C']) || empty($row['D'])){
                unset($sheetData[$key]);
                array_values($sheetData);
            }
        }
        echo '<pre>';
        var_dump($sheetData);
        echo '</pre>';
    }
}

