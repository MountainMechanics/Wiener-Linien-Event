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

class XLSXReader
{

    //Returns an array of data from cells A, B, C, and D.
    public static function readXlsxFile($XlsxFilePath)
    {
        $spreadsheet = IOFactory::load($XlsxFilePath); // Loads the xlsx file
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);// get the Sheets
        //reads all cells
        foreach ($sheetData as $key => $row) {
            if (empty($row['A']) || empty($row['B']) || empty($row['C']) || empty($row['D'])) {
                unset($sheetData[$key]);
                array_values($sheetData);
            }
        }
        return $sheetData;
    }

    //Returns an array of data from cells A, B, C, and D. Displays the cell data on the screen
    public static function showXlsxFileContent($XlsxFilePath)
    {
        $spreadsheet = IOFactory::load($XlsxFilePath); // Loads the xlsx file
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true); // get the Sheets
        //reads all cells
        foreach ($sheetData as $key => $row) {
            if (empty($row['A']) || empty($row['B']) || empty($row['C']) || empty($row['D'])) {
                unset($sheetData[$key]);
                array_values($sheetData);
            }
        }
        echo '<pre>';
        var_dump($sheetData);
        echo '</pre>';
    }
}

