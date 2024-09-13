<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <div class="container mt-1">
                @can('view role')
                <a href="{{ url('roles') }}" class="btn btn-primary mx-1">Roles</a>
                @endcan
                @can('view permission')
                <a href="{{ url('permissions') }}" class="btn btn-info mx-1">Permissions</a>
                @endcan
                @can('view user')
                <a href="{{ url('users') }}" class="btn btn-warning mx-1">Users</a>
                @endcan
            </div>
        </h2>
    </x-slot>

    <div class="container mt-2">
        <div class="row">
            <div class="col-md-12">

                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <div class="card mt-3">
                    <div class="card-header">
                        <h4>
                            Roles
                            @can('create role')
                            <a href="{{ url('roles/create') }}" class="btn btn-primary float-end">Add Role</a>
                            @endcan
                        </h4>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th width="40%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @can('Add / Edit Role Permission')
                                        <a href="{{route('showAddPermission',  $role->id)}}" class="btn btn-warning">
                                            Add / Edit Role Permission
                                        </a>
                                        @endcan

                                        @can('update role')
                                        <a href="{{ url('roles/'.$role->id.'/edit') }}" class="btn btn-success">
                                            Edit
                                        </a>
                                        @endcan

                                        @can('delete role')
                                        <a href="{{route('delete', $role->id)}}" class="btn btn-danger mx-2">
                                            Delete
                                        </a>
                                        @endcan
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