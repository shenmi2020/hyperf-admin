<?php

/**
 * 生成随机字符串
 */
function randStr($length = 6)
{
    $str = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 
        'i', 'j', 'k', 'l','m', 'n', 'o', 'p', 'q', 'r', 's', 
        't', 'u', 'v', 'w', 'x', 'y','z', 'A', 'B', 'C', 'D', 
        'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L','M', 'N', 'O', 
        'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y','Z', 
        '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
    $random_keys = array_rand($str, $length);
    $random_strs = '';
    for($i = 0; $i < $length; $i++)
    {
        $random_strs .= $str[$random_keys[$i]];
    }

    return $random_strs;
}

/**
 * 生成token
 */
function genToken()
{
    $str = md5(uniqid(mt_rand().mt_rand(), true));
    return $str;
}