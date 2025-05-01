<?php

use Src\Controller\EmployeeController;

return [
    '/' => ['GET', EmployeeController::class, 'index'],
    '/employee/store' => ['POST', EmployeeController::class, 'store'],
];