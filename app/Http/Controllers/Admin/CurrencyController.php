<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Currency;
use App\Models\admin\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Toastr;
class CurrencyController extends Controller
{
    public function index()
    {
        $language = Language::latest()->get();
        $currencys = Currency::with('language')->latest()->get();
        return view('admin.pages.currency.index',compact('currencys','language'));
    }

    public function store(Request $request)
    {

        //use try catch to handle error
        try {
            $request->validate([
                'language_id' => 'required',
                'country_name' => 'required|max:255',
                'currency_name' => 'required|max:255',
            ]);
            $currency = new Currency();
            $currency->language_id = $request->language_id;
            $currency->country_name = $request->country_name;
            $currency->currency_name = $request->currency_name;
            $currency->currency_symbol = $request->currency_symbol;
            $currency->currency_code = $request->currency_code;
            $currency->country_code = $request->country_code;
            $currency->exchange_rate = $request->exchange_rate;
            $currency->save();
            Toastr::success('Currency added successfully!', 'Success');
            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    //update
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'language_id' => 'required',
                'country_name' => 'required|max:255',
                'currency_name' => 'required|max:255',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $currency = Currency::findOrFail($id);
            $currency->language_id = $request->input('language_id');
            $currency->country_name = $request->input('country_name');
            $currency->currency_name = $request->input('currency_name');
            $currency->currency_symbol = $request->input('currency_symbol');
            $currency->currency_code = $request->input('currency_code');
            $currency->country_code = $request->input('country_code');
            $currency->exchange_rate = $request->input('exchange_rate');
            $currency->status = $request->input('status');
            $currency->save();
            Toastr::success('Currency updated successfully!', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $currency = Currency::findOrFail($id);
            $currency->delete();
            Toastr::error('Currency deleted successfully!', 'Error');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->route('admin.currency')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
