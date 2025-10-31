<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\UserAnswer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class QuestionController extends Controller
{
    public function index(): View
    {
        $questions = Question::query()
            ->orderBy('id')
            ->get(['id', 'question_text']);

        return view('questions.index', compact('questions'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'answers' => ['required', 'array', 'min:1'],
            'answers.*' => ['nullable', 'string'],
        ]);

        // Ensure at least one non-empty answer was provided. The earlier
        // validation only guarantees that an array was submitted; inputs
        // can all be empty strings. If none provided, return a validation
        // error so the user sees a helpful message.
        $hasNonEmpty = false;
        foreach ($validated['answers'] as $questionId => $answerText) {
            if ($answerText !== null && trim($answerText) !== '') {
                $hasNonEmpty = true;
                break;
            }
        }

        if (! $hasNonEmpty) {
            return redirect()->back()
                ->withErrors(['answers' => 'Please provide at least one answer before submitting.'])
                ->withInput();
        }

        foreach ($validated['answers'] as $questionId => $answerText) {
            if ($answerText === null || trim($answerText) === '') {
                continue;
            }

            UserAnswer::create([
                'question_id' => (int) $questionId,
                'answer_text' => $answerText,
            ]);
        }

        return redirect()
            ->route('questions.index')
            ->with('status', 'Thank you for answering the questionnaire!');
    }
}



