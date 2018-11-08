<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportSubscribersRequest;
use App\Subscriber;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
                                'email' => $value->email,

                            ],
                            [
                                'name'         => $value->name,
                                'surname'      => $value->surname,
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

    public function addNewSubscriberView()
    {
        return view('administrator.addSubscriber');
    }

    public function addNewSubscriber()
    {
        Subscriber::create([
            'name'         => request('name'),
            'surname'      => request('surname'),
            'email'        => request('email'),
            'package_week' => request('package_week'),
            'amount'       => request('amount'),
            'discount'     => request('discount'),
            'price'        => request('price'),
        ]);

        return redirect(route('showAllSubscribers'))->with('flash', 'Client added successfully');
    }


    public function showSubscribersCurrentMonth()
    {
        $currentMonth = today();
        $startOfMonth = Carbon::parse($currentMonth)->startOfMonth()->toDateTimeString();
        $endOfMonth   = Carbon::parse($currentMonth)->endOfMonth()->toDateTimeString();
        $subscribers  = Subscriber::whereBetween('month', [$startOfMonth, $endOfMonth])->get();

        return view('administrator.subscribers', compact('subscribers'));
    }

    public function showAllSubscribers()
    {
        $subscribers = Subscriber::latest()->get();

        return view('administrator.subscribers', compact('subscribers'));
    }

    public function showSubscribersByMonth($month)
    {
        $monthRequestedByAdmin = Carbon::now()->month($month)->toDateTimeString();
        $startOfMonth          = Carbon::parse($monthRequestedByAdmin)->startOfMonth()->toDateTimeString();
        $endOfMonth            = Carbon::parse($monthRequestedByAdmin)->endOfMonth()->toDateTimeString();
        $subscribers           = Subscriber::whereBetween('month', [$startOfMonth, $endOfMonth])
                                           ->get();

        return view('administrator.subscribers', compact('subscribers'));
    }

    public function subscriberProfile($id)
    {
        $subscriber = Subscriber::findOrFail($id);

        return view('administrator.subscribersProfile', compact('subscriber'));
    }


}