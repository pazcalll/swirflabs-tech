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
        $query = "SELECT * FROM " . $this->table . " ORDER BY createdAt DESC";
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
            . " (name, identificationNumber, address, occupation, place, dateOfBirth, createdAt)"
            . " VALUES (:name, :identificationNumber, :address, :occupation, :place, :dateOfBirth, :createdAt)";
        $stmt = $this->conn->prepare($query);
        
        // Assign function calls to variables before using them
        $name = @$employeeDto->getName();
        $identificationNumber = @$employeeDto->getIdentificationNumber();
        $address = @$employeeDto->getAddress();
        $occupation = @$employeeDto->getOccupation();
        $place = @$employeeDto->getPlace();
        $dateOfBirth = @$employeeDto->getDateOfBirth();
        $createdAt = date('Y-m-d H:i:s');

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':identificationNumber', $identificationNumber);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':occupation', $occupation);
        $stmt->bindParam(':place', $place);
        $stmt->bindParam(':dateOfBirth', $dateOfBirth);
        $stmt->bindParam(':createdAt', $createdAt);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}