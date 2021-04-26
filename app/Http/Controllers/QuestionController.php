<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::latest()->with('answers')->get();
        if (isset($questions)) {
            return response()->json(['questions' => [$questions], 200], 200);
        }
        return response()->json(['failure' => ['No Questions in the database...'], 404], 404);
    }

    public function show($question)
    {
        $question = Question::where('id', $question)->with('answers')->get();
        if (isset($question)) {
            return response()->json(['question' => [$question], 200], 200);
        }
        return response()->json(['failure' => ['No Questions in the database with the given ID'], 404], 404);
    }

    public function create()
    {
        request()->validate([
            'question' => 'string | required',
            'description' => 'string | required',
            'no_thumbs_up' => 'integer | required',
            'no_thumbs_down' => 'integer | required ',
        ]);
        if (request('id') == null) {
            $question = new Question();
        } else {
            $question = Question::where('id', request('id'))->first();

        }
        $question->no_thumbs_up = request('no_thumbs_up');
        $question->no_thumbs_down = request('no_thumbs_down');
        $question->question = request('question');
        $question->description = request('description');
        $question->save();
        return response()->json(['question' => [$question], 200], 200);
    }

    public function delete(Question $question)
    {
        if (isset($question)) {
            $question->delete();
            return response()->json(['success' => ["Question deleted successfully."], 200], 200);
        }
        return response()->json(['failure' => ["The question with given ID was not found"], 404], 404);
    }

    public function handleLike(Question $question)
    {
        if (!isset($question)) {
            return response()->json(['failure' => ['The question with given ID was not found'], 200], 200);
        }
        $question->no_thumbs_up = $question->no_thumbs_up + 1;
        $question->save();
        return response()->json(['success' => ['The likes has been updated successfully'], 200], 200);
    }
    public function handleDislike(Question $question)
    {
        if (!isset($question)) {
            return response()->json(['failure' => ['The question with given ID was not found'], 200], 200);
        }
        $question->no_thumbs_down = $question->no_thumbs_down + 1;
        $question->save();
        return response()->json(['success' => ['The likes has been updated successfully'], 200], 200);
    }
}
