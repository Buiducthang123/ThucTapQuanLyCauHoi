@extends('Admin.index')

@section('content')
    <h4 style="margin: 10px 0px; color: rebeccapurple">Chỉnh sửa câu hỏi</h4>
    <form action="{{ route('question.update', $question->id) }}" method="POST" style="margin-top: 20px; text-align: center">
        @csrf
        @method('PUT')
        <label for="Content">Nội dung:</label><br>
        <textarea type="text" style="width: 25%;min-width: 320px; padding: 10px 20px; max-height: 200px; min-height: 70px"
            id="Content" name="Content"></textarea><br>
        @error('Content')
            <span class="text-danger d-block">{{ $message }}</span>
        @enderror

        <label for="OptionA">Đáp án A:</label><br>
        <input type="radio" name="CorrectOption" id="RadioOptionA"
        {{($question->CorrectOption===$question->OptionA )? 'checked':""}}>
        <input type="text" style="width: 25%;min-width: 320px; padding: 10px 20px;" id="OptionA" name="OptionA"
            value="{{ $question->OptionA }}"><br>
        @error('OptionA')
            <span class="text-danger d-block">{{ $message }}</span>
        @enderror

        <label for="OptionB">Đáp án B:</label><br>
        <input type="radio" name="CorrectOption" id="RadioOptionB" {{($question->CorrectOption===$question->OptionB )? 'checked':""}}>
        <input type="text" style="width: 25%;min-width: 320px; padding: 10px 20px;" id="OptionB" name="OptionB"
            value="{{ $question->OptionB }}"><br>
        @error('OptionB')
            <span class="text-danger d-block">{{ $message }}</span>
        @enderror

        <label for="OptionC">Đáp án C:</label><br>
        <input type="radio" name="CorrectOption" id="RadioOptionC"
        {{($question->CorrectOption===$question->OptionC )? 'checked':""}}>
        <input type="text" style="width: 25%;min-width: 320px; padding: 10px 20px;" id="OptionC" name="OptionC"
            value="{{ $question->OptionC }}"><br>
        @error('OptionC')
            <span class="text-danger d-block">{{ $message }}</span>
        @enderror

        <label for="OptionD">Đáp án D:</label><br>
        <input type="radio" name="CorrectOption" id="RadioOptionD   "
        {{($question->CorrectOption===$question->OptionD)? "checked":""}}>
        <input type="text" style="width: 25%;min-width: 320px; padding: 10px 20px;" id="OptionD" name="OptionD"
            value="{{ $question->OptionD }}"><br>
        @error('OptionD')
            <span class="text-danger d-block">{{ $message }}</span>
        @enderror

        @error('CorrectOption')
            <span class="text-danger d-block">{{ $message }}</span>
        @enderror
        <input type="hidden" name="pagination_state" value="{{ URL::previous() }}">
        <button type="submit" onclick="assignValueToRadio()"
            style="background-color: rgb(41, 161, 41); border:none; padding: 5px 20px ; color:#fff">Update</button>
    </form>
@endsection
<script src="{{ asset('JS/question_create.js') }}"></script>
@section('import_js')

    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <script>

        function setTextArea() {
            var text = "{!! addslashes($question->Content) !!}";
            document.getElementById("Content").value = text;
        }
        setTextArea()
    </script>
@endsection
