<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;


class ClientController extends Controller
{
    public function index()
    {
        return view('administrator.clients');
    }

    public function import(Request $request)
    {
        //validate the xls file
        $this->validate($request, [
            'file' => 'required',
        ]);

        if ($request->hasFile('file')) {
            $extension = File::extension($request->file->getClientOriginalName());
            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {

                $path = $request->file->getRealPath();
                $data = Excel::load($path, function ($reader) {
                })->get();
                if ( ! empty($data) && $data->count()) {

                    foreach ($data as $key => $value) {
                        $insert[] = [
                            'name'  => $value->name,
                            'surname' => $value->surname,
                            'package_week' => $value->package_week,
                            'amount' => $value->amount,
                            'discount' => $value->discount,
                            'price' => $value->price
                        ];
                    }

                    if ( ! empty($insert)) {

                        $insertData = DB::table('clients')->insert($insert);
                        if ($insertData) {
                            Session::flash('success', 'Your Data has successfully imported');
                        } else {
                            Session::flash('error', 'Error inserting the data..');

                            return back();
                        }
                    }
                }

                return back();

            } else {
                Session::flash('error', 'File is a ' . $extension . ' file.!! Please upload a valid xls/csv file..!!');

                return back();
            }
        }
    }


}