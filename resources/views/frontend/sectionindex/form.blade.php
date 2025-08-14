<div class="container availability-form">
    <div class="row">
        <div class="col-lg-12 bg-white shadow p-4 rounded">
            <h5 class="col-lg-3">Check Booking Availability</h5>
            <form method="get" action="/rooms">
               @csrf
                <div class="row align-items-end">
                    <div class="col-lg-4 mb-3">
                        <label class="form-label" style="font-weight: 500;">Check-in</label>
                        <input type="date" name="from" id="from" class="form-control shadow-none" min="{{ date('Y-m-d') }}">
                    </div>
                    <div class="col-lg-4 mb-3">
                        <label class="form-label" style="font-weight: 500;">Check-in</label>
                        <input type="date" name="to" id="to" class="form-control shadow-none" min="{{ date('Y-m-d') }}">
                    </div>
                    <div class="col-lg-3 mb-3">
                    <label class="form-label" style="font-weight: 500;">Person</label>
                    <input type="number" name="count" class="form-control shadow-none" id="count" value="1">
                    </div>
                    <div class="col-lg-1 mb-lg-3 mt-2">
                        <button type="submit" class="btn shadow-none border">Submit</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
