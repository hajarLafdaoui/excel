<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
class ExcelController extends Controller
{


    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx'
        ]);

        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file->getPathname());
        $sheet = $spreadsheet->getActiveSheet();
        $notes = [];

        foreach ($sheet->getRowIterator() as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);
            $rowData = [];
            foreach ($cellIterator as $cell) {
                $value = $cell->getCalculatedValue();
                
                // Check if the value is numeric and format it to 2 decimal places
                if (is_numeric($value)) {
                    $value = number_format($value, 2, '.', '');
                }
    
                $rowData[] = $value;
            }
            $notes[] = $rowData;
        }

        return response()->json($notes);
    }

}
