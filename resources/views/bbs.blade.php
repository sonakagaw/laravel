<!doctype html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>簿記ペディア</title>
    <link href="{{secure_asset('/assets/css/bbs.css')}}" rel="stylesheet" media="all">
    <link href="{{secure_asset('/assets/css/common.css')}}" rel="stylesheet" media="all">
</head>

<body>

    <noscript>
        <p>JavaScriptを有効にしてください。</p>
    </noscript>

    <header id="header">
        <h1>簿記なんでも掲示板</h1>
    </header>

    <main id="contents">

        <section class="wrapper">

            <section class="section">
                <h2>掲示板のメニュー</h2>
            </section>

            <section class="section">

                <section class="section3">

                    <section class="kensaku">
                        <h3>記事の検索<span class="icon"><img src="{{asset('/assets/image/button-minus.png')}}" width="" height="" alt="" class="imgMinus"><img src="{{asset('/assets/image/button-plus.png')}}" width="" height="" alt="" class="imgPlus"></span></h3>
                    </section>

                    <section class="kensaku2">
                        <p class="setumei">次の項目を入力し、「検索」ボタンをクリックしてください。</p>
                        <form id="kensaku_form" action="find" method="post">
                            @csrf
                            <table class="table1">
                                <tr>
                                    <td><input type="text" name="kensaku_name">をメッセージに含む記事</td>
                                    <td></td>
                                </tr>
                            </table>
                            <input type="submit" value="検索">
                        </form>
                    </section>

                </section>

                <section class="section3">

                    <section class="kakikomi">
                        <h3>新規記事の書き込み<span class="icon"><img src="{{asset('/assets/image/button-minus.png')}}" width="" height="" alt="" class="imgMinus"><img src="{{asset('/assets/image/button-plus.png')}}" width="" height="" alt="" class="imgPlus"></span></h3>
                    </section>

                    <section class="kakikomi2">
                        <p class="setumei">次の項目を入力し、「書き込む」ボタンをクリックしてください。</p>
                        <form id="kakikomi_form" action="insert" method="post">
                            @csrf
                            <table class="table1">
                                <tr>
                                    <td>お名前</td>
                                    <td><input type="text" name="kakikomi_name" required></td>   
                                </tr>
                                <tr>
                                    <td>カテゴリ</td>
                                    <td>
                                        <select class="parent" name="級" required>
                                         <option value="" class="msg" disabled selected>-----級を選択-----</option>
                                         <option value="１級">１級</option>
                                         <option value="２級">２級</option>
                                         <option value="３級">３級</option>
                                        </select>
                                    </td>   
                                </tr>
                                <tr>
                                    <td>サブカテゴリ</td>
                                    <td>
                                        <select class="children" name="科目" disabled required>
                                         <option value="" class="msg" disabled selected>-----科目を選択-----</option>
                                         <option value="商業簿記" data-val="１級">商業簿記</option>
                                         <option value="商業簿記" data-val="２級">商業簿記</option>
                                         <option value="商業簿記" data-val="３級">商業簿記</option>
                                         <option value="会計学" data-val="１級">会計学</option>
                                         <option value="工業簿記" data-val="１級">工業簿記</option>
                                         <option value="工業簿記" data-val="２級">工業簿記</option>
                                         <option value="原価計算" data-val="１級">原価計算</option>
                                        </select>
                                    </td>   
                                </tr>
                                <tr>
                                    <td>メッセージ</td>
                                    <td><textarea name="message" rows="3" cols="50" required></textarea></td>   
                                </tr>
                            </table>
                            <input type="submit" value="書き込む">
                        </form>
                    </section>

                </section>

                <section class="section3">

                    <section class="sakujo">
                        <h3>記事の削除（管理者専用）<span class="icon"><img src="{{asset('/assets/image/button-minus.png')}}" width="" height="" alt="" class="imgMinus"><img src="{{asset('/assets/image/button-plus.png')}}" width="" height="" alt="" class="imgPlus"></span></h3>
                    </section>

                    <section class="sakujo2">
                        <p class="setumei">次の項目を入力し、「削除」ボタンをクリックしてください。</p>
                        <form id="sakujo_form" action="delete" method="post">
                            <table class="table1">
                                @csrf
                                <tr>
                                    <td>記事のID</td>
                                    <td><input type="number" name="id" required></td>
                                </tr>
                                <tr>
                                    <td>管理パスワード</td>
                                    <td><input type="password" name="password" required pattern="^([a-zA-Z0-9]{6,8})$" title="半角英数字４文字以上８文字以下でご入力ください。" class="passWord"></td>
                                </tr>
                                <tr> 
                                    <td></td>
                                    <td><input type="checkbox" name="pass_hyoji" value="" class="passHyoji">パスワードの表示</td>
                                </tr>
                            </table>
                            <input type="submit" value="削除">
                        </form>
                    </section>

                </section>

            </section>

            <section class="section">
                <h2>記事一覧</h2>
            </section>
            
            <h2 class="kensaku_nasi">{{ session('result') }}</h2>

            <section class="section">

                    @if(!empty($message))
                        @if($message == "なし")
                            <p>検索条件：{{$message}}</p>
                        @else
                            <p>検索条件：メッセージに<u>{{$message}}</u>を含む記事</p>
                        @endif
                    @endif  

            </section>

            <section class="section">
                
                @if($bbss == "[]")
                   <h2 class='kensaku_nasi'> {{"検索条件に一致する記事はありません"}}</h2>
                @else
                    <table border='1' class='table2'>
                    <tr><th class='th1'>ID</th><th class='th2'>投稿日時</th><th class='th3'>お名前</th><th class='th4'>カテゴリ</th><th class='th5'>サブカテゴリ</th><th class='th6'>メッセージ</th></tr>
                   @foreach ($bbss as $bbs)
                       <tr>
                           <td>{{$bbs->id}}</td>
                           <td>{{$bbs->date}}</td>
                           <td>{{$bbs->name}}</td>
                           <td>{{$bbs->category}}</td>
                           <td>{{$bbs->subCategory}}</td>
                           <td>{{$bbs->message}}</td>
                       </tr>
                   @endforeach
                    </table>
                @endif
            
            </section>

        </section>

    </main>

    <footer id="footer">

        <section class="wrapper">

            <section class="section2">
            <a href="/index"><img src="{{asset('/assets/image/f-logo.png')}}" width="" height="" alt="f_logo" class="imgL"></a>
            </section>
            
            <section class="section2">
                <p class="otoiawase"><a href="#">お問い合わせ</a></p>
            </section>

            <section class="section2">
                <ul class="list">
                    <li class="list2"><a href="#">学校の紹介はこちら</a></li>
                    <li class="list2"><a href="#">利用規約</a></li>
                    <li class="list2"><a href="#">個人情報保護方針</a></li> 
                </ul>
            </section>

            <section class="section2">
                <p class="rights"><small>©CPA All Rights Reserved</small></p>
            </section>

        </section>

    </footer>

    <script src="{{secure_asset('/assets/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{secure_asset('/assets/js/bbs.js')}}"></script>

</body>

</html>