<?php

namespace Src\Controller;

class Controller
{
    protected function loadView($viewName, $data = null)
    {
        if ($data != null) extract($data);
        require_once __DIR__ . "/../../view/$viewName.php";
    }
}