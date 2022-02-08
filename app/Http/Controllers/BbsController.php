<?php

namespace App\Http\Controllers;

use App\Models\bbs_model;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class BbsController extends Controller
{
  
   public function index()
    {
        $bbss = bbs_model::orderBy('id','desc')->get();
        return view('bbs', compact('bbss'));
    }
    
    public function search(Request $request) {
      $kensaku_name = $request->kensaku_name;
      if(!empty($kensaku_name)){
          $query = bbs_model::query();
          $bbss = $query->where('message','like', '%' .$kensaku_name. '%')->orderBy('id','desc')->get();
          $message = $kensaku_name;
          return view('bbs')->with([
            'bbss' => $bbss,
            'message' => $message,
          ]);  
      }
      else{
          $message = "なし";
          $bbss = bbs_model::orderBy('id','desc')->get();
        return view('bbs', compact('bbss'))->with([
            'message' => $message,
          ]);
      }
    }
    
    public function create(Request $request) {
        $param = [
            
            'date' => Carbon::now(), //取得したいデータをinput要素のname属性
            'name' => $request->kakikomi_name,
            'category' => $request->級,
            'subCategory' => $request->科目,
            'message' => $request->message,
            
        ];
        //DBに接続しデータを挿入する。第１パラメータにSQL文、第２に$paramを。
        DB::insert('insert into bbs (date, name, category, subCategory, message) values (:date, :name, :category, :subCategory, :message)', $param);
        
        //トップページに遷移する
        return redirect('/bbs')->with('result', '新規記事を書き込みました');
    }
    
    public function remove(Request $request)
    {
      $password = $_POST['password'];
      if($password == 'password')
      {
        $param = ['id' => $request->id];
        DB::delete('delete from bbs where id = :id', $param);
        return redirect('/bbs')->with('result', '記事を削除しました');
      }
      else
      {
        return redirect('/bbs')->with('result', '管理パスワードが違います'); 
      }
    }
    
    
}