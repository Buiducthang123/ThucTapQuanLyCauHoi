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
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-4" id="staticBackdropLabel">
                        <span class="text-success " style="font-weight: bold">Nộp bài thành công: </span>
                        <span>{{$test->name}}</span>
                    </h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"
                     style="text-align: center;background-color: #f27171;color: #e5e7eb; min-height: 145px">
                    <div class="spinner-border text-primary" role="status" id="loading">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <span style="display: block;font-size: 32px; font-weight: bold;margin-bottom: 5px;" id="score">

                    </span>
                    <span style="display: block;margin-bottom: 5px;font-size: 20px" id="correct_question">

                    </span>
                    <span style="display: block;margin-bottom: 5px;font-size: 20px" id="number_question">

                    </span>

                </div>
                <div class="modal-footer">
                    {{--                    <button type="button" class="btn btn-secondary" style="background-color:#5C636A;" data-bs-dismiss="modal">Closee</button>--}}
                    <button type="button" class="btn btn-primary" onclick="redirectToHomePage()"
                            style="background-color:#0d6efd;">Quay trở lại trang chủ
                    </button>
                </div>
            </div>
        </div>
    </div>

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
                                    <input type="radio" name="{{$question->id}}"
                                           value="" checked hidden="true">
                                    <label class="list-group-item">
                                        <input type="radio" name="{{$question->id}}"
                                               value="{{$question->OptionA}}">
                                        <span class="pl-2">Đáp án A: {{$question->OptionA}}</span>
                                    </label>
                                    <label class="list-group-item">
                                        <input type="radio" name="{{$question->id}}"
                                               value="{{$question->OptionB}}">
                                        <span class="pl-2">Đáp án B: {{$question->OptionB}}</span>
                                    </label>
                                    <label class="list-group-item">
                                        <input type="radio" name="{{$question->id}}"
                                               value="{{$question->OptionC}}">
                                        <span class="pl-2">Đáp án C: {{$question->OptionC}}</span>
                                    </label>
                                    <label class="list-group-item">
                                        <input type="radio" name="{{$question->id}}"
                                               value="{{$question->OptionD}}">
                                        <span class="pl-2">Đáp án D: {{$question->OptionD}}</span>
                                    </label>
                                    <input name="test_id" type="hidden" value="{{$test->id}}">
                                    <input name="result_id" type="hidden" value="{{$result->id}}">
                                </div>
                            </div>
                        @endforeach
                        <button type="submit" id="btn-submit" style="background-color: rgba(13,147,51,0.93);"
                                class="btn btn-success"
                        >
                            Nộp bài
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('import_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/4.0.0-beta/jquery.js"></script>
    <script>
        var auto;
        $(document).ready(function () {
            function countdown(time = '') {
                const targetTime = new Date(time).getTime();
                const spanCountDown = $("#countdown");
                const countdownInterval = setInterval(() => {
                    const currentTime = new Date().getTime();
                    const timeRemaining = Math.max(targetTime - currentTime, 0);
                    const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);
                    spanCountDown.text(`Còn lại: ${minutes} phút ${seconds} giây`);

                    if (timeRemaining === 0) {
                        spanCountDown.text("Hết giờ");
                        auto = true;
                        $("#btn-submit").click();
                        clearInterval(countdownInterval);
                    }
                }, 1000);
            }

            countdown("{{$result->time_end}}");
        });
    </script>

    <script>
        $(document).ready(function () {
            if ({{$result->status}} == 1) {
                $('input[type="radio"]').prop('disabled', true).css('cursor', 'not-allowed');
            }
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#form-questions').submit(function (event) {
                // Ngăn chặn hành vi mặc định của form (tải lại trang)
                event.preventDefault();
                var formData = $(this).serialize();
                var formDataArray = formData.split('&').map(function (item) {
                    var pair = item.split('=');
                    return {
                        name: decodeURIComponent(pair[0]),
                        value: decodeURIComponent(pair[1] || '')
                    };
                });
                if (!auto) {
                    $a = confirm('Bạn có chắc muốn nộp bài không?')
                    if ($a) {
                        event.preventDefault();
                        var submit = true
                        $.each(formDataArray, function (index, field) {
                            if (!field.value) {
                                submit = false
                                return 0
                            }
                        });
                        if (submit==false) {
                            $b = confirm("Chua dien het dap an" +
                                "Ban co muon nop bai k")
                            if ($b) {
                                submit =true
                            }
                        }
                        if(submit==true) {
                            $('#staticBackdrop').modal('show');
                            $.ajax({
                                url: '/result/count_score',
                                type: 'POST',
                                async: true,
                                data: formData,
                                success: function (response) {
                                    console.log(response);
                                    $('#btn-submit').prop('disabled', true);
                                    $('#score').text(response.score + "/10");
                                    $('#number_question').text("Tổng số câu hỏi: " + response.questions);
                                    $('#correct_question').text("Số câu trả lời đúng: " + response.correct_question);
                                    $('#loading').css('display', 'none');
                                },
                                error: function (xhr, status, error) {
                                    // Xử lý lỗi (nếu có)
                                    console.log(xhr);
                                    console.log(error);
                                    console.log(status);
                                }
                            });
                        }
                    }
                } else {

                    $('#staticBackdrop').modal('show');
                    console.log(formData)
                    // Gửi yêu cầu AJAX
                    $.ajax({
                        url: '/result/count_score',
                        type: 'POST',
                        async: true,
                        data: formData,
                        success: function (response) {
                            $('#btn-submit').prop('disabled', true);
                            $('#score').text(response.score + "/10");
                            $('#number_question').text("Tổng số câu hỏi: " + response.questions);
                            $('#correct_question').text("Số câu trả lời đúng: " + response.correct_question);
                            $('#loading').css('display', 'none');
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

    <script>function redirectToHomePage() {
            // Thay đổi URL trong lịch sử trình duyệt
            window.history.replaceState({}, document.title, '/');

            // Chuyển hướng người dùng đến trang chủ
            window.location.href = '/';
        }</script>
@endsection


