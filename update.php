<?php
// 共通ファイル読み込み
require_once "app.php";

// POSTチェック
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit;
}

// データを挿入する準備
$sales = new Sales();
$sales->price = $_POST['price'];

// TODO: validate in SalesService

// サービスを使って挿入
$salesService = new SalesService();
$result = $salesService->insert($sales);

// 結果をチェック
if ($result) {
    // 成功メッセージをセッションに保存
    $_SESSION['message'] = '計上しました';
} else {
    // エラーメッセージをセッションに保存
    $_SESSION['message'] = '計上に失敗しました';
}

// トップにリダイレクト
header('Location: ./');