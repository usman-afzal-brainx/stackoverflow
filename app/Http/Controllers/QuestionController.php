<?php

namespace App\Http\Controllers;

use App\Models\Question;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::all();
        return response()->json(['questions' => [$questions], 200], 200);
    }

    public function show(Question $question)
    {
        return response()->json(['question' => [$question], 200], 200);
    }

    public function create()
    {
        $validatedAttributes = request()->validate([
            'question' => 'required',
            'description' => 'required | exists:descriptions,id',
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
        $question->delete();
        return response()->json(['success' => ["Question deleted successfully."], 200], 200);
    }
}
