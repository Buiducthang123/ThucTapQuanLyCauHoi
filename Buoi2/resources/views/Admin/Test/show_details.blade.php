@extends('Admin.index')
@section('content')
    <div class="" style="padding:0px 40px; margin-bottom: 20px; display: flex; justify-content: space-between ">

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
            thêm câu hỏi
        </button>
        <!-- Modal -->
        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLongTitle" aria-hidden="true" >
            <div class="modal-dialog" role="document" style="max-width: 1000px; max-height:90vh;overflow-y: scroll; scrollbar-color: #3e3333 #eceae6; scrollbar-width: thin;">

                <div class="modal-content" style="border: none" >
                    <div class="modal-body" >
                        <form action="{{ route('test.handleAdd') }}" method="POST">
{{--                        <form id="form_add_question" method="POST">--}}
                            @csrf
                            <div class="modal-header" style="position: sticky;top: 0; z-index: 1000;background:#ffffff;border: none">
                                <h5 class="modal-title" id="exampleModalLongTitle">Câu hỏi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <div class="text-center" style="">
{{--                                    <button type="submit">Thêm</button>--}}
                                    <button type="submit    " id="btn-add-question">Thêm</button>
                                </div>
                            </div>


                            <input type="hidden" name="test_id" value="{{$test->id}}">
                            <table class="table"  >
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
                                        <td><input type="checkbox" name="questions_id[]" id="{{$question->id}}"
                                                   value= {{$question->id}}></td>
                                        <td><label for="{{$question->id}}"
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
            @method("PUT")
            <button type="submit">Thêm nhanh 40 câu hỏi</button>
        </form>
    </div>
    <div style="text-align: center">
        <h5>Bài kiểm tra: {{$test->name}}</h5>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/4.0.0-beta/jquery.js"></script>

{{--    <script type="text/javascript">--}}
{{--        $(document).ready(function () {--}}
{{--            $('#form_add_question').submit(function (event) {--}}
{{--                // Ngăn chặn hành vi mặc định của form (tải lại trang)--}}
{{--                event.preventDefault();--}}

{{--                // Lấy dữ liệu từ form--}}
{{--                var formData = $(this).serialize();--}}
{{--                let a = $('#exampleModalLong')--}}
{{--                let b = $('.modal-backdrop').eq(0);--}}


{{--                // Gửi yêu cầu AJAX--}}
{{--                $.ajax({--}}
{{--                    url: '{{route('test.handleAdd')}}',--}}
{{--                    type: 'POST',--}}
{{--                    data: formData,--}}
{{--                    success: function (response) {--}}
{{--                        // console.log(response);--}}

{{--                        a.removeClass('show');--}}
{{--                        a.css('display','none');--}}
{{--                        a.attr('aria-hidden', 'true');--}}
{{--                        b.hide();--}}
{{--                        abc();--}}

{{--                        // $('#form_create_test')[0].reset();--}}
{{--                        // return window.location.href =response;--}}
{{--                    },--}}
{{--                    error: function (xhr, status, error) {--}}
{{--                        // Xử lý lỗi (nếu có)--}}
{{--                        console.log(error);--}}
{{--                    }--}}
{{--                });--}}
{{--            });--}}
{{--        });--}}

{{--        function abc(){--}}
{{--            console.log('sbshs')--}}
{{--        }--}}

{{--    </script>--}}

{{--    <script type="text/javascript">--}}
{{--        $(document).ready(function (){--}}
{{--            $.ajax({--}}
{{--                url: '/hihi',--}}
{{--                type: 'GET',--}}
{{--                data: { key: 'value' },--}}
{{--                success: function(data) {--}}
{{--                    // Assuming 'data' is the response received from the server--}}
{{--                    // $('#result').text(data); // Display the received data in the 'result' div--}}
{{--                    console.log(data)--}}
{{--                },--}}
{{--                error: function(xhr, status, error) {--}}
{{--                    // Handle errors if any--}}
{{--                    console.error(xhr.responseText);--}}
{{--                }--}}
{{--            })--}}
{{--        })--}}
{{--    </script>--}}
@endsection
