<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>FashionablyLate - Contact</title>
    <!-- CSSファイルのリンクをここに追加 -->
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
</head>
<body>

<div class="container">
    <h1>FashionablyLate - Contact</h1>
    <h2>Contact - Contact</h2>
    <form action="/confirm" method="post">
        @csrf <!-- CSRFトークンの追加 -->

        <div class="form-group">
            <label for="first_name">お名前<span class="required">※</span></label>
            <input type="text" id="last_name" name="last_name"  placeholder="山田" value="{{ old('last_name') }}">
            <input type="text" id="first_name" name="first_name" placeholder="太郎" value="{{ old('first_name') }}">
            @error('last_name')
                <div class="error">{{ $message }}</div>
            @enderror
            @error('first_name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="gender">性別<span class="required">※</span></label>
            <input type="radio" id="male" name="gender" value="1">
            <label for="male">男性</label>
            <input type="radio" id="female" name="gender" value="2">
            <label for="female">女性</label>
            <input type="radio" id="other" name="gender" value="9" checked>
            <label for="other">その他</label>
        </div>

        <div class="form-group">
            <label for="email">メールアドレス<span class="required">※</span></label>
            <input type="email" id="email" name="email" placeholder="example@example.com" value="{{ old('email') }}">
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="tell">電話番号<span class="required">※</span></label>
            <input type="text" id="tell" name="tell" placeholder="090-1234-5678" value="{{ old('tell') }}">
            @error('tell')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="address">住所<span class="required">※</span></label>
            <input type="text" id="address" name="address" value="{{ old('address') }}">
        </div>

        <div class="form-group">
            <label for="building">マンション名など</label>
            <input type="text" id="building" name="building" value="{{ old('building') }}">
        </div>


        <div class="form-group">
            <label for="category_id">件名<span class="required">※</span></label>
            <select id="category_id" name="category_id" >
                <option value="1">商品のお届けについて</option>
                <option value="2">商品の交換について</option>
            </select>
        </div>

        <div class="form-group">
            <label for="detail">メッセージ<span class="required">※</span></label>
            <textarea id="detail" name="detail" rows="5" placeholder="メッセージを入力してください" value="{{ old('detail') }}"></textarea>
            @error('detail')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="submit-btn-container">
            <button   button type="submit" class="submit-btn">送信内容を確認する</button>
        </div>

    </form>
</div>

<!-- 必要に応じてスクリプトをここに追加 -->

</body>
</html>
