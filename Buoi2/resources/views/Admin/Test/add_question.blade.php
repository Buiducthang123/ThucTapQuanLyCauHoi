@extends('Admin.index')
@section('content')
    <a href="{{ route('test.show', ['id'=>$test_id]) }}">Quay trở lại để xem</a>
    <form action="{{ route('test.handleAdd') }}" method="POST">
        @csrf
        <input type="hidden" name="test_id" value="{{$test_id}}">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Chọn để thêm</th>
                    <th scope="col">Nội dung câu hỏi</th>
                    <th scope="col">A</th>
                    <th scope="col">B</th>
                    <th scope="col">C</th>
                    <th scope="col">D</th>
                    <th scope="col">Đáp án chính xác</th>
                </tr>
            </thead>
            <tbody>
                {{-- {{$questions}} --}}
                @foreach ($questions as $index => $question)
                    <tr>
                        <td><input type="checkbox" name="questions_id[]" id="{{$question->id}}" value = {{$question->id}}></td>
                        <td><label for="{{$question->id}}" style="font-weight: normal">{{ $question->Content }}</label></td>
                        <td>{{ $question->OptionA }}</td>
                        <td>{{ $question->OptionB }}</td>
                        <td>{{ $question->OptionC }}</td>
                        <td>{{ $question->OptionD }}</td>
                        <td>{{ $question->CorrectOption }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-center" style=" ">
            <button type="submit">Thêm</button>
            <div class="" style="display: flex; justify-content:center; align-items: center">
                {{ $questions->appends(request()->query())->links('pagination::bootstrap-4') }}</div>
            </div>

    </form>
@endsection
