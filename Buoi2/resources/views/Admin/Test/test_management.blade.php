@extends('Admin.index')


@section('content')
    {{--    <div style="position: absolute; width: 100%;height: 100vh;" id="form_add_test" hidden>--}}

    {{--        <div--}}
    {{--            style="position: relative; width: 400px; height: 200px; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; background-color: rgba(218, 215, 215, 0.9);top: 30%; left: 50%; transform: translate(-50%, -50%);">--}}
    {{--            <button style="position: absolute;top: 0px;right: 0;" onclick="toggleElementVisibility()">X</button>--}}
    {{--            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">--}}

    {{--                <h6>Thêm mới</h6>--}}
    {{--                <form action="{{ route('test.create') }}" method="POST">--}}
    {{--                    @csrf--}}
    {{--                    <input type="text" name="name">--}}
    {{--                    <button type="submit">Tạo</button>--}}
    {{--                </form>--}}
    {{--            </div>--}}

    {{--        </div>--}}
    {{--    </div>--}}


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Them moi bai kiem tra</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_create_test">
                    @csrf
                    <div class="modal-body">
                        <input type="text" style="width: 100%;padding: 5px 10px" placeholder="Nhap ten bai kiem tra"
                               name="name" autofocus>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="btn">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="text-align-center pb-4">
        <h3>Quản lý bài thi</h3>
    </div>
    <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
        <button type="button" data-toggle="modal" data-target="#exampleModal">Tạo mới bài kiểm tra</button>
        <form action="{{route('test.search')}}" style="margin-right: 100px" method="GET" id="form_search">
            <input type="text" name="search" placeholder="Tìm kiếm..." id="search">
        </form>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Tên</th>
            <th scope="col">Lựa chọn</th>
        </tr>
        </thead>
        <tbody>
        {{-- {{$questions}} --}}
        @foreach ($tests as $index => $test)
            <tr>
                <td scope="row">{{ $test->id }}</td>
                <td>
                    <form action="{{ route('test.update', ['id'=>$test->id]) }}" id="form_edit_text" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="text" name="name" id="{{$test->id}}" value="{{ $test->name }}" disabled
                               style="border: none">
                    </form>
                </td>
                <td style="display: flex ; justify-content: center; gap: 20px">
                    <a href="{{ route('test.show', ['id' => $test->id]) }}">Xem chi tiết</a>
                    <button onclick="editText({{$test->id}})">Sửa tên</button>
                    <form action="{{ route('test.delete', ['id' => $test->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button>Xóa</button>
                    </form>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

@section('import_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/4.0.0-beta/jquery.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#form_create_test').submit(function (event) {
                // Ngăn chặn hành vi mặc định của form (tải lại trang)
                event.preventDefault();

                // Lấy dữ liệu từ form
                var formData = $(this).serialize();

                // Gửi yêu cầu AJAX
                $.ajax({
                    url: '{{route('test.create')}}',
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        console.log(response);
                        $('#form_create_test')[0].reset();
                        return window.location.href =response;
                    },
                    error: function (xhr, status, error) {
                        // Xử lý lỗi (nếu có)
                        console.log(error);
                    }
                });
            });
        });
    </script>
    <script src="{{ asset('JS/tests.js')}}"></script>
@endsection
