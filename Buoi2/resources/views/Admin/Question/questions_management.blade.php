@extends('Admin.index')

@section('style')

<style>
    /* .table td:nth-child(4),
    .table td:nth-child(5),
    .table td:nth-child(6),
    .table td:nth-child(7),
    .table td:nth-child(8) {
        max-width: 5%;
    } */
</style>

@endsection
@section('content')
<div class="" style="padding:0px 40px; margin-bottom: 20px; display: flex; justify-content: space-between ">
    <button type="button" class="btn-primary" style="padding: 1px 20px"><a class="text-white"
            href="{{ route('question.create') }}">Thêm câu hỏi</a>
    </button>
    <form action="{{route('question.search')}}" id="form_search" method="GET">
        <input type="text" name="search" placeholder="Tim kiem..." id="search">

    </form>
    {{-- <form action="{{ route('question.index') }}" method="GET" class="" style="width: 30%; display: flex">
        <select class="form-control" name="filterTest">
            @foreach ($tests as $item)
                <option value= "{{ $item->id }}" {{ $item->id === 1 ? 'selected' : '' }}>{{ $item->name }}</option>
            @endforeach
        </select>
        <button type="submit">Lọc</button>
    </form> --}}
</div>
<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nội dung câu hỏi</th>
            <th scope="col">A</th>
            <th scope="col">B</th>
            <th scope="col">C</th>
            <th scope="col">D</th>
            <th scope="col">Đáp án chính xác</th>
            <th scope="col">Lựa chọn</th>
        </tr>
    </thead>
    <tbody>
        {{-- {{$questions}} --}}
        @foreach ($questions as $index => $question)
            <tr>
                <td scope="row">{{ $question->id }}</td>
                <td>{{ $question->Content }}</td>
                <td>{{ $question->OptionA }}</td>
                <td>{{ $question->OptionB }}</td>
                <td>{{ $question->OptionC }}</td>
                <td>{{ $question->OptionD }}</td>
                <td>{{ $question->CorrectOption }}</td>

                <td>
                    <a href="{{ route('question.edit', ['id' => $question->id]) }}">Sửa</a>
                    <form action="{{ route('question.delete', ['id' => $question->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button>Xóa</button>
                    </form>
                </td>

            </tr>
        @endforeach
    </tbody>
</table>
<div class="text-center" style=" ">
    <div class="" style="display: flex; justify-content:center; align-items: center">
        {{ $questions->appends(request()->query())->links('pagination::bootstrap-4') }}</div>
</div>

@endsection

@section('import_js')
    <script src="{{asset('JS/question.js') }}"></script>
@endsection
