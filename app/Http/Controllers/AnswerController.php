<?php

namespace App\Http\Controllers;

use App\Models\Answer;

class AnswerController extends Controller
{
    public function show($question)
    {
        $answers = Answer::where('question_id', $question)->get();
        if (!isset($question)) {
            return response()->json(['failed' => ['The answers for given ID was not found'], 404], 404);
        }
        return response()->json(['answers' => [$answers], 200], 200);
    }
    public function create($question)
    {
        request()->validate([
            'description' => 'String | required',
        ]);
        $answer = new Answer();
        $answer->description = request('description');
        $answer->no_thumbs_up = 0;
        $answer->no_thumbs_down = 0;
        $answer->user_id = 1;
        $answer->question_id = $question;
        $answer->save();
        return response()->json(['answer' => [$answer], 200], 200);
    }
    public function update(Answer $answer)
    {
        request()->validate([
            'description' => 'string | required',
            'no_thumbs_up' => 'required | integer',
            'no_thumbs_down' => 'required | integer',
        ]);

        if (isset($answer)) {
            $answer->description = request('description');
            $answer->no_thumbs_up = request('no_thumbs_up');
            $answer->no_thumbs_down = request('no_thumbs_down');
            $answer->save();
            return response()->json(['success' => ["The answer has been updated successfully."], 200], 200);
        }
        return response()->json(['failure' => ["The answer with given ID was not found"], 404], 404);

    }
    public function delete(Answer $answer)
    {
        if (isset($answer)) {
            $answer->delete();
            return response()->json(['success' => ["The answer has been deleted successfully."], 200], 200);
        }
        return response()->json(['failure' => ["The answer with given ID was not found"], 404], 404);

    }
}
