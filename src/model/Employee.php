<?php

namespace Src\Model;

use Src\Connection\Database;
use Src\Dto\EmployeeDto;

class Employee
{
    private $conn;
    private $table = 'employees';

    final const OCCUPATION_UNEMPLOYED = 'unemployed';
    final const OCCUPATION_PROGRAMMER = 'programmer';
    final const OCCUPATION_DESIGNER = 'designer';
    final const OCCUPATION_ARCHITECT = 'architect';
    final const OCCUPATION_ARTIST = 'artist';
    final const OCCUPATIONS = [
        self::OCCUPATION_UNEMPLOYED,
        self::OCCUPATION_PROGRAMMER,
        self::OCCUPATION_DESIGNER,
        self::OCCUPATION_ARCHITECT,
        self::OCCUPATION_ARTIST,
    ];

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getAllEmployees()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getEmployeeById($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt;
    }

    public function storeEmployee(EmployeeDto $employeeDto)
    {
        $query = "INSERT INTO "
            . $this->table
            . " (name, identificationNumber, address, occupation, place, dateOfBirth)"
            . " VALUES (:name, :identificationNumber, :address, :occupation, :place, :dateOfBirth)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':name', $employeeDto->getName());
        $stmt->bindParam(':identificationNumber', $employeeDto->getIdentificationNumber());
        $stmt->bindParam(':address', $employeeDto->getAddress());
        $stmt->bindParam(':occupation', $employeeDto->getOccupation());
        $stmt->bindParam(':place', $employeeDto->getPlace());
        $stmt->bindParam(':dateOfBirth', $employeeDto->getDateOfBirth());

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}