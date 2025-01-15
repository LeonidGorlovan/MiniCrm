<div class="form-group">
    <label for="name">Company:</label>

    <select name="company_id" class="form-control" id="company_id">
        @foreach($companies as $company)
            <option value="{{ $company->id }}" {{ old('company_id', $employee->company_id ?? '') ? 'selected' : '' }}>{{ $company->name }}</option>
        @endforeach
    </select>

    @error('company_id')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    <label for="name">First Name:</label>
    <input type="text" name="first_name" class="form-control" id="first_name" value="{{ old('first_name', $employee->first_name ?? '') }}">
    @error('first_name')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    <label for="name">Last Name:</label>
    <input type="text" name="last_name" class="form-control" id="last_name" value="{{ old('last_name', $employee->last_name ?? '') }}">
    @error('last_name')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    <label for="email">Email:</label>
    <input type="text" name="email" class="form-control" id="email" value="{{ old('email', $employee->email ?? '') }}">
    @error('email')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    <label for="email">Phone:</label>
    <input type="text" name="phone" class="form-control" id="phone" value="{{ old('phone', $employee->phone ?? '') }}">
    @error('phone')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<button type="submit" class="btn btn-success">{{ $buttonText }}</button>
