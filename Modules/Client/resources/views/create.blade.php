<x-app-layout>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">

                @if ($errors->any())
                <ul class="alert alert-warning">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h4>Create Client
                            <a href="{{ url('clients') }}" class="btn btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('clients') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" required/>
                            </div>

                            <div class="mb-3">
                                <label for="facility_level">Facility Level</label>
                                <input type="text" name="facility_level" class="form-control" required/>
                            </div>

                            <div class="mb-3">
                                <label for="location">Location</label>
                                <input type="text" name="location" class="form-control" required/>
                            </div>

                            <div class="mb-3">
                                <label for="contact_person_name">Contact Person Name</label>
                                <input type="text" name="contact_person_name" class="form-control" required/>
                            </div>

                            <div class="mb-3">
                                <label for="contact_person_phone">Contact Person Phone</label>
                                <input type="text" name="contact_person_phone" class="form-control" required/>
                            </div>

                            <div class="mb-3">
                                <label for="email_for_invoices">Email for Invoices</label>
                                <input type="email" name="email_for_invoices" class="form-control" required/>
                            </div>

                            <div class="mb-3">
                                <label for="billing_cycle">Billing Cycle</label>
                                <input type="text" name="billing_cycle" class="form-control" required/>
                            </div>

                            <div class="mb-3">
                                <label for="streamline_engineer_name">Streamline Engineer Name</label>
                                <input type="text" name="streamline_engineer_name" class="form-control" required/>
                            </div>

                            <div class="mb-3">
                                <label for="streamline_engineer_phone">Streamline Engineer Phone</label>
                                <input type="text" name="streamline_engineer_phone" class="form-control" required/>
                            </div>

                            <div class="mb-3">
                                <label for="streamline_engineer_email">Streamline Engineer Email</label>
                                <input type="email" name="streamline_engineer_email" class="form-control" required/>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
