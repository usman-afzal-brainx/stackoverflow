<?php

namespace App\Http\Controllers;

use App\Models\Question;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::all();
        if (isset($questions)) {
            return response()->json(['questions' => [$questions], 200], 200);
        }
        return response()->json(['failure' => ['No Questions in the database...'], 404], 404);
    }

    public function show($question)
    {
        $question = Question::find($question)->with('answers')->get();
        if (isset($question)) {
            return response()->json(['question' => [$question], 200], 200);
        }
        return response()->json(['failure' => ['No Questions in the database with the given ID'], 404], 404);
    }

    public function create()
    {
        $validatedAttributes = request()->validate([
            'question' => 'string | required',
            'description' => 'string |required',
            'no_thumbs_up' => 'required | integer',
            'no_thumbs_down' => 'required | integer',
        ]);

        Question::create($validatedAttributes);
        return response()->json(['success' => ['Question has been created successfully'], 200], 200);
    }

    public function update(Question $question)
    {
        $question->question = request('question');
        $question->description = request('description');
        $question->no_thumbs_up = request('no_thumbs_up');
        $question->no_thumbs_down = request('no_thumbs_down');
        $question->save();
        return response()->json(['question' => [$question], 200], 200);
    }
    public function delete(Question $question)
    {
        if (isset($quesion)) {
            $question->delete();
            return response()->json(['success' => ["Question deleted successfully."], 200], 200);
        }
        return response()->json(['failure' => ["The question with given ID was not found"], 404], 404);
    }
}
