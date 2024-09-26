<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>FashionablyLate - 確認</title>
    <!-- CSSファイルのリンクをここに追加 -->
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
</head>
<body>

<div class="container">
    <h1>FashionablyLate - 確認</h1>
    <h2>FashionablyLate - 確認</h2>

    <form action="/store" method="post">
        @csrf <!-- CSRFトークンの追加 -->

        <div class="form-group">
            <label for="first_name">お名前（性）</label>
            <div class="form-control">{{ $first_name }}</div>
            <input type="hidden" name="first_name" value="{{ $first_name }}">
        </div>

        <div class="form-group">
            <label for="last_name">お名前（名）</label>
            <div class="form-control">{{ $last_name }}</div>
            <input type="hidden" name="last_name" value="{{ $last_name }}">
        </div>

        <div class="form-group">
            <label for="gender">性別</label>
            <div class="form-control">
                @if ($gender == 1)
                    男性
                @elseif ($gender == 2)
                    女性
                @else
                    その他
                @endif
            </div>
            <input type="hidden" name="gender" value="{{ $gender }}">
        </div>

        <div class="form-group">
            <label for="email">メールアドレス</label>
            <div class="form-control">{{ $email }}</div>
            <input type="hidden" name="email" value="{{ $email }}">
        </div>

        <div class="form-group">
            <label for="tell">電話番号</label>
            <div class="form-control">{{ $tell }}</div>
            <input type="hidden" name="tell" value="{{ $tell }}">
        </div>

        <div class="form-group">
            <label for="address">住所</label>
            <div class="form-control">{{ $address }}</div>
            <input type="hidden" name="address" value="{{ $address }}">
        </div>

        <div class="form-group">
            <label for="building">マンション名など</label>
            <div class="form-control">{{ $building }}</div>
            <input type="hidden" name="building" value="{{ $building }}">
        </div>

        <div class="form-group">
            <label for="category_id">問い合わせ種別</label>
            <div class="form-control">
                @if ($category_id == 1)
                    商品のお届けについて
                @elseif ($category_id == 2)
                    商品の交換について
                @endif
            </div>
            <input type="hidden" name="category_id" value="{{ $category_id }}">
        </div>

        <div class="form-group">
            <label for="detail">メッセージ</label>
            <div class="form-control">{{ $detail }}</div>
            <input type="hidden" name="detail" value="{{ $detail }}">
        </div>

        <button type="submit" class="submit-btn">送信する</button>
    </form>
</div>

<!-- 必要に応じてスクリプトをここに追加 -->

</body>
</html>
