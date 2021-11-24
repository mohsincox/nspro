<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Quiz;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	$quizzes = Quiz::get();
    	return view('quiz.index', compact('quizzes'));
    }

    public function create()
    {
    	return view('quiz.create');
    }

    public function store(Request $request)
    {
    	$input = Input::all();
	    $rules = [
	    	'name' => 'required|unique:quizzes'
	    ];
	    $messages = [
            'name.required' => 'The Quiz Name field is required.',
            'name.unique' => 'The Quiz Name already exist.'
        ];
	    
    	$validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
        	flash()->error('Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $quiz = new Quiz;
        $quiz->name = $request->name;
        $quiz->created_by = Auth::id();
        $quiz->save();
        flash()->success($quiz->name.' Quiz Name created successfully');
    	return redirect('quiz');
    }

    public function edit($id)
    {
    	$quiz = Quiz::find($id);
    	return view('quiz.edit', compact('quiz'));
    }
    
    public function update(Request $request, $id)
    {
    	$quiz = Quiz::find($id);
    	$input = Input::all();
	    $rules = [
	    	'name' => 'required|unique:quizzes,name,'.$quiz->id,
	    	'status' => 'required'
	    ];
	    $messages = [
            'name.required' => 'The Quiz Name field is required.',
            'name.unique' => 'The Quiz Name already exist.'
        ];
	    
    	$validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
        	flash()->error('Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $quiz->name = $request->name;
        $quiz->status = $request->status;
        $quiz->updated_by = Auth::id();
        $quiz->save();
        flash()->success($quiz->name.' Quiz Name updated successfully');
    	return redirect('quiz');
    }
}
