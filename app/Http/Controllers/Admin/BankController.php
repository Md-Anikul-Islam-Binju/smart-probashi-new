<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Toastr;
class BankController extends Controller
{
    public function index()
    {
        $banks = Bank::latest()->get();
        return view('admin.pages.bank.index',compact('banks'));
    }

    public function store(Request $request)
    {

        //use try catch to handle error
        try {
            $request->validate([
                'name' => 'required',
            ]);
            $bank = new Bank();
            $bank->name = $request->name;
            $bank->branch_code = $request->branch_code;
            $bank->address = $request->address;
            $bank->save();
            Toastr::success('Bank added successfully!', 'Success');
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
                'name' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $bank = Bank::findOrFail($id);
            $bank->name = $request->input('name');
            $bank->branch_code = $request->input('branch_code');
            $bank->address = $request->input('address');
            $bank->status = $request->input('status');
            $bank->save();
            Toastr::success('Bank updated successfully!', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $bank = Bank::findOrFail($id);
            $bank->delete();
            Toastr::error('Bank deleted successfully!', 'Error');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->route('admin.bank')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
