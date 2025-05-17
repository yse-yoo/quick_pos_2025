<?php
// env.php の読み込み
require_once "env.php";

// パス設定
const BASE_DIR = __DIR__;
const APP_DIR = __DIR__ . "/app/";
const LIB_DIR = __DIR__ . "/lib/";
const MODEL_DIR = APP_DIR . "models/";
const COMPONENT_DIR = APP_DIR . "components/";

// BASE_URL を定義（常にルートからの相対パス）
define('BASE_URL', getBaseUrl());

// ライブラリの読み込み
require_once LIB_DIR . "Database.php";

// モデルの読み込み
require_once MODEL_DIR . "Sales.php";
require_once MODEL_DIR . "Product.php";

// セッションスタート
session_start();
session_regenerate_id(true);

// BASE_URL を動的に取得
function getBaseUrl()
{
    $basePath = str_replace(
        str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT'])),
        '',
        str_replace('\\', '/', __DIR__)
    );
    // BASE_URL を定義（常にルートからの相対パス）
    return rtrim($basePath, '/') . '/';
}
