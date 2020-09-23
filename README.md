## これはなに
自分用TOEIC単語帳

自分が欲しい機能を持った単語アプリが世になさそうだったので作った

## 使用言語等
- php, mysql, html, sass(scss), javascript(ES6)
- npm scriptでscssをコンパイル
- iOS/chrome(最新)のみを対象としているのでES6はコンパイルせず

## 主な機能
- 下記の登録、編集、削除  
  テストナンバー（カテゴリ）、例文、補足画像、補足テキスト
- 習熟度をはかるため、各例文に`OK`と`NG`ボタンを設置
- `NG`を押した回数が多いほどリスト上部、逆に`OK`を押した回数が多いとリスト下部へ移動  
- リストは`NG`数の降順に並ぶ