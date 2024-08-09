<?php

require_once dirname(__FILE__) . "/dbconnect.php";

/**
 * エスケープ処理
 * @param string $str 対象の文字列
 * @return string 処理された文字列
 */
function h($str) {
    if($str) {
        return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
    } else {
        return NULL;
    }
}

/**
 * ワンタイムトークンをセットする
 * @param void
 * @return string 生成したトークン
 */
function setToken() {
    return $_SESSION["token"] = bin2hex(random_bytes(32));
}

/**
 * 正しいフォームから送られた情報かを確認する
 * @param string token 送られてきたトークン
 * @return bool 不正なアクセスかどうかの結果
 */
function validateToken($token) {
    if(
        empty($_SESSION["token"]) ||
        $_SESSION["token"] !== filter_input(INPUT_POST, "token")
    ) {
        return false;
    }
    removeToken();
    return true;
}

/**
 * セッションのトークンを削除する
 * @param void
 * @return void
 */
function removeToken() {
    unset($_SESSION["token"]);
}