@extends('Admin.index')
@section('style')
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
        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
            aria-hidden="true">
            <div class="modal-dialog" role="document"
                style="max-width: 1000px; max-height:90vh;overflow-y: scroll; scrollbar-color: #3e3333 #eceae6; scrollbar-width: thin;">

                <div class="modal-content" style="border: none">
                    <div class="modal-body">
                        <form action="{{ route('test.handleAdd') }}" method="POST">
                            {{--                        <form id="form_add_question" method="POST"> --}}
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/4.0.0-beta/jquery.js"></script>
    <script>
        $(function() {
            var arrStart;
            $("#sortable tbody").sortable({
                start: function(event, ui) {
                    arrStart = $(this).sortable("toArray");
                    arrStart = $.makeArray(arrStart)
                    console.log("Các mục ban đầu: ", arrStart);

                },
                update: function(event, ui) {
                    // Lấy thông tin về các mục vừa thay đổi
                    var sortedItems = $(this).sortable("toArray");
                    console.log("Các mục đã được sắp xếp lại:", sortedItems);
                    let mang_ban_dau = convert(arrStart)
                    let mang_sau_khi_sx = convert(sortedItems)
                    let phantukhongthaydoi = [];
                    for (let i = 0; i < mang_ban_dau.length; i++) {
                        if (mang_ban_dau[i] === mang_sau_khi_sx[i]) {
                            phantukhongthaydoi.push(mang_ban_dau[i]);
                        }
                    }
                    console.log(phantukhongthaydoi)
                    let phantuthaydoi = mang_sau_khi_sx.filter(x => !phantukhongthaydoi.includes(x));
                    var result = [];
                    phantuthaydoi.forEach(element => {
                        let index = mang_sau_khi_sx.indexOf(element);
                        console.log(element+'vi tri:'+index);
                        if (index !== -1) {
                            result.push({
                                'index':index,
                                'question_id':element
                            });
                        } else {
                            console.log("Phần tử không tồn tại trong mảng a");
                        }
                    });

                    console.log(result);
                    console.log('id question bi thay doi' + phantuthaydoi)
                    request(result, {{ $test->id }})


                }
            });
        });

        function convert(arr) {
            var numbersArray = $.map(arr, function(str) {
                return parseInt(str, 10); // Use parseInt to convert string to integer
            });
            return numbersArray
        }


        function request(arr = [], test_id) {
            // console.log(JSON.stringify(arr));
            // console.log(test_id);
            var data = {
                'data': JSON.stringify(arr),
                'test_id': test_id
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
                success: function(data) {
                    console.log('ok')
                    console.log(data)
                },
                error: function(xhr, status, error) {
                    console.log("XHR Status: " + xhr.status);
                    console.log("Status: " + status);
                    console.log("Error: " + error);
                }
            });
        }
    </script>
    {{--        <script type="text/javascript"> --}}
    {{--            $(document).ready(function () { --}}
    {{--                $('#form_add_question').submit(function (event) { --}}
    {{--                    // Ngăn chặn hành vi mặc định của form (tải lại trang) --}}
    {{--                    event.preventDefault(); --}}

    {{--                    // Lấy dữ liệu từ form --}}
    {{--                    var formData = $(this).serialize(); --}}
    {{--                    let a = $('#exampleModalLong') --}}
    {{--                    let b = $('.modal-backdrop').eq(0); --}}


    {{--                    // Gửi yêu cầu AJAX --}}
    {{--                    $.ajax({ --}}
    {{--                        url: '{{route('test.handleAdd')}}', --}}
    {{--                        type: 'POST', --}}
    {{--                        data: formData, --}}
    {{--                        success: function (response) { --}}
    {{--                            // console.log(response); --}}

    {{--                            a.removeClass('show'); --}}
    {{--                            a.css('display','none'); --}}
    {{--                            a.attr('aria-hidden', 'true'); --}}
    {{--                            b.hide(); --}}
    {{--                        }, --}}
    {{--                        error: function (xhr, status, error) { --}}
    {{--                            // Xử lý lỗi (nếu có) --}}
    {{--                            console.log(error); --}}
    {{--                        } --}}
    {{--                    }); --}}
    {{--                }); --}}
    {{--            }); --}}

    {{--        </script> --}}
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
@endsection
