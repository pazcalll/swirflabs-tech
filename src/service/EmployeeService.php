<?php

namespace Src\Service;

use Src\Dto\EmployeeDto;
use Src\Model\Employee;
use Src\Validation\EmployeeRequest;

class EmployeeService
{
    private Employee $employeeModel;
    private EmployeeRequest $employeeRequest;
    private EmployeeDto $employeeDto;

    public function __construct()
    {
        $this->employeeModel = new Employee();
        $this->employeeRequest = new EmployeeRequest();
        $this->employeeDto = new EmployeeDto();
    }

    public function getEmployeeModel()
    {
        return $this->employeeModel;
    }

    public function setEmployeeModel($employeeModel): static
    {
        $this->employeeModel = $employeeModel;
        return $this;
    }

    public function getEmployeeRequest()
    {
        return $this->employeeRequest;
    }

    public function setEmployeeRequest($employeeRequest): static
    {
        $this->employeeRequest = $employeeRequest;
        return $this;
    }

    public function getEmployeeDto()
    {
        return $this->employeeDto;
    }

    public function setEmployeeDto($employeeDto): static
    {
        $this->employeeDto = $employeeDto;
        return $this;
    }

    /**
     * @return EmployeeDto[]
     */
    public function getAllEmployees(): array
    {
        $stmt = $this->employeeModel->getAllEmployees();
        $employees = [];

        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $employees[] = new EmployeeDto(
                $row['name'],
                $row['identificationNumber'],
                $row['address'],
                $row['occupation'],
                $row['place'],
                $row['dateOfBirth'],
            );
        }

        return $employees;
    }

    public function getEmployeeById($id): EmployeeDto
    {
        $stmt = $this->employeeModel->getEmployeeById($id)->fetch(\PDO::FETCH_ASSOC);
        return new EmployeeDto(
            $stmt['name'],
            $stmt['identificationNumber'],
            $stmt['address'],
            $stmt['occupation'],
            $stmt['place'],
            $stmt['dateOfBirth'],
        );
    }

    public function storeEmployee(array $data): EmployeeDto
    {
        $this->employeeRequest = new EmployeeRequest(
            $data['name'],
            $data['identificationNumber'],
            $data['address'],
            $data['occupation'],
            $data['place'],
            $data['dateOfBirth']
        );

        $this->employeeRequest->validate();

        $this->employeeDto = new EmployeeDto(
            $this->employeeRequest->getName(),
            $this->employeeRequest->getIdentificationNumber(),
            $this->employeeRequest->getAddress(),
            $this->employeeRequest->getOccupation(),
            $this->employeeRequest->getPlace(),
            $this->employeeRequest->getDateOfBirth(),
        );

        $this->employeeModel->storeEmployee($this->employeeDto);

        return $this->employeeDto;
    }
}