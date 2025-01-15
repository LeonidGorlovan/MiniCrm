@extends('adminlte::page')

@section('title', 'Add Employee')

@section('content_header')
    <h1>Add Employee</h1>
@endsection

@section('content')
    <form action="{{ route('employee.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('employees.partials.form', ['buttonText' => 'Save'])
    </form>
@endsection
