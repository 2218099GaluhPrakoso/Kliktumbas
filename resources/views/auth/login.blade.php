<!DOCTYPE html>
<html>
<head>
    <title>Login User - KlikTumbas</title>
    <style>
        body {
            margin: 0;
            background: linear-gradient(135deg, #00aaff, #aaddff);
            font-family: 'Segoe UI', Tahoma, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background: #f2f8fc;
            padding: 40px 45px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            text-align: center;
            width: 100%;
            max-width: 400px;
            animation: fadeIn 0.6s ease-out;
        }
        .login-container h2 {
            margin: 0;
            font-size: 28px;
            color: #003366;
        }
        .login-container h2 span {
            color: #fdbb0a;
        }
        .login-container h3 {
            margin: 20px 0;
            font-weight: bold;
            color: #222;
            font-size: 20px;
        }
        input {
            width: 100%;
            padding: 12px 15px;
            margin-top: 12px;
            margin-bottom: 20px;
            border: none;
            background: #fff;
            border-radius: 8px;
            font-size: 16px;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }
        input:focus {
            outline: none;
            box-shadow: 0 0 5px #00aaff;
            background: #fefefe;
        }
        .btn-login {
            background: linear-gradient(to right, #007bff, #00aaff);
            color: white;
            padding: 12px;
            width: 100%;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 12px rgba(0,123,255,0.3);
        }
        .link-register {
            margin-top: 20px;
            font-size: 14px;
        }
        .link-register a {
            color: #007bff;
            font-weight: bold;
            text-decoration: none;
            transition: color 0.2s ease;
        }
        .link-register a:hover {
            color: #0056b3;
        }
        .error {
            color: red;
            font-size: 14px;
            margin-bottom: 15px;
        }
        .success-message {
            color: green;
            font-size: 14px;
            margin-bottom: 15px;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Klik<span>TUMBAS</span></h2>
        <h3>Login To Tumbas</h3>

        @if($errors->has('login'))
            <div class="error">{{ $errors->first('login') }}</div>
        @endif

        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="text" name="name" placeholder="Masukkan nama" required value="{{ old('name') }}">
            <input type="text" name="phone" placeholder="Masukkan no telepon" required value="{{ old('phone') }}">

            <button type="submit" class="btn-login">LOGIN</button>

            <div class="link-register">
                Login Admin? <a href="{{ route('admin.login') }}">Login</a><br>
                Pengguna Baru? <a href="{{ route('register') }}">Daftar</a>
            </div>
        </form>
    </div>
</body>
</html>
