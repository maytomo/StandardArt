<?php
function hashPassword($password)
{
    $salt = bin2hex(mcrypt_create_iv(32,MCRYPT_DEV_URANDOM));
    $hash = hash("sha256",$salt.$password);
    return $salt.$hash;
}
function validatePassword($password, $hash)
{
    $salt = substr($hash, 0, 64);
    $valid = substr($hash, 64, 64);
    $test = hash("sha256", $salt.$password);
    return $test === $valid;
}
?>
