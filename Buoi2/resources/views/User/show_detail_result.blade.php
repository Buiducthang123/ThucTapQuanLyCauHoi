@extends('Layouts.app')
@section('content')
    <div id="content_full" class=" " style="background-color: #ffffff">
        <div class="container mt-8">
            <div class="text-center mb-4">
                <span id="countdown"></span>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-8" style="padding: 40px 0px;">
                    <div >
                        <h6 style="font-size: 20px;text-align: center">{{$test->name}}</h6>
                        <div style= "height: 70px;text-align: end; display: flex; justify-content: space-between;align-items: center;" >
                            <span>Đáp án: </span>
                            <span>Điểm số: {{$test->pivot->score}}</span>

                        </div>
                    </div>

                    @foreach($questions as $index => $question)
                        <div class="mb-4">
                            <p>Câu hỏi {{$index + 1}}: {{$question->Content}}</p>
                            <div class="list-group">
                                <label class="list-group-item"
                                       @if($question->OptionA == $question->CorrectOption || $question->OptionA==$user_answers["$question->id"])
                                           style="background-color:#15de0e;"
                                    @endif

                                    @if($question->OptionA != $question->CorrectOption && $question->OptionA==$user_answers["$question->id"])
                                        style="background-color:#C10F0FFF;"
                                    @endif>

                                    <span class="pl-2">Đáp án A: {{$question->OptionA}}</span>
                                </label>

                                <label class="list-group-item"
                                       @if($question->OptionB == $question->CorrectOption)
                                           style="background-color:#62da4d;"
                                    @endif
                                       @if($question->OptionB != $question->CorrectOption && $question->OptionB==$user_answers["$question->id"])
                                           style="background-color:#C10F0FFF;"
                                    @endif
                                >
                                    <span class="pl-2">Đáp án B: {{$question->OptionB}}</span>
                                </label>
                                <label class="list-group-item"
                                       @if($question->OptionC == $question->CorrectOption)
                                           style="background-color:#62da4d;"
                                    @endif

                                       @if($question->OptionC != $question->CorrectOption && $question->OptionC==$user_answers["$question->id"])
                                           style="background-color:#C10F0FFF;"

                                    @endif

                                >
                                    <span class="pl-2">Đáp án C: {{$question->OptionC}}</span>
                                </label>
                                <label class="list-group-item"
                                       @if($question->OptionD == $question->CorrectOption)
                                           style="background-color:#62da4d;"
                                    @endif
                                       @if($question->OptionD != $question->CorrectOption && $question->OptionD==$user_answers["$question->id"])
                                           style="background-color:#C10F0FFF;"
                                    @endif
                                >
                                    <span class="pl-2">Đáp án D: {{$question->OptionD}}</span>
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div
@endsection
