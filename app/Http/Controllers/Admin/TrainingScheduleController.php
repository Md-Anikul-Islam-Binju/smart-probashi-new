<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\admin\TrainingCenterInfo;
use App\Models\admin\TrainingSchedule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Toastr;

class TrainingScheduleController extends Controller
{
    public function index()
    {
        $ttcSchedules = TrainingSchedule::with('trainingCenter.trainingCenterByUser')->latest()->get();
        $ttc = TrainingCenterInfo::with('trainingCenterByUser')->get();
        return view('admin.pages.ttc_schedule.index', compact('ttcSchedules', 'ttc'));
    }

    // Create Training Schedule
    public function storeSchedule(Request $request)
    {
        //dd($request->all());

        //use try catch to handle error
        try {
            // Validation Training Schedule
            $validatedData = $request->validate([
                'training_id' => 'required',
                'training_start_date' => 'required|date',
                'training_end_date' => 'required|date',
                'training_start_time' => 'required|date_format:H:i',
                'training_end_time' => 'required|date_format:H:i',
                'pdo_type' => 'required',
                'number_of_seats' => 'required|numeric|min:1',
                'training_fees' => 'required|numeric',
                'room_no' => 'required',
            ]);



            // Get the last generated batch number from the database
            $lastBatchNumber = TrainingSchedule::max('batch_no');
            if ($lastBatchNumber !== null) {
                // Extract the numeric part of the last batch number
                $lastNumericPart = (int)Str::after($lastBatchNumber, 'pdo');
                // Generate the next batch number
                $nextNumericPart = $lastNumericPart + 1;
            } else {
                // If there's no existing batch number, start from a specific number
                $nextNumericPart = 1; // Or any other starting number you prefer
            }
            // Generate the next batch number
            $nextBatchNumber = 'pdo' . str_pad($nextNumericPart, 6, '0', STR_PAD_LEFT);
            //dd($request->all());

            $trainingSchedule = new TrainingSchedule();
            $trainingSchedule->training_id = $validatedData['training_id'];
            $trainingSchedule->batch_no = $nextBatchNumber;
            $trainingSchedule->training_start_date = $validatedData['training_start_date'];
            $trainingSchedule->training_end_date = $validatedData['training_end_date'];
            $trainingSchedule->training_start_time = $validatedData['training_start_time'];
            $trainingSchedule->training_end_time = $validatedData['training_end_time'];
            $trainingSchedule->pdo_type = $validatedData['pdo_type'];
            $trainingSchedule->number_of_seats = $validatedData['number_of_seats'];
            $trainingSchedule->available_sit = $validatedData['number_of_seats'];
            $trainingSchedule->training_fees = $validatedData['training_fees'];
            $trainingSchedule->room_no = $validatedData['room_no'];
            $trainingSchedule->save();
            return redirect()->back()->with('success', 'Training schedule added successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    // Update Training Schedule
    public function updateSchedule(Request $request, $id)
    {

        try {
            $validator = Validator::make($request->all(), [
                'training_id' => 'required',
                'training_start_date' => 'required|date',
                'training_end_date' => 'required|date',
                'training_start_time' => 'required|date_format:H:i',
                'training_end_time' => 'required|date_format:H:i',
                'pdo_type' => 'required',
                'number_of_seats' => 'required|numeric|min:1',
                'training_fees' => 'required|numeric',
                'room_no' => 'required',
            ]);

          /* if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }*/

            $trainingSchedule = TrainingSchedule::findOrFail($id);
            $trainingSchedule->training_id = $request->input('training_id');
            $trainingSchedule->training_start_date = $request->input('training_start_date');
            $trainingSchedule->training_end_date = $request->input('training_end_date');
            $trainingSchedule->training_start_time = $request->input('training_start_time');
            $trainingSchedule->training_end_time = $request->input('training_end_time');
            $trainingSchedule->pdo_type = $request->input('pdo_type');
            $trainingSchedule->number_of_seats = $request->input('number_of_seats');
            $trainingSchedule->training_fees = $request->input('training_fees');
            $trainingSchedule->room_no = $request->input('room_no');
            $trainingSchedule->status = $request->input('status');
            $trainingSchedule->save();
            return redirect()->back()->with('success', 'Training schedule update successfully!');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
