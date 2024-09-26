<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>登録</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <h1>FashionablyLate - 登録</h1>
    <h3>FashionablyLate - 登録</h3>
    <a href="{{ route('login') }}" class="login-link">login</a>

    <div class="register-container">

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label for="name">名前</label>
                <input type="text" name="name" id="name" required autofocus>
            </div>
            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="password">パスワード</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">パスワード確認</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required>
            </div>
            <button type="submit" class="register-btn">登録</button>
        </form>
    </div>
    
</body>
</html>
