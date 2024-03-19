@extends('Admin.index')

@section('content')
    <h4 style="margin: 10px 0px; color: rebeccapurple">Thêm câu hỏii</h4>
    <form action="{{ route('question.store') }}" method="POST" style="margin-top: 20px; text-align: center">
        @csrf
        <label for="Content">Nội dung:</label><br>
        <textarea type="text" style="width: 25%;min-width: 320px; padding: 10px 20px; max-height: 200px; min-height: 70px"
            id="Content" name="Content"></textarea><br>
        @error('Content')
            <span class="text-danger d-block">{{ $message }}</span>
        @enderror

        <label for="OptionA">Đáp án A:</label><br>
        <input type="radio" name="CorrectOption" id="RadioOptionA" onclick="setColorInput()">
        <input type="text" style="width: 25%;min-width: 320px; padding: 10px 20px;" id="OptionA" name="OptionA"><br>
        @error('OptionA')
            <span class="text-danger d-block">{{ $message }}</span>
        @enderror

        <label for="OptionB">Đáp án B:</label><br>
        <input type="radio" name="CorrectOption" id="RadioOptionB">
        <input type="text" style="width: 25%;min-width: 320px; padding: 10px 20px;" id="OptionB" name="OptionB"><br>
        @error('OptionB')
            <span class="text-danger d-block">{{ $message }}</span>
        @enderror

        <label for="OptionC">Đáp án C:</label><br>
        <input type="radio" name="CorrectOption" id="RadioOptionC">
        <input type="text" style="width: 25%;min-width: 320px; padding: 10px 20px;" id="OptionC" name="OptionC"><br>
        @error('OptionC')
            <span class="text-danger d-block">{{ $message }}</span>
        @enderror

        <label for="OptionD">Đáp án D:</label><br>
        <input type="radio" name="CorrectOption" id="RadioOptionD   ">
        <input type="text" style="width: 25%;min-width: 320px; padding: 10px 20px;" id="OptionD" name="OptionD"><br>
        @error('OptionD')
            <span class="text-danger d-block">{{ $message }}</span>
        @enderror

        @error('CorrectOption')
            <span class="text-danger d-block">{{ $message }}</span>
        @enderror
        <button type="submit" onclick="assignValueToRadio()"
            style="background-color: rgb(41, 161, 41); border:none; padding: 5px 20px ; color:#fff; margin-top: 40px;">Tạo</button>
    </form>
@endsection


@section('import_js')
<script src="{{ asset('JS/question_create.js')}}"></script>
@endsection
