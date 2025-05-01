<?php

namespace Src\Controller\Api;

use Src\Connection\Database;
use Src\Service\EmployeeService;

class EmployeeController extends Api
{
    private $employeeService;
    
    public function __construct()
    {
        $this->employeeService = new EmployeeService();
    }

    public function index()
    {
        $data = $this->employeeService->getAllEmployees();
        $this->jsonResponse(['employee' => $data]);
    }

    public function store($data)
    {
        $db = Database::getInstance()->getConnection();
        try {
            $db->beginTransaction();
            $this->employeeService->storeEmployee($data);
            $db->commit();
        } catch (\Throwable $th) {
            $db->rollBack();
            $this->jsonResponse([
                'message' => 'Failed to create employee: ' . $th->getMessage(),
            ], 400);
        }

        $this->jsonResponse([
            'message' => 'Employee created successfully!',
        ], 201);
    }
}