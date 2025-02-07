<!DOCTYPE html>
<html lang="id">
@include('login.layout.head')

<body>
    <div class="login-container">
        <div class="logo-container">
            <div class="logo">
                <img src="{{ asset('images/polisi.jpg') }}" alt="Logo Polisi">
            </div>
            <div class="logo">
                <img src="{{ asset('images/polisi.jpg') }}" alt="Logo Polisi">
            </div>
        </div>
        <div class="login-form">
            <h2>Login Disposisi Polisi</h2>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-group">
                    <input type="text" name="user_login" class="form-control" placeholder="Email atau Username" value="{{ old('user_login') }}" required>
                </div>
                <div class="input-group">
                    <input type="password" name="pass_login" class="form-control" placeholder="Password" required>
                </div>
                <button type="submit" class="login-btn">Masuk</button>
                <a href="#" class="forgot-password">Lupa Password?</a>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    
    
</body>

</html>