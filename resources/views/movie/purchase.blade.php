@extends('layouts.app')

@section('content')

<div class="container-fluid movie-index-page p-0 d-flex flex-column min-vh-100">

<div class="container mt-5">

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

    <h2 class="text-center text-white mb-4">
        XÁC NHẬN ĐẶT VÉ
    </h2>


    <div class="card bg-dark text-white p-4">

        <div class="row">

            <div class="col-md-3 text-center">

                <img 
                    src="{{ $movie->image_path }}"
                    alt="{{ $movie->title }}"
                    class="rounded"
                    style="width:200px;height:300px;object-fit:cover;"
                    onerror="this.onerror=null;this.src='{{ asset('images/movieavatar.webp') }}';"
                >

            </div>


            <div class="col-md-9">

                <h3 class="text-warning">
                    {{ $movie->title }}
                </h3>


                <p>
                    Thể loại:
                    <strong>{{ $movie->genre }}</strong>
                </p>


                <p>
                    Thời lượng:
                    <strong>{{ $movie->duration }} phút</strong>
                </p>


                <hr>


                <h5 class="text-info">
                    Thông tin suất chiếu
                </h5>


                <p>
                    Phòng:
                    <strong>{{ $showtime->room_id }}</strong>
                </p>


                <p>
                    Thời gian:
                    <strong>
                        {{ \Carbon\Carbon::parse($showtime->start_time)->format('H:i d/m/Y') }}
                    </strong>
                </p>


                <hr>


                <h5 class="text-info">
                    Ghế đã chọn
                </h5>


                <div>

                    @foreach($selectedSeats as $seat)

                        <span class="badge fs-6 me-2 
                        {{ $seat->type == 'VIP' ? 'bg-warning text-dark' : 'bg-light text-dark' }}">

                            Ghế {{ $seat->seat_row }}{{ $seat->seat_number }}

                        </span>

                    @endforeach

                </div>


                <hr>


                <h4>

                    Tổng tiền:

                    <span class="text-warning">

                        {{ number_format(count($selectedSeats) * $showtime->price_standard) }} đ

                    </span>

                </h4>


            </div>


        </div>


    </div>



    <div class="d-flex justify-content-between mt-4">


        <a 
            href="{{ route('ticket.booking',$movie->id) }}"
            class="btn btn-secondary px-5"
        >

            < Quay lại

        </a>



        <form 
            action="{{ route('ticket.store',$movie->id) }}" 
            method="POST"
        >

            @csrf


            <input 
                type="hidden"
                name="showtime_id"
                value="{{ $showtime->id }}"
            >



            @foreach($selectedSeats as $seat)

                <input 
                    type="hidden"
                    name="seat_ids[]"
                    value="{{ $seat->id }}"
                >

            @endforeach



            <button 
                type="submit"
                class="btn btn-danger px-5"
                onclick="return confirm('Bạn có chắc muốn đặt vé không?')"
            >

                Đặt vé

            </button>


        </form>


    </div>


</div>

</div>

@endsection