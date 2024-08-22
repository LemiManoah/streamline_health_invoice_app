<x-app-layout>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        <h4>Client Details
                            <a href="{{ route('clients.index') }}" class="btn btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <h5>Name:</h5>
                            <p>{{ $client->name }}</p>
                        </div>
                        <div class="mb-3">
                            <h5>Facility Level:</h5>
                            <p>{{ $client->facility_level }}</p>
                        </div>
                        <div class="mb-3">
                            <h5>Location:</h5>
                            <p>{{ $client->location }}</p>
                        </div>
                        <div class="mb-3">
                            <h5>Contact Person Name:</h5>
                            <p>{{ $client->contact_person_name }}</p>
                        </div>
                        <div class="mb-3">
                            <h5>Contact Person Phone:</h5>
                            <p>{{ $client->contact_person_phone }}</p>
                        </div>
                        <div class="mb-3">
                            <h5>Email for Invoices:</h5>
                            <p>{{ $client->email_for_invoices }}</p>
                        </div>
                        <div class="mb-3">
                            <h5>Billing Cycle:</h5>
                            <p>{{ $client->billing_cycle }}</p>
                        </div>
                        <div class="mb-3">
                            <h5>Streamline Engineer Name:</h5>
                            <p>{{ $client->streamline_engineer_name }}</p>
                        </div>
                        <div class="mb-3">
                            <h5>Streamline Engineer Phone:</h5>
                            <p>{{ $client->streamline_engineer_phone }}</p>
                        </div>
                        <div class="mb-3">
                            <h5>Streamline Engineer Email:</h5>
                            <p>{{ $client->streamline_engineer_email }}</p>
                        </div>
                        <div class="mb-3">
                            <h5>Status:</h5>
                            <p>{{ $client->status }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
