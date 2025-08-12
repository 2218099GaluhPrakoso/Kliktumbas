<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin - KlikTumbas</title>
    <style>
        body {
            background: linear-gradient(135deg, #6DD5FA, #2980B9);
            font-family: 'Segoe UI', Tahoma, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-box {
            background-color: #f0faff;
            padding: 35px 30px;
            border-radius: 15px;
            width: 360px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            text-align: center;
            animation: fadeIn 0.8s ease-in-out;
        }

        h1 {
            color: #333;
            margin-bottom: 5px;
            font-size: 28px;
        }

        h1 span {
            color: #f1c40f;
        }

        .login-box h2 {
            font-size: 18px;
            margin-bottom: 25px;
            color: #000;
            font-weight: bold;
            text-decoration: underline;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 13px;
            margin-bottom: 18px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #fff;
            font-size: 14px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        input:focus {
            border-color: #2980B9;
            outline: none;
            box-shadow: 0 0 6px rgba(41,128,185,0.5);
        }

        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            font-size: 15px;
            letter-spacing: 0.5px;
            transition: background 0.3s, transform 0.2s;
        }

        button:hover {
            background: linear-gradient(135deg, #0056b3, #004494);
            transform: translateY(-2px);
        }

        .back-link {
            margin-top: 15px;
            font-size: 13px;
        }

        .back-link a {
            color: #000;
            text-decoration: none;
            font-weight: bold;
        }

        .back-link a:hover {
            text-decoration: underline;
        }

        .error {
            color: red;
            font-size: 13px;
            margin-bottom: 15px;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h1>Klik<span>TUMBAS</span></h1>
        <h2>Login Admin</h2>

        @if ($errors->has('login'))
            <div class="error">{{ $errors->first('login') }}</div>
        @endif

        <form method="POST" action="{{ url('/login/admin') }}">
            @csrf
            <input type="text" name="name" placeholder="Masukkan nama admin" required>
            <input type="password" name="password" placeholder="Masukkan password admin" required>

            <button type="submit">LOGIN</button>

            <div class="back-link">
                Bukan admin? <a href="{{ route('login') }}">Kembali ke Login User</a>
            </div>
        </form>
    </div>
</body>
</html>
