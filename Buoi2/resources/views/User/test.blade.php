@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p>Câu hỏi 1:</p>
                <ul class="list-group">
                    <li class="list-group-item">
                        <input type="radio" id="1" name="question_1">
                        <label for="1">Đáp án A</label>
                    </li>
                    <li class="list-group-item">
                        <input type="radio" id="2" name="question_1">
                        <label for="2">Đáp án B</label>
                    </li>
                    <li class="list-group-item">
                        <input type="radio" id="3" name="question_1">
                        <label for="3">Đáp án C</label>
                    </li>

                    <li class="list-group-item">
                        <input type="radio" id="4" name="question_1">
                        <label for="4" class=" ">Đáp án D</label>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
