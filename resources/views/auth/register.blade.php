<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register Page</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container d-flex vh-100">
    <div class="row align-items-center justify-content-center w-100">
      <!-- Register Section -->
      <div class="col-md-6">
        <div class="card p-4 shadow">
          <h3 class="text-center mb-4">Register</h3>
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
          <form action="{{ route('register.post') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}"
                required>
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}"
                required>
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" id="password" name="password" class="form-control" value="{{ old('password') }}"
                required>
            </div>

            <div class="mb-3">
              <label for="password_confirmation" class="form-label">Confirm Password</label>
              <input type="password" id="password_confirmation" name="password_confirmation"
                value="{{ old('password_confirmation') }}" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Register</button>
          </form>
          <div class="text-center mt-3">
            <small>Already have an account? <a href="{{ route('login') }}">Login</a></small>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
