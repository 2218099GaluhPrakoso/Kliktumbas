<!DOCTYPE html>
<html>
<head>
    <title>Register - KlikTumbas</title>
    <style>
        body {
            margin: 0;
            background: linear-gradient(to bottom, #00aaff, #aaddff);
            font-family: sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .register-container {
            background: #f2f8fc;
            padding: 35px 45px;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
            text-align: center;
            width: 100%;
            max-width: 420px;
            animation: fadeIn 0.8s ease-in-out;
        }
        .register-container h2 {
            margin: 0 0 10px;
            font-size: 28px;
            color: #003366;
            letter-spacing: 1px;
        }
        .register-container h2 span {
            color: #fdbb0a;
        }
        .register-container h3 {
            margin: 5px 0 20px;
            font-weight: bold;
            color: #444;
            font-size: 18px;
        }
        input {
            width: 100%;
            padding: 12px;
            margin: 8px 0 18px;
            border: none;
            background: #fff;
            border-radius: 8px;
            font-size: 16px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }
        input:focus {
            outline: none;
            box-shadow: 0 4px 10px rgba(0,150,255,0.3);
            transform: translateY(-2px);
        }
        .btn-register {
            background: linear-gradient(to right, #007bff, #0056b3);
            color: white;
            padding: 12px;
            width: 100%;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        .btn-register:hover {
            background: linear-gradient(to right, #0056b3, #007bff);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }
        .link-login {
            margin-top: 18px;
            display: block;
            font-size: 14px;
        }
        .link-login a {
            color: #007bff;
            font-weight: bold;
            text-decoration: none;
            transition: color 0.3s;
        }
        .link-login a:hover {
            color: #0056b3;
        }
        .error {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }
        @keyframes fadeIn {
            from {opacity: 0; transform: scale(0.95);}
            to {opacity: 1; transform: scale(1);}
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Klik<span>TUMBAS</span></h2>
        <h3>Daftar untuk mulai berbelanja</h3>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <input type="text" name="name" placeholder="Masukkan nama" value="{{ old('name') }}" required>
            <input type="text" name="phone" placeholder="Masukkan no telepon" value="{{ old('phone') }}" required>
            <input type="text" name="gender" placeholder="Masukkan Jenis Kelamin" value="{{ old('gender') }}" required>
            <input type="date" name="birth_date" placeholder="Masukkan Tanggal lahir" value="{{ old('birth_date') }}" required>
            <input type="email" name="email" placeholder="Masukkan Email" value="{{ old('email') }}" required>
            <input type="password" name="password" placeholder="Masukkan Password" required>
            <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>

            <button type="submit" class="btn-register">DAFTAR</button>

            <div class="link-login">
                Sudah punya akun? <a href="{{ route('login') }}">Login sekarang</a>
            </div>
        </form>
    </div>
</body>
</html>
