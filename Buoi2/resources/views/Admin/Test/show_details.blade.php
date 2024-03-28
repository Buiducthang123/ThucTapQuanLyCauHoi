@extends('Admin.index')
@section('style')
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        #sortable {
            margin: 0;
            padding: 0;
            width: 100%;
        }
        #sortable td {
            margin: 0 3px 3px 3px;
            padding: 0.4em;
            font-size: 1.4em;
            height: 18px;
            cursor: move;
        }
        #sortable td span {
            position: absolute;
            margin-left: -1.3em;
        }
    </style>
@endsection
@section('content')

    <div class="" style="padding:0px 40px; margin-bottom: 20px; display: flex; justify-content: space-between ">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
            thêm câu hỏi
        </button>
        <!-- Modal -->
        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLongTitle"
             aria-hidden="true">
            <div class="modal-dialog" role="document"
                 style="max-width: 1000px; max-height:90vh;overflow-y: scroll; scrollbar-color: #3e3333 #eceae6; scrollbar-width: thin;">
                <div class="modal-content" style="border: none">
                    <div class="modal-body">
                        <form action="{{ route('test.handleAdd') }}" method="POST">
                            @csrf
                            <div class="modal-header"
                                 style="position: sticky;top: 0; z-index: 1000;background:#ffffff;border: none">
                                <h5 class="modal-title" id="exampleModalLongTitle">Câu hỏi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <div class="text-center" style="">
                                    {{--                                    <button type="submit">Thêm</button> --}}
                                    <button type="submit    " id="btn-add-question">Thêm</button>
                                </div>
                            </div>
                            <input type="hidden" name="test_id" value="{{ $test->id }}">
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
                                @foreach ($questionsAll as $index => $question)
                                    <tr>
                                        <td><input type="checkbox" name="questions_id[]" id="{{ $question->id }}"
                                                   value={{ $question->id }}></td>
                                        <td><label for="{{ $question->id }}"
                                                   style="font-weight: normal">{{ $question->Content }}</label></td>
                                        <td>{{ $question->OptionA }}</td>
                                        <td>{{ $question->OptionB }}</td>
                                        <td>{{ $question->OptionC }}</td>
                                        <td>{{ $question->OptionD }}</td>
                                        <td>{{ $question->CorrectOption }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ route('test.index') }}">Quay lại</a>
        <form action="{{ route('test.quickAdd', ['id' => $test->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <button type="submit">Thêm nhanh 40 câu hỏi</button>
        </form>
    </div>
    <div style="text-align: center">
        <h5>Bài kiểm tra: {{ $test->name }}</h5>
    </div>
    <table class="table" id="sortable">
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
        @foreach ($questions as $index => $question)
            <tr id="{{ $question->id }}">
                <td scope="row"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>{{ $question->id }}</td>
                <td>{{ $question->Content }}</td>
                <td>{{ $question->OptionA }}</td>
                <td>{{ $question->OptionB }}</td>
                <td>{{ $question->OptionC }}</td>
                <td>{{ $question->OptionD }}</td>
                <td>{{ $question->CorrectOption }}</td>
                <td class="ui-state-default">
                    {{-- <a href="{{ route('question.edit', ['id' => $question->id]) }}">Sửa</a> --}}
                    <form action="{{ route('test.deleteQuestion', ['id' => $question->id]) }}" method="POST">
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
    </div>
@endsection
@section('import_js')
    <script>
        $(function () {
            var indexStart;
            $("#sortable tbody").sortable({
                start: function (event, ui) {
                    indexStart = ui.item.index();
                },
                update: function (event, ui) {
                    console.log("Vị trí của phần tử trước khi kéo: " + indexStart);
                    var index_end = ui.item.index();
                    console.log("Vị trí của phần tử sau khi kéo: " + index_end);
                    var question_id = ui.item.attr('id');
                    console.log(question_id)
                    request(question_id,indexStart,index_end, {{ $test->id }})
                }
            });
        });
        function request(question_id,indexStart,index_end,testId) {
            const data = {
                'data': JSON.stringify({
                    'question_id':question_id,
                    'indexStart':indexStart,
                    'index_end':index_end,
                    'test_id': testId
                }),
            };

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: '{{ route('test.custom_sort') }}',
                data: data,
                success: function (data) {
                    console.log('Yêu cầu gửi thành công');
                    console.log(data);
                },
                error: function (xhr, status, error) {
                    console.error("XHR Status: " + xhr.status);
                    console.error("Status: " + status);
                    console.error("Error: " + error);
                }
            });
        }
    </script>
@endsection
