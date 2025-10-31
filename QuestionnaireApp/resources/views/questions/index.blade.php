<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questionnaire</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif; 
            margin: 0; 
            background: #f8fafc;
        }
        .container { 
            max-width: 800px;
            margin: 40px auto; 
            background: #fff; 
            border-radius: 12px; 
            padding: 50px; 
            box-shadow: 0 4px 18px rgba(0,0,0,0.06); 
        }
        h1 { 
            margin: 0 0 12px; 
            font-size: 28px; 
        }
        .status { 
            background: #ecfdf5; 
            color: #065f46; 
            padding: 12px 14px; 
            border-radius: 10px; 
            margin: 20px 0; 
            border: 1px solid #a7f3d0; 
        }
        .question { 
            padding: 16px 0;
            border-bottom: 1px solid #eef2f7;
         }
        .question:last-child { 
            border-bottom: 0; 
        }
        label { 
            display: block;
            font-weight: 600;
            margin-bottom: 8px; 
            }
        input[type="text"] { 
            width: 100%; 
            padding: 12px 14px; 
            border: 1px solid #cbd5e1;
             border-radius: 10px; 
             font-size: 15px; 
            }
        input[type="text"]:focus { 
            outline: none; 
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99,102,241,0.15); 
            }
        .submit { 
            margin-top: 22px; 
            display: inline-block; 
            background: burlywood; 
            color: #fff; 
            padding: 12px 18px; 
            border-radius: 10px; 
            border: none; 
            font-weight: 700; 
            cursor: pointer;
         }
        .submit:hover { 
            background: #4338ca; 
        }
    </style>
    
 </head>
<body>
    <div class="container">
        <h1>Questionnaire</h1>

        {{-- validation / status area --}}
        @if ($errors->has('answers'))
            <div class="status" style="background:#fee2e2; color:#7f1d1d; border-color:#fecaca;">{{ $errors->first('answers') }}</div>
        @endif

        <form method="POST" action="{{ route('questions.store') }}">
            @csrf

            @foreach ($questions as $question)
                <div class="question">
                    <label for="q_{{ $question->id }}">{{ $question->question_text }}</label>
                    <input type="text" id="q_{{ $question->id }}" name="answers[{{ $question->id }}]" value="{{ old('answers.' . $question->id) }}" placeholder="Type your answer here...">
                    @error('answers.' . $question->id)
                        <div style="color:#b91c1c; margin-top:6px;">{{ $message }}</div>
                    @enderror
                </div>
            @endforeach

            <button type="submit" class="submit">Submit</button>

            @if (session('status'))
                <div class="status">{{ session('status') }}</div>
            @endif
        </form>
    </div>
</body>
</html>



