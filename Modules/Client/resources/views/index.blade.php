<x-app-layout>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        <h4>Clients List
                            <a href="{{ url('clients/create') }}" class="btn btn-primary float-end">Add Client</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Facility Level</th>
                                    <th>Location</th>
                                    <th>Contact Person</th>
                                    <th>Contact Phone</th>
                                    <th>Email for Invoices</th>
                                    <th>Billing Cycle</th>
                                    <th>Streamline Engineer</th>
                                    <th>Engineer Phone</th>
                                    <th>Engineer Email</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clients as $client)
                                    <tr>
                                        <td>{{ $client->id }}</td>
                                        <td>{{ $client->name }}</td>
                                        <td>{{ $client->facility_level }}</td>
                                        <td>{{ $client->location }}</td>
                                        <td>{{ $client->contact_person_name }}</td>
                                        <td>{{ $client->contact_person_phone }}</td>
                                        <td>{{ $client->email_for_invoices }}</td>
                                        <td>{{ $client->billing_cycle }}</td>
                                        <td>{{ $client->streamline_engineer_name }}</td>
                                        <td>{{ $client->streamline_engineer_phone }}</td>
                                        <td>{{ $client->streamline_engineer_email }}</td>
                                        <td>
                                            <a href="{{ url('clients/' . $client->id . '/edit') }}" class="btn btn-success btn-sm">Edit</a>

                                            <form action="{{ url('clients/' . $client->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
