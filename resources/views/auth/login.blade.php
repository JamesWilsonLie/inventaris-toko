<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login | Inventaris</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('backend/assets/images/logos/favicon.png') }}" />
  <link rel="stylesheet" href="{{ asset('backend/assets/css/styles.min.css') }}" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" 
    data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <h1 class="text-center">Login</h1>
                </a>
                <p class="text-center">Silakan login untuk melanjutkan</p>

                <!-- Session Status -->
                @if (session('status'))
                  <div class="alert alert-success text-center mb-4">
                    {{ session('status') }}
                  </div>
                @endif

                <!-- Login Form -->
                <form method="POST" action="{{ route('login') }}">
                  @csrf

                  <!-- Email -->
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" name="email" 
                      value="{{ old('email') }}" required autofocus 
                      class="form-control @error('email') is-invalid @enderror">
                    @error('email')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                  <!-- Password -->
                  <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" name="password" required 
                      class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                  <!-- Remember Me + Forgot Password -->
                  <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                      <input class="form-check-input primary" type="checkbox" name="remember" id="remember_me">
                      <label class="form-check-label text-dark" for="remember_me">
                        Remember this device
                      </label>
                    </div>
                    @if (Route::has('password.request'))
                      <a class="text-primary fw-bold" href="{{ route('password.request') }}">Forgot Password?</a>
                    @endif
                  </div>

                  <!-- Submit Button -->
                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">
                    Log In
                  </button>

                  <!-- Register -->
                  @if (Route::has('register'))
                    <div class="d-flex align-items-center justify-content-center">
                      <p class="fs-4 mb-0 fw-bold">Belum punya akun?</p>
                      <a class="text-primary fw-bold ms-2" href="{{ route('register') }}">Daftar Sekarang</a>
                    </div>
                  @endif
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="{{ asset('backend/assets/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('backend/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
