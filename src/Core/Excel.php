<?php

namespace Src\Core;

use PhpOffice\PhpSpreadsheet\IOFactory;

class Excel
{
    public static function toArray($file): array
    {
        $spreadsheet = IOFactory::load($file);
        $sheet = $spreadsheet->getActiveSheet();
        $data = [];

        foreach ($sheet->getRowIterator() as $row) {
            $rowData = [];
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);

            foreach ($cellIterator as $cell) {
                $rowData[] = $cell->getValue();
            }
            $data[] = $rowData;
        }

        return $data;
    }
}
