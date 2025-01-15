@extends('adminlte::page')

@section('title', 'Add Company')

@section('content_header')
    <h1>Add Company</h1>
@endsection

@section('content')
    <form action="{{ route('company.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('companies.partials.form', ['buttonText' => 'Save'])
    </form>
@endsection
