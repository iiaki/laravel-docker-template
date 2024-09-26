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

        <table>
            <tr>
                <th>お名前（性）</th>
                <td>{{ $first_name }}</td>
                <input type="hidden" name="first_name" value="{{ $first_name }}">
            </tr>
            <tr>
                <th>お名前（名）</th>
                <td>{{ $last_name }}</td>
                <input type="hidden" name="last_name" value="{{ $last_name }}">
            </tr>
            <tr>
                <th>性別</th>
                <td>
                    @if ($gender == 1)
                        男性
                    @elseif ($gender == 2)
                        女性
                    @else
                        その他
                    @endif
                </td>
                <input type="hidden" name="gender" value="{{ $gender }}">
            </tr>
            <tr>
                <th>メールアドレス</th>
                <td>{{ $email }}</td>
                <input type="hidden" name="email" value="{{ $email }}">
            </tr>
            <tr>
                <th>電話番号</th>
                <td>{{ $tell }}</td>
                <input type="hidden" name="tell" value="{{ $tell }}">
            </tr>
            <tr>
                <th>住所</th>
                <td>{{ $address }}</td>
                <input type="hidden" name="address" value="{{ $address }}">
            </tr>
            <tr>
                <th>マンション名など</th>
                <td>{{ $building }}</td>
                <input type="hidden" name="building" value="{{ $building }}">
            </tr>
            <tr>
                <th>問い合わせ種別</th>
                <td>
                    @if ($category_id == 1)
                        商品のお届けについて
                    @elseif ($category_id == 2)
                        商品の交換について
                    @endif
                </td>
                <input type="hidden" name="category_id" value="{{ $category_id }}">
            </tr>
            <tr>
                <th>メッセージ</th>
                <td>{{ $detail }}</td>
                <input type="hidden" name="detail" value="{{ $detail }}">
            </tr>
        </table>

        <button type="submit" class="submit-btn">送信する</button>
    </form>
</div>

<!-- 必要に応じてスクリプトをここに追加 -->

</body>
</html>
