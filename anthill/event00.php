<?php
// 表題
$title = 'サンプルイベント参加登録';
// 状態 ( prepared: 準備中, active: 受付中, closed: 受付終了 )
$status = 'active';
// イベントの情報を掲載したURL
$url = 'https://example.com/event00/index.html';
// 自動送信メールアドレス ※迷惑メールとされることを防ぐため、設置するサーバのドメインのアドレスを使うこと。
$from = 'noreply@example.com';
// 登録受付メール文面
$reply = <<<END
サンプルイベントの参加登録ありがとうございました。
参加者向けの資料はこちらをご参照ください。
https://example.com/event00/program.html

また、参加登録は以下の内容で受け付けました。
登録内容に修正、取り消しがある場合は、参加登録の再入力をお願いします。
END;
// 表示項目・入力項目
$items = [
  [
    'type' => 'message',
    'label' => <<<END
サンプルイベント ( 1/23 10:00 〜 )
オンライン開催・参加無料です。
登録いただいた方に後日、参加（接続）方法のご案内をお送りします。
END,
  ],
  [
    'type' => 'message',
    'label' => <<<END
メールアドレスは @example.com からのメールを受信できるアドレスとしてください。
登録受付後に、記入していただいたメールアドレス宛に受け付けた内容を自動でお送りします。
END,
  ],
  [
    'type' => 'email',
    'label' => 'Email',
    'name' => 'email',
    'required' => true,
  ],
  [
    'type' => 'text',
    'label' => '氏名',
    'name' => 'name',
    'required' => true,
  ],
  [
    'type' => 'radio',
    'label' => '性別',
    'name' => 'gender',
    'required' => false,
    'options' => [
      '男性',
      '女性',
      'その他',
      'わからない・答えたくない',
    ],
  ],
  [
    'type' => 'radio',
    'label' => '年齢',
    'name' => 'age',
    'required' => false,
    'options' => [
      '10歳代',
      '20歳代',
      '30歳代',
      '40歳代',
      '50歳代',
      '60歳以上',
      '答えたくない',
    ],
  ],
  [
    'type' => 'message',
    'label' => <<<END
希望者に印刷した資料を郵送します。送料込み1,240円を添付の振り込み用紙でお支払いください。
END,
  ],
  [
    'type' => 'checkbox',
    'label' => '資料の郵送を申し込む',
    'name' => 'book',
  ],
  [
    'type' => 'message',
    'label' => <<<END
資料の郵送を申し込みされた方は、お届け先住所を入力してください。
郵便番号と建物・部屋番号もご記載ください。
END,
  ],
  [
    'type' => 'textarea',
    'label' => '住所',
    'name' => 'address',
    'required' => false,
  ],
  [
    'type' => 'message',
    'label' => <<<END
このイベントの開催をどこで知りましたか？
※複数選択可
END,
  ],
  [
    'type' => 'checkbox',
    'label' => 'Webサイト',
    'name' => 'W',
  ],
  [
    'type' => 'checkbox',
    'label' => 'SNS',
    'name' => 'S',
  ],
  [
    'type' => 'checkbox',
    'label' => 'その他',
    'name' => 'O',
  ],
  [
    'type' => 'textarea',
    'label' => 'その他、ご質問やご意見があればお願いします。',
    'name' => 'message',
    'required' => false,
  ],
];
