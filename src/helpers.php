<?php

if (!function_exists('redirect')) {
    function redirect($url, $sessions = [])
    {
        foreach ($sessions as $key => $session) {
            $_SESSION[$key] = $session;
        }

        header("Location: $url");
        exit;
    }
}