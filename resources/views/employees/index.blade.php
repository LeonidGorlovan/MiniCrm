@extends('adminlte::page')

@section('title', 'Employees')

@section('content_header')
    <h1>Employees</h1>
@stop

@section('content')
    <a href="{{ route('employee.create') }}" class="btn btn-primary mb-3">Create Employee</a>

    <table id="employees-table" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Company</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Actions</th>
        </tr>
        </thead>
    </table>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
@stop

@section('js')
    <script>
        $('#employees-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('employee.index') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'company_name', name: 'company.name' },
                { data: 'first_name', name: 'first_name' },
                { data: 'last_name', name: 'last_name' },
                { data: 'email', name: 'email' },
                { data: 'phone', name: 'phone' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false },
            ]
        });

        $(document).ready(function() {
            @if (session('success'))
            toastr.success('{{ session('success') }}');
            @endif

            @if (session('error'))
            toastr.error('{{ session('error') }}');
            @endif

            @if (session('info'))
            toastr.info('{{ session('info') }}');
            @endif

            @if (session('warning'))
            toastr.warning('{{ session('warning') }}');
            @endif
        });
    </script>
@stop
