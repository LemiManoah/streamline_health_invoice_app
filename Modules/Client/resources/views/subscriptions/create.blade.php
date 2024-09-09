<x-app-layout>

<div class="container">
    <h1>Create Subscription</h1>
    <form action="{{ route('subscriptions.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="client_id" class="form-label">Client</label>
            <select name="client_id" id="client_id" class="form-select" required>
                <option value="">Select a client</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="plan_name" class="form-label">Plan Name</label>
            <input type="text" name="plan_name" id="plan_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="billing_cycle" class="form-label">Billing Cycle</label>
            <select name="billing_cycle" id="billing_cycle" class="form-select" required>
                <option value="">Select a billing cycle</option>
                <option value="annually">Annually</option>
                <option value="2_years">2 years</option>
                <option value="3_years">3 years</option>
                <option value="4_years">4 years</option>
                <option value="5_years">5 years</option>
                <option value="6_years">6 years</option>
                <option value="7_years">7 years</option>

            </select>
        </div>

        <div class="mb-3">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="date" name="start_date" id="start_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input type="number" name="amount" id="amount" class="form-control" step="0.01" required readonly>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select" required>
                <option value="">Select a status</option>
                <option value="paid">Paid</option>
                <option value="unpaid">Unpaid</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create Subscription</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#billing_cycle').on('change', function () {
            let billingCycle = $(this).val();
            
            if (billingCycle) {
                $.ajax({
                    url: '{{ route("get.amount") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        billing_cycle: billingCycle
                    },
                    success: function (response) {
                        $('#amount').val(response.amount);
                    },
                    error: function (xhr) {
                        console.error(xhr.responseText);
                    }
                });
            } else {
                $('#amount').val('');
            }
        });
    });
</script>

</x-app-layout>
