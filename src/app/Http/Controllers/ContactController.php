<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\contacts;
use App\Models\categories; // Categoryモデルをインポート

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    // 入力内容の確認
    public function confirm(Request $request)
    {
        $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'tell' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'address' => 'required|string|max:255',
            'category_id' => 'required|in:1,2',
            'detail' => 'required|string|max:1000',
        ]);

        // 入力内容を取得
        $data = $request->all();

        // 確認ビューにデータを渡す
        return view('confirm', $data);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        // データの保存
        contacts::create($request->all());
        

        // ありがとうございますビューを表示
        return view('thanks');
    }


    public function admin()
    {
        // データベースから全件取得（ページネーション）
        $results = Contacts::paginate(7);
    
        // カテゴリーのデータを取得
        // $categories = categories::all();
        $categories = categories::all(); // モデル名を修正
            // DD($categories);
        // 結果が空の場合、空のコレクションを設定
        if ($results->isEmpty())
        {
            $results = collect();
        }
    
        // ビューに結果とカテゴリーを渡す
        return view('admin', [
            'results' => $results,
            'categories' => $categories // カテゴリーも渡す
        ]);
    }
    
public function search(Request $request)
{
    $categories = categories::all(); // モデル名を修正

    if ($request->has('reset')) {
        $results = Contacts::with('category')->paginate(7);
    } else {

        // 検索条件を取得
        $name = $request->input('name');
        $gender = $request->input('gender');
        $email = $request->input('email');
        $category = $request->input('category');
        $date = $request->input('date');

        // クエリビルダーを使用してデータを取得
        $query = Contacts::with('category'); // ここでリレーションを追加

        if ($name) {
            $query->where(function($query) use ($name) {
                $query->where('first_name', 'like', '%' . $name . '%')
                      ->orWhere('last_name', 'like', '%' . $name . '%');
            });
        }

        if ($gender) {
            $query->where('gender', $gender);
        }

        if ($email) {
            $query->orWhere('email', 'like', '%' . $email . '%');
        }

        if ($category) {
            $query->orWhere('category_id', $category);
        }

        if ($date) {
            $query->orWhereDate('created_at', $date);
        }

        $results = $query->paginate(7);
        }

        // return view('admin', compact('results'))->withInput($request->input());
        return view('admin', [
            'results' => $results,
            'categories' => $categories // カテゴリーも渡す
        ]);

    }
    
    public function delete($id)
    {
        $contact = Contacts::find($id);
        if ($contact) {
            $contact->delete();
        }

        return redirect()->route('admin');
    }

    public function thanks()
    {
        // ありがとうございますビューを表示
        return view('thanks');
    }

}
