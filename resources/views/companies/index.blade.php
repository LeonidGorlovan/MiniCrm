@extends('adminlte::page')

@section('title', 'Companies')

@section('content_header')
    <h1>Companies</h1>
@stop

@section('content')
    <a href="{{ route('company.create') }}" class="btn btn-primary mb-3">Create Company</a>

    <table id="companies-table" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Logo</th>
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
        $('#companies-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('company.index') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                {
                    data: 'logo',
                    name: 'logo',
                    render: function(data) {
                        return data ? `<img src="/storage/logos/${data}" width="50">` : 'No logo';
                    },
                    orderable: false,
                    searchable: false,
                },
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
