<?php




function enc($id)
{
    $secure = str_replace("=", "", base64_encode(($id * 2.5) * 2567));
    return $secure;
}

function denc($id)
{
    $unsecure = (base64_decode($id) / 2.5) / 2567;
    return $unsecure;
}
