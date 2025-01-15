@extends('adminlte::page')

@section('title', 'Edit Company')

@section('content_header')
    <h1>Edit Company</h1>
@endsection

@section('content')
    <form action="{{ route('company.update', $company) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('companies.partials.form', ['buttonText' => 'Update'])
    </form>
@endsection
