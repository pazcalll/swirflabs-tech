<?php

use Src\Controller\Api\EmployeeController;

return [
    '/employee' => ['GET', EmployeeController::class, 'index'],
    '/employee/store' => ['POST', EmployeeController::class, 'store'],
];