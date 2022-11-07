<?php
   
namespace App\Services;

class CsvService
{

    public static function getArrayFromCSV($csv){
        $csvFile = file($csv);
        unset($csvFile[0]);
        sort($csvFile);

        $data = [];
        foreach ($csvFile as $line) {
            $data[] = explode(';', $line);
        }
        return $data;
    }

}