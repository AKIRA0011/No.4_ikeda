<?php

// バリデーション処理 全角スペースを含んだtrim()
// 文字列の先頭、末尾にある空白、改行、タブなどを取り除く。(通常のtrim()に全角スペース対応させたもの）
function multibyteTrim($str)
{
  return preg_replace('/\A[\x00\s]++|[\x00\s]++\z/u', '', $str);
}
