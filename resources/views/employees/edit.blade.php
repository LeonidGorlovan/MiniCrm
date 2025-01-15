@extends('adminlte::page')

@section('title', 'Edit Employee')

@section('content_header')
    <h1>Edit Employee</h1>
@endsection

@section('content')
    <form action="{{ route('employee.update', $employee) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('employees.partials.form', ['buttonText' => 'Update'])
    </form>
@endsection
