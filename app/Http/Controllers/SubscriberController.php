<?php

namespace App\Http\Controllers;

use App\Month;
use App\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;


class SubscriberController extends Controller
{
    public function index()
    {
        $months = Month::get();

        return view('administrator.importExcel', compact('months'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import(Request $request)
    {
        //validate the xls file
        $this->validate($request, [
            'file' => 'required',
        ]);


        if ($request->hasFile('file')) {
            $extension = File::extension($request->file->getClientOriginalName());
            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {

                $subscribers = Subscriber::all();

                $path = $request->file->getRealPath();
                $data = Excel::load($path, function ($reader) {
                })->get();

                if ( ! empty($data) && $data->count()) {

                    foreach ($data as $key => $value) {

                        $insertData = Subscriber::create(
                            [
                                'name'         => $value->name,
                                'surname'      => $value->surname,
                                'package_week' => $value->package_week,
                                'amount'       => $value->amount,
                                'discount'     => $value->discount,
                                'price'        => $value->price,
                                'month_id'     => request('month_id'),
                            ]);

                        if ($insertData) {
                            Session::flash('success', 'Your Data has successfully imported');
                        } else {
                            Session::flash('error', 'Error inserting the data..');

                            return back();
                        }
                    }

                }

                return back();

            }


        } else {
            Session::flash('error',
                'File is a ' . $extension . ' file.!! Please upload a valid xls/csv file..!!');

            return back();
        }
    }


    public function showSubscribers()
    {
        $subscribers = Subscriber::with(['month'])->latest()->get();

        return view('administrator.subscribers', compact('subscribers'));
    }


}