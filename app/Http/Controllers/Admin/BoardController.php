<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Toastr;
class BoardController extends Controller
{
    public function index()
    {
        $boards = Board::latest()->get();
        return view('admin.pages.board.index',compact('boards'));
    }

    public function store(Request $request)
    {
        //use try catch to handle error
        try {
            $request->validate([
                'board_name' => 'required|max:255',
            ]);
            $board = new Board();
            $board->board_name = $request->board_name;
            $board->save();
            Toastr::success('Board added successfully!', 'Success');
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
                'board_name' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $board = Board::findOrFail($id);
            $board->board_name = $request->input('board_name');
            $board->status = $request->input('status');
            $board->save();
            Toastr::success('Board updated successfully!', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $board = Board::findOrFail($id);
            $board->delete();

            Toastr::error('Board deleted successfully!', 'Error');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->route('admin.board')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

}
