@php
    $seatRows = $seats->groupBy('seat_row');
@endphp

<div class="container-fluid">
    <div class="d-flex justify-content-center">
        <div class="seat-layout">

            @foreach($seatRows as $rowName => $rowSeats)
                <div class="d-flex align-items-center mb-3">

                    <div class="fw-bold me-3" style="width: 40px; color: #ffffff; font-size: 1.2rem;">
                        {{ $rowName }}
                    </div>
                    @foreach($rowSeats->sortBy('seat_number') as $seat)
                        <div class="seat-box">
                            {{ $seat->seat_row }}{{ $seat->seat_number }}
                        </div>
                    @endforeach

                </div>
            @endforeach

        </div>
    </div>

</div>