<?php
//バリデーション処理 全角スペースを含んだtrim()
function mbTrim($str)
{
  return preg_replace('/\A[\x00\s]++|[\x00\s]++\z/u', '', $str);
}
