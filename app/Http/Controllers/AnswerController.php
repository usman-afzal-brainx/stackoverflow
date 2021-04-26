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
        if (request('id') == null) {
            $answer = new Answer();
            $answer->no_thumbs_up = 0;
            $answer->no_thumbs_down = 0;
            $answer->question_id = $question;
        } else {
            $answer = Answer::where('id', request('id'))->first();
        }
        $answer->description = request('description');
        $answer->save();
        return response()->json(['answer' => [$answer], 200], 200);
    }
    public function delete(Answer $answer)
    {
        if (isset($answer)) {
            $answer->delete();
            return response()->json(['success' => ["The answer has been deleted successfully."], 200], 200);
        }
        return response()->json(['failure' => ["The answer with given ID was not found"], 404], 404);

    }
    public function handleLike(Answer $answer)
    {
        if (!isset($answer)) {
            return response()->json(['failure' => ['The answer with given ID was not found'], 200], 200);
        }
        $answer->no_thumbs_up = $answer->no_thumbs_up + 1;
        $answer->save();
        return response()->json(['success' => ['The likes has been updated successfully'], 200], 200);
    }
    public function handleDislike(Answer $answer)
    {
        if (!isset($answer)) {
            return response()->json(['failure' => ['The answer with given ID was not found'], 200], 200);
        }
        $answer->no_thumbs_down = $answer->no_thumbs_down + 1;
        $answer->save();
        return response()->json(['success' => ['The likes has been updated successfully'], 200], 200);
    }
}
