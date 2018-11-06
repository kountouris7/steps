<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportSubscribersRequest;
use App\Subscriber;
use Carbon\Carbon;
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
        $subscribers = Subscriber::whereRaw("MONTH(subscribers.created_at) =" . date('m'))
                                 ->orWhereRaw("MONTH(subscribers.month) =" . date('m'))
                                 ->get();

        return view('administrator.subscribers', compact('subscribers'));
    }

    public function showAllSubscribers()
    {
        $subscribers = Subscriber::get();

        return view('administrator.subscribers', compact('subscribers'));
    }

    //What is month? A string? A carbon object?
    public function showSubscribersByMonth($month)
    {
        $dates        = [];
        $currentMonth = Carbon::now();


        //

        for ($i = 0; $i < 12; $i++) {

            $clientMonth                    = $currentMonth->copy()->addMonth($i)->format('m');
            $dates[$clientMonth] = $clientMonth;
        }

        ksort($dates);
        $monthToSearch = $dates[$month] ?? null;

        $subscribers = [];

        if ($monthToSearch) {
            $subscribers = Subscriber::whereMonth('month', $month)
                                     ->get()->transform(function ($group) {
                    return collect(array_merge($group->toArray()));
                });;
        }

        return view('administrator.subscribers', compact('subscribers'));
    }

    public function subscriberProfile($id)
    {
        $subscriber = Subscriber::findOrFail($id);

        return view('administrator.subscribersProfile', compact('subscriber'));
    }


}