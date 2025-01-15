<div class="form-group">
    <label for="name">Name:</label>
    <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $company->name ?? '') }}">
    @error('name')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    <label for="email">Email:</label>
    <input type="text" name="email" class="form-control" id="email" value="{{ old('email', $company->email ?? '') }}">
    @error('email')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    <label for="logo">Logo:</label>
    <input type="file" name="logo" class="form-control" id="logo">
    @error('logo')
        <span class="text-danger">{{ $message }}</span>
    @enderror

    @if (isset($company) && $company->logo)
        <img src="{{ asset('/storage/logos/' . $company->logo) }}" alt="Logo" width="100" class="mt-2">
    @endif
</div>

<button type="submit" class="btn btn-success">{{ $buttonText }}</button>
