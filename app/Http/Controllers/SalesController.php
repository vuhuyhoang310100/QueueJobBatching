<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    //
    public function index(){
        return view('upload-file');
    }
    public function upload(Request $request){
        if($request->has('mycsv')){
            $data=file(request()->mycsv);
            // $header = $data[0];

            // $header = array_map(function ($column) {
            //     return str_replace(' ', '_', strtolower($column)); // Chuyển đổi " " thành "_" và về chữ thường
            // }, $header);
            $chunks = array_chunk($data,1000);
            $path = resource_path('temp');

            if (!is_dir($path)) {
                mkdir($path, 0755, true); // Tạo thư mục nếu chưa tồn tại
            }
            foreach ($chunks as $key => $chunk) {
                $name = "/tmp{$key}.csv"; 
                file_put_contents($path . $name, $chunk); 
            }

            return 'Done';

        }
        return 'please upload file';
    }
    public function store()
    {
        $path = resource_path('temp');
        $files = glob("$path/*.csv");
        $header = [];
        foreach ($files as $key=> $file) {
            $data = array_map('str_getcsv',file($file));
            if($key ===0){
                $header = $data[0];
                $header = array_map(function ($column) {
                    return str_replace(' ', '_', strtolower($column)); // Chuyển đổi khoảng trắng thành "_" và chữ thường
                }, $header);
                unset($data[0]);
            }
            foreach($data as $sale){
                $saleData = array_combine($header,$sale);
                Sales::create($saleData);
            }
            
        }
        return $files;
    }
}
