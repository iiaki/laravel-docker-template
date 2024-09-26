<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>FashionablyLate - Admin Panel</title>
    <style>
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
        .nav-bar {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .nav-bar a {
            text-decoration: none;
            color: #333;
            padding: 10px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input, select, textarea {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .btn-group {
            display: flex;
            gap: 10px;
        }
        .search-btn, .reset-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .reset-btn {
            background-color: #6c757d;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table th, .table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .form-horizontal {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .form-horizontal .form-group {
            flex: 1;
            min-width: 150px;
        }
        .pagination li {
            display: inline-block;
            margin: 0 5px;
        }
        .pagination li a {
            padding: 10px;
            font-size: 14px;
        }
        svg {
            width: 16px;
            height: 16px;
            vertical-align: middle;
        }
    </style>

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function() {
            $("#date").datepicker();
        });

        function openModal(id) {
            $("#modal-" + id).show();
        }

        function closeModal(id) {
            $("#modal-" + id).hide();
        }
    </script>
</head>
<body>

<div class="container">
    <div class="nav-bar">
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <a href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            ログアウト
        </a>
    </div>

    <h1>FashionablyLate - Admin Panel</h1>

    <form action="/search" method="post" class="form-horizontal">
        @csrf <!-- CSRFトークンの追加 -->

        <div class="form-group">
            <input type="text" id="name" name="name" placeholder="名前やメールアドレスを入力してください" value="{{ old('name') }}">
        </div>

        <div class="form-group">
            <select id="gender" name="gender">
                <option value="" disabled {{ old('gender') === null ? 'selected' : '' }}>性別</option>
                <option value="1" {{ old('gender') == 1 ? 'selected' : '' }}>男性</option>
                <option value="2" {{ old('gender') == 2 ? 'selected' : '' }}>女性</option>
                <option value="9" {{ old('gender') == 9 ? 'selected' : '' }}>その他</option>
            </select>
        </div>

        <div class="form-group">
            <select id="category" name="category">
                <option value="" disabled {{ old('category') === null ? 'selected' : '' }}>お問い合わせ種類</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->content }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <input type="text" id="date" name="date" placeholder="日付を選択してください" value="{{ old('date') }}">
        </div>

        <div class="btn-group">
            <button type="submit" class="search-btn">検索</button>
            <button type="submit" class="reset-btn" name="reset" value="true">リセット</button>
        </div>
    </form>

    <!-- 検索結果の一覧表示 -->
    <table class="table">
        <thead>
            <tr>
                <th>お名前</th>
                <th>性別</th>
                <th>メールアドレス</th>
                <th>お問い合わせ種類</th>
                <th>詳細</th>
            </tr>
        </thead>
        <tbody>
            @foreach($results as $result)
            <tr>
                <td>{{ $result->last_name }} {{ $result->first_name }}</td>
                <td>{{ $result->gender }}</td>
                <td>{{ $result->email }}</td>
                <!-- <td>{{ $result->category_id }}</td> -->
                <td>{{ $result->category->content  }}</td>

                <td><button onclick="openModal({{ $result->id }})">詳細</button></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- ページネーションリンクの表示 -->
    {{ $results->appends(request()->input())->links() }}

    <!-- モーダルの内容 -->
    @foreach($results as $result)
    <div id="modal-{{ $result->id }}" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal({{ $result->id }})">×</span>
            <h2>詳細情報</h2>
            <p><strong>お名前:</strong> {{ $result->last_name }} {{ $result->first_name }}</p>
            <p><strong>性別:</strong> {{ $result->gender }}</p>
            <p><strong>メールアドレス:</strong> {{ $result->email }}</p>
            <p><strong>お問い合わせ種類:</strong> {{ $result->category_id }}</p>
            <p><strong>お問い合わせ内容:</strong> {{ $result->detail }}</p>
            <form action="{{ route('delete', $result->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-btn">削除</button>
            </form>
        </div>
    </div>
    @endforeach
</div>

</body>
</html>
