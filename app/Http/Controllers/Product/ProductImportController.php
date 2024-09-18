<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Str;

class ProductImportController extends Controller
{
    public function create()
    {
        return view('products.import');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xls,xlsx',
        ]);

        $the_file = $request->file('file');

        try {
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();
            $row_limit    = $sheet->getHighestDataRow() - 1;
            $row_range    = range(2, $row_limit);
            $startcount = 2;
            $data = array();
            foreach ($row_range as $row) {
                $data[] = [
                    // 'name'          => $sheet->getCell('A' . $row)->getValue(), Replace the function getValue() with getCalculatedValu() as it get only value the first one get the formula if it have any 
                    'name'          => $sheet->getCell('A' . $row)->getCalculatedValue(),
                    'slug'          => $sheet->getCell('B' . $row)->getCalculatedValue(),
                    'category_id'   => $sheet->getCell('C' . $row)->getCalculatedValue(),
                    'unit_id'       => $sheet->getCell('D' . $row)->getCalculatedValue(),
                    'code'          => $sheet->getCell('E' . $row)->getCalculatedValue(),
                    'quantity'      => $sheet->getCell('F' . $row)->getCalculatedValue(),
                    "quantity_alert" => $sheet->getCell('G' . $row)->getCalculatedValue(),
                    'buying_price'  => $sheet->getCell('H' . $row)->getCalculatedValue(),
                    'selling_price' => $sheet->getCell('I' . $row)->getCalculatedValue(),
                    'product_image' => $sheet->getCell('J' . $row)->getCalculatedValue(),
                    'notes' => $sheet->getCell('K' . $row)->getCalculatedValue(),
                    'user_id' => 1 ,
                ];
                // if()
                $startcount++;
            }
            // dd($data);
            foreach ($data as $product) {
            
                if($product['code'] == "" || $product['code'] == null)
                    dd($product);
                Product::firstOrCreate([
                    "slug" => $product["slug"],
                    "code" => $product["code"],
                ], $product);
            }
        } catch (Exception $e) {
            throw $e;
            // $error_code = $e->errorInfo[1];
            return redirect()
                ->route('products.index')
                ->with('error', $e->getMessage());
        }

        return redirect()
            ->route('products.index')
            ->with('success', 'Data product has been imported!');
    }
}
