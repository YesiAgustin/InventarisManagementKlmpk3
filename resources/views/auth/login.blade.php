<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container d-flex vh-100">
    <div class="row align-items-center justify-content-center w-100">
      <!-- Login Section -->
      <div class="col-md-6">
        <div class="card p-4 shadow">
          <h3 class="text-center mb-4">Login</h3>
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
          <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control"name="email" value="{{ old('email') }}"
                placeholder="Enter your email">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control"name="password" value="{{ old('password') }}" <input
                type="password" class="form-control"name="password" value="{{ old('password') }}"
                placeholder="Enter your password">
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
          </form>
          <div class="text-center mt-3">
            <small>Don't have an account? <a href="{{ route('register') }}">Register</a></small>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
