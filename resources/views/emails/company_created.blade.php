<!DOCTYPE html>
<html>
    <head>
        <title>New Company Created</title>
    </head>
    <body>
        <h1>A new company has been created!</h1>
        <p><b>ID</b>: {{ $company->id }}</p>
        <p><b>Name</b>: {{ $company->name }}</p>
        <p><b>Email</b>: {{ $company->email }}</p>
        @if(!empty($logoBase64))
            <p><strong>Logo:</strong></p>
            <img src="{{ $logoBase64 }}" alt="Company Logo" width="100">
        @endif
    </body>
</html>
