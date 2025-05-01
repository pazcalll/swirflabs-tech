<?php

namespace Src\Validation;

use Src\Model\Employee;

class EmployeeRequest extends Request implements \JsonSerializable
{
    public function __construct(
        private $name = null,
        private $identificationNumber = null,
        private $address = null,
        private $occupation = null,
        private $place = null,
        private $dateOfBirth = null,
    ) {}

    public function validate(): void
    {
        $rules = [
            'name' => [
                'required',
                'lengthMax' => 80,
                'lengthMin' => 3,
            ],
            'identificationNumber' => [
                'required',
                'lengthMax' => 32,
                'lengthMin' => 3,
            ],
            'address' => [
                'required',
                'lengthMax' => 255,
            ],
            'occupation' => [
                'required',
                'within' => Employee::OCCUPATIONS,
            ],
            'place' => [
                'required',
                'lengthMax' => 80,
                'lengthMin' => 3,
            ],
            'dateOfBirth' => [
                'required',
                'date',
            ],
        ];

        $this->validateRules(
            $this->jsonSerialize(),
            $rules
        );
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getIdentificationNumber(): string
    {
        return $this->identificationNumber;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getOccupation(): string
    {
        return $this->occupation;
    }

    public function getPlace(): string
    {
        return $this->place;
    }

    public function getDateOfBirth(): string
    {
        return $this->dateOfBirth;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'name' => $this->name,
            'identificationNumber' => $this->identificationNumber,
            'address' => $this->address,
            'occupation' => $this->occupation,
            'place' => $this->place,
            'dateOfBirth' => $this->dateOfBirth,
        ];
    }
}