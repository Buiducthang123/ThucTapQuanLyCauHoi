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
                    </div>
                </div>
            </div>
            <div class="row justify-content-around gap-0.5">
                @foreach($tests as $test)
                    <div class="card" style="width: 18rem;">
                        <img src="https://api.ayroui.com/images/product/28d4d31f-74f1-4260-9c59-4d608a2ed348.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title text-xl">{{$test->name}}</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a class="btn btn-primary" href="{{route('test.user.show',['id'=>$test->id])}}">Bắt đầu làm bài</a>
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
