<?php


function genid($length = 16, $splitEvery = -1)
{
    if ($splitEvery == 0) $splitEvery = floor($length / 2);
    $__characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    $__characters_count = count(str_split($__characters));
    $result = "";

    $iter = 0;

    for ($i = 0; $i < $length; $i++, $iter++) {
        $result = $result . $__characters[random_int(0, $__characters_count - 1)];

        if ($iter == -1) continue;
        if ($iter == $splitEvery) {
            $result = $result . "-";
            $iter = 0;
        }
    }

    return $result;
}

function generateToken($length = 20)
{
    return bin2hex(random_bytes($length));
}