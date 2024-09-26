<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ログイン</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <h1>FashionablyLate - 確認</h1>
    <h2>FashionablyLate - 確認</h2>
    <a href="{{ route('register') }}" class="register-link">register</a>
    
    <div class="login-container">

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="email" name="email" id="email" required autofocus>
            </div>
            <div class="form-group">
                <label for="password">パスワード</label>
                <input type="password" name="password" id="password" required>
            </div>
            <button type="submit" class="login-btn">ログイン</button>


            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <!-- <li>{{ $error }}</li> -->
                        <li>ログインエラー</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </form>
    </div>
    
</body>
</html>
