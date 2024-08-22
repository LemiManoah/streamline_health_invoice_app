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
                        <h4>Edit Client
                            <a href="{{ route('clients.index') }}" class="btn btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('clients.update', $client->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $client->name) }}" />
                            </div>
                            <div class="mb-3">
                                <label for="">Facility Level</label>
                                <input type="text" name="facility_level" class="form-control" value="{{ old('facility_level', $client->facility_level) }}" />
                            </div>
                            <div class="mb-3">
                                <label for="">Location</label>
                                <input type="text" name="location" class="form-control" value="{{ old('location', $client->location) }}" />
                            </div>
                            <div class="mb-3">
                                <label for="">Contact Person Name</label>
                                <input type="text" name="contact_person_name" class="form-control" value="{{ old('contact_person_name', $client->contact_person_name) }}" />
                            </div>
                            <div class="mb-3">
                                <label for="">Contact Person Phone</label>
                                <input type="text" name="contact_person_phone" class="form-control" value="{{ old('contact_person_phone', $client->contact_person_phone) }}" />
                            </div>
                            <div class="mb-3">
                                <label for="">Email for Invoices</label>
                                <input type="email" name="email_for_invoices" class="form-control" value="{{ old('email_for_invoices', $client->email_for_invoices) }}" />
                            </div>
                            <div class="mb-3">
                                <label for="">Billing Cycle</label>
                                <input type="text" name="billing_cycle" class="form-control" value="{{ old('billing_cycle', $client->billing_cycle) }}" />
                            </div>
                            <div class="mb-3">
                                <label for="">Streamline Engineer Name</label>
                                <input type="text" name="streamline_engineer_name" class="form-control" value="{{ old('streamline_engineer_name', $client->streamline_engineer_name) }}" />
                            </div>
                            <div class="mb-3">
                                <label for="">Streamline Engineer Phone</label>
                                <input type="text" name="streamline_engineer_phone" class="form-control" value="{{ old('streamline_engineer_phone', $client->streamline_engineer_phone) }}" />
                            </div>
                            <div class="mb-3">
                                <label for="">Streamline Engineer Email</label>
                                <input type="email" name="streamline_engineer_email" class="form-control" value="{{ old('streamline_engineer_email', $client->streamline_engineer_email) }}" />
                            </div>
                            <div class="mb-3">
                                <label for="">Status</label>
                                <select name="status" class="form-control">
                                    <option value="Active" {{ $client->status == 'Active' ? 'selected' : '' }}>Active</option>
                                    <option value="Inactive" {{ $client->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
