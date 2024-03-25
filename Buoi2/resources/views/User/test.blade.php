@extends('layouts.app')
@section('style')
    <style>
        #content.fullscreen {
            width: 100vw;
            height: 100vh;
        }

        #content_full .hidden {
            display: none;
        }
    </style>
@endsection
@section('content')
    <div id="content_full" class=" " style="background-color: #ffffff">
        <div class="container mt-8">
            <div class="text-center mb-4">
                <h6>{{$test->name}}</h6>
                <span id="countdown"></span>
            </div>

            <div class="row d-flex justify-content-center">
                <div class="col-md-8">
                    <form method="POST" id="form-questions">
                        @csrf
                        @foreach($questions as $index => $question)
                            <div class="mb-4">
                                <p>Câu hỏi {{$index + 1}}: {{$question->Content}}</p>
                                <div class="list-group">
                                    <label class="list-group-item">
                                        <input type="radio" name="question_{{$index + 1}}"
                                               value="{{$question->OptionA}}">
                                        <span class="pl-2">Đáp án A: {{$question->OptionA}}</span>
                                    </label>
                                    <label class="list-group-item">
                                        <input type="radio" name="question_{{$index + 1}}"
                                               value="{{$question->OptionB}}">
                                        <span class="pl-2">Đáp án B: {{$question->OptionB}}</span>
                                    </label>
                                    <label class="list-group-item">
                                        <input type="radio" name="question_{{$index + 1}}"
                                               value="{{$question->OptionC}}">
                                        <span class="pl-2">Đáp án C: {{$question->OptionC}}</span>
                                    </label>
                                    <label class="list-group-item">
                                        <input type="radio" name="question_{{$index + 1}}"
                                               value="{{$question->OptionD}}">
                                        <span class="pl-2">Đáp án D: {{$question->OptionD}}</span>
                                    </label>
                                </div>
                            </div>
                        @endforeach

                        <button type="submit" id="btn-submit" style="background-color: rgba(13,147,51,0.93);"
                                class="btn btn-success">Success
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('import_js')

    <script>
        //đếm ngược
        function countdown(time = '') {
            const targetTime = new Date(time).getTime();
            const spanCountDown = document.getElementById("countdown");
            const countdownInterval = setInterval(() => {
                const currentTime = new Date().getTime();
                const timeRemaining = Math.max(targetTime - currentTime, 0);

                // const hours = Math.floor(timeRemaining / (1000 * 60 * 60));
                const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);
                spanCountDown.innerText = `Còn lại: ${minutes} phút ${seconds} giây`
                if (timeRemaining === 0) {
                    spanCountDown.innerText = "Hết giờ"
                    clearInterval(countdownInterval); // Dừng vòng lặp khi thời gian còn lại bằng 0
                }
            }, 1000); // Cập nhật mỗi giây
        }

        // Sử dụng hàm để đếm ngược từ thời gian cố định
        countdown("{{$result->time_end}}");

    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/4.0.0-beta/jquery.js"></script>

    <script>
        //kiểm tra xem điền hết đáp án chưa
    </script>


    <script>
        //form submit

        $(document).ready(function () {
            $('#form-questions').submit(function (event) {
                // Ngăn chặn hành vi mặc định của form (tải lại trang)
                event.preventDefault();
                $a = confirm('Bạn có chắc muốn nộp bài không?')
                if ($a) {
                    console.log('chdhhd');
                    // Lấy dữ liệu từ form
                    var formData = $(this).serialize();
                    console.log(formData)
                    // Gửi yêu cầu AJAX
                    $.ajax({
                        url: '/result/checkCorrectOption',
                        type: 'POST',
                        data: formData,
                        success: function (response) {
                            console.log(response);
                        },
                        error: function (xhr, status, error) {
                            // Xử lý lỗi (nếu có)
                            console.log(xhr);
                            console.log(error);
                            console.log(status);
                        }
                    });
                }


            })
        });


    </script>
    {{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>--}}
    {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"></script>--}}

@endsection


