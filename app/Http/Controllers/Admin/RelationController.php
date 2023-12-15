<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Relation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Toastr;
class RelationController extends Controller
{
    public function index()
    {
        $relations = Relation::latest()->get();
        return view('admin.pages.relation.index',compact('relations'));
    }

    public function store(Request $request)
    {
        //use try catch to handle error
        try {
            $request->validate([
                'relation_name' => 'required|max:255',
            ]);
            $relation = new Relation();
            $relation->relation_name = $request->relation_name;
            $relation->save();
            Toastr::success('Relation added successfully!', 'Success');
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
                'relation_name' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $relation = Relation::findOrFail($id);
            $relation->relation_name = $request->input('relation_name');
            $relation->status = $request->input('status');
            $relation->save();
            Toastr::success('Relation updated successfully!', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $relation = Relation::findOrFail($id);
            $relation->delete();

            Toastr::error('Relation deleted successfully!', 'Error');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->route('admin.relation')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
