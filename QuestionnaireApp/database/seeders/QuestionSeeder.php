<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        $questions = [
            [
                'question_text' => 'What is the capital of France?',
                'answers' => [
                    ['answer_text' => 'Paris', 'is_correct' => true],
                    ['answer_text' => 'Lyon'],
                    ['answer_text' => 'Marseille'],
                ],
            ],
            [
                'question_text' => 'Which planet is known as the Red Planet?',
                'answers' => [
                    ['answer_text' => 'Mars', 'is_correct' => true],
                    ['answer_text' => 'Jupiter'],
                    ['answer_text' => 'Venus'],
                ],
            ],
            [
                'question_text' => 'How many continents are there on Earth?',
                'answers' => [
                    ['answer_text' => '7', 'is_correct' => true],
                    ['answer_text' => '5'],
                    ['answer_text' => '6'],
                ],
            ],
        ];

        foreach ($questions as $questionData) {
            $question = Question::create([
                'question_text' => $questionData['question_text'],
            ]);

            foreach ($questionData['answers'] as $answerData) {
                $question->answers()->create($answerData);
            }
        }
    }
}


