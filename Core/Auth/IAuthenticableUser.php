<?php

interface IAuthenticable
{
    public static function findUserByLogin($username, $hashedPassword);
    public static function findUserById($template);
}
