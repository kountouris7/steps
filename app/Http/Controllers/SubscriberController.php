<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportSubscribersRequest;
use App\Subscriber;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;


class SubscriberController extends Controller
{
    public function index()
    {
        return view('administrator.importExcel');
    }

    public function import(ImportSubscribersRequest $request)
    {
        if ($request->hasFile('file')) {
            $extension = File::extension($request->file->getClientOriginalName());
            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {

                $path = $request->file->getRealPath();
                $data = Excel::load($path, function ($reader) {
                })->get();

                if ( ! empty($data) && $data->count()) {
                    foreach ($data as $key => $value) {
                        $insertData = Subscriber::updateOrCreate(
                            [
                                'name'    => $value->name,
                                'surname' => $value->surname,
                                //'email'        => $value->email,
                            ],
                            [
                                'name'         => $value->name,
                                'surname'      => $value->surname,
                                'email'        => $value->email,
                                'package_week' => $value->package_week,
                                'amount'       => $value->amount,
                                'discount'     => $value->discount,
                                'price'        => $value->price,
                                'month'        => $value->month,
                            ]);

//dd($insertData);
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
                Session::flash('error',
                    'File is a ' . $extension . ' file.!! Please upload a valid xls/csv file..!!');
            }
        }

        return back();
    }


    public function showSubscribersCurrentMonth()
    {
        //date('m') = currentMonth//
        $subscribers  = Subscriber::whereRaw("MONTH(subscribers.created_at) =" . date('m'))
                          ->get();

        return view('administrator.subscribers', compact('subscribers'));
    }

    public function subscriberProfile($id)
    {
        $subscriber = Subscriber::findOrFail($id);

        return view('administrator.subscribersProfile', compact('subscriber'));
    }


}