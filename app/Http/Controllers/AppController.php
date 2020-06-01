<?php

namespace App\Http\Controllers;

use App\Models\EIIN;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppController extends Controller
{
    public function add_eiin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'eiin' => 'required',
            'board' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with([
                'error' => false,
                'message' => 'Something went wrong!'
            ]);
        } else {
            $eiin = $request->input('eiin');
            $board = $request->input('board');

            $exist = EIIN::select('*')->where('eiin', $eiin)->get();

            if (count($exist) == 0) {
                $newEiin = new EIIN();
                $newEiin->eiin = $eiin;
                $newEiin->board = $board;
                $newEiin->status = "Unavailable";
                $newEiin->save();

                return redirect('/eiin/list')->with([
                    'error' => false,
                    'message' => 'EIIN added successfully!'
                ]);
            } else {
                return redirect()->back()->with([
                    'error' => true,
                    'message' => 'EIIN already exist!'
                ]);
            }
        }
    }

    public function get_result(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'eiin' => 'required',
            'roll' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with([
                'error' => true,
                'message' => 'Something went wrong!'
            ]);
        } else {
            $eiin = $request->input('eiin');
            $roll = $request->input('roll');

            $result = Result::select('*')
                ->where('eiin', $eiin)
                ->where('roll', $roll)
                ->get();

            if (count($result) == 1) {
                return redirect('/result?roll=' .  $roll . '&eiin=' . $eiin);
            } else {
                return redirect()->back()->with([
                    'error' => true,
                    'message' => 'Result not found!<br>Please check if your institute is available in list'
                ]);
            }
        }
    }

    public function set_result(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'eiin' => 'required',
            'roll' => 'required',
            'gpa' => 'required',
            'institute' => 'required',
            'centre' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => 'Something went wrong!'
            ]);
        } else {
            $eiin = $request->input('eiin');
            $roll = $request->input('roll');
            $gpa = $request->input('gpa');
            $institute = $request->input('institute');
            $centre = $request->input('centre');

            $result = Result::select('*')
                ->where('eiin', $eiin)
                ->where('roll', $roll)
                ->get();

            if (count($result) == 0) {
                $newResult = new Result();
                $newResult->eiin = $eiin;
                $newResult->roll = $roll;
                $newResult->gpa = $gpa;
                $newResult->institute = $institute;
                $newResult->centre = $centre;
                $newResult->save();

                EIIN::where('eiin', $eiin)->update(['status' => 'Available']);

                return response()->json([
                    'error' => false,
                    'message' => 'Result Added!'
                ]);
            } else {
                return response()->json([
                    'error' => true,
                    'message' => 'Something went wrong!'
                ]);
            }
        }
    }
}
