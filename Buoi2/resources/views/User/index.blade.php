@extends('Layouts.app')
@section('style')

    <link rel="stylesheet" href="{{asset('CSS/home.css')}}">
@endsection
@section('content')
    <!--====== PRICING STYLE ONE START ======-->
    <section class="pricing-area pricing-one">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-6 col-xl-7 col-lg-8">
                    <div class="section-title text-center mb-5">
                        <h2 class="mb-3 fw-bold fs-1">
                            Đề thi
                        </h2>
                        <button style="position: absolute;right: 25px" type="button" data-bs-toggle="modal"
                                data-bs-target="#fullscreenModal">
                            Lịch sử làm bài
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="fullscreenModal" tabindex="-1" aria-labelledby="fullscreenModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-fullscreen">
                    <div class="modal-content" style="font-size: 20px">
                        <div class="modal-header">
                            <h5 class="modal-title" id="fullscreenModalLabel">hello {{auth()->user()->name}}! Chào mừng
                                đến với lịch sử làm bài</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <?php
                            $results = auth()->user()->tests()->get();
                        ?>
                        <div class="modal-body" style="padding: 40px 80px">
                            <!-- Modal content goes here -->
                            <p style="text-align: center;margin-bottom: 20px;font-weight: bolder">Lịch sử làm bài</p>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Bài kiểm tra</th>
                                    <th scope="col">Điểm số</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Ngày thi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($results as $index => $result)
                                    <tr>
                                        <td>{{$index}}</td>
                                        <td>{{$result->name}}</td>
                                        <td>{{$result->pivot->score}}</td>
                                        <td>{{ ($result->pivot->status==1)?"Hoàn thành":"Chưa hoàn thành" }}</td>
                                        <td>{{$result->created_at->format('d-m-Y H:i:s')}}</td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <!-- Additional buttons can go here -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-around gap-0.5 mt-5">
                @foreach($tests as $test)
                    <div class="card" style="width: 18rem;">
                        <img src="https://api.ayroui.com/images/product/28d4d31f-74f1-4260-9c59-4d608a2ed348.jpg"
                             class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title text-xl">{{$test->name}}</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of the card's content.</p>
                            <button id="btn-create_result" onclick="create_result({{$test->id}})"
                                    class="btn btn-primary" href="">Bắt đầu làm bài {{$test->id}}</button>

                        </div>
                    </div>
                @endforeach
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </section>
    <!--====== PRICING STYLE ONE ENDS ======-->
@endsection
@section('import_js')

    <script src="{{asset("JS/AJAX/index.js")}}"></script>
    <script>

        // $(document).ready(function() {
        //     $('#btn-create_result').click(function() {
        //         console.log('uuhu');
        //         create_result(id);
        //     })
        // });


        function create_result(id) {
            let test_id = <?php echo json_encode(($test->id)) ?>;
            data = {
                'test_id': id,
            }
            console.log('diewfb');
            PostAjax('/result', data);

            window.location = "/test/" + id;
        }
    </script>
    {{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"></script>

@endsection
