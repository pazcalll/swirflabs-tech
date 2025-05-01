<?php

namespace Src\Controller;

use Src\Component\Php\Alert;
use Src\Connection\Database;
use Src\Service\EmployeeService;

class EmployeeController extends Controller
{
    private $employeeService;
    
    public function __construct()
    {
        $this->employeeService = new EmployeeService();
    }

    public function index()
    {
        $data = $this->employeeService->getAllEmployees();
        $this->loadView('index', [
            'employees' => $data,
        ]);
    }

    public function store($data)
    {
        $db = Database::getInstance()->getConnection();
        try {
            $db->beginTransaction();
            $this->employeeService->storeEmployee($data);
            $alert = new Alert(Alert::TYPE_SUCCESS, 'Employee created successfully!');
            $db->commit();
        } catch (\Throwable $th) {
            $db->rollBack();
            $alert = new Alert(Alert::TYPE_ERROR, 'Failed to create employee: ' . $th->getMessage());
        }

        redirect('/', [
            'alert' => $alert,
        ]);
    }
}