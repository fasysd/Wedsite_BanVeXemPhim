@php
$seatRows = $seats->groupBy('seat_row');
@endphp

<div class="container-fluid">
<div class="d-flex justify-content-center">
    <div class="seat-layout">

        @foreach($seatRows as $rowName => $rowSeats)
            <div class="d-flex align-items-center mb-3">

                <div class="seat-row-label">
                    {{ $rowName }}
                </div>

                @foreach($rowSeats->sortBy('seat_number') as $seat)

                   <div class="seat-box {{ $seat->type === 'VIP' ? 'seat-vip' : 'seat-standard' }}"
                        data-seat-id="{{ $seat->id }}">
                        {{ $seat->seat_row }}{{ $seat->seat_number }}
                    </div>

                @endforeach

            </div>

        @endforeach

    </div>
</div>

<div class="d-flex justify-content-center mt-4">
    <div class="seat-legend">

        <div class="seat-legend-item">
            <div class="seat-legend-color seat-standard"></div>
            <span>Ghế thường (STANDARD)</span>
        </div>

        <div class="seat-legend-item">
            <div class="seat-legend-color seat-vip"></div>
            <span>Ghế VIP</span>
        </div>

    </div>
</div>
<div class="d-flex justify-content-center mt-4">
    <div class="seat-legend">

        <div class="seat-legend-item">
        <div class="seat-legend-color seat-selected"></div>
            <span>Đang chọn</span>
        </div>
        <div class="seat-legend-item">
            <div class="seat-legend-color seat-booked"></div>
            <span>Đã được đặt</span>
        </div>

    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {

    window.selectedSeatIds = [];
    window.ticketPrice = {{ $selectedShowtime->price_standard }};

    document.querySelectorAll('.seat-box').forEach(seat => {

        seat.addEventListener('click', function () {

            const seatId = this.dataset.seatId;

            if (this.classList.contains('seat-selected')) {

                this.classList.remove('seat-selected');

                const index = window.selectedSeatIds.indexOf(seatId);

                if (index > -1) {
                    window.selectedSeatIds.splice(index, 1);
                }

            } else {

                this.classList.add('seat-selected');

                window.selectedSeatIds.push(seatId);
            }

            updateBookingInfo();
        });

    });

    function updateBookingInfo() {

        document.getElementById('selectedSeats').textContent =
            window.selectedSeatIds.length;

        const total =
            window.selectedSeatIds.length * window.ticketPrice;

        document.getElementById('totalPrice').textContent =
            total.toLocaleString('vi-VN') + ' đ';
    }

});
</script>
