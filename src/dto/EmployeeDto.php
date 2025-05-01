<?php

namespace Src\Dto;

class EmployeeDto implements \JsonSerializable
{
    private
        $name,
        $identificationNumber,
        $address,
        $occupation,
        $place,
        $dateOfBirth
    ;

    public function __construct(
        $name = null,
        $identificationNumber = null,
        $address = null,
        $occupation = null,
        $place = null,
        $dateOfBirth = null,
    )
    {
        $this->name = $name;
        $this->identificationNumber = $identificationNumber;
        $this->address = $address;
        $this->occupation = $occupation;
        $this->place = $place;
        $this->dateOfBirth = $dateOfBirth;
    }


    public function getName()
    {
        return $this->name;
    }

    public function getIdentificationNumber()
    {
        return $this->identificationNumber;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getOccupation()
    {
        return $this->occupation;
    }

    public function getPlace()
    {
        return $this->place;
    }

    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setIdentificationNumber($identificationNumber)
    {
        $this->identificationNumber = $identificationNumber;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function setOccupation($occupation)
    {
        $this->occupation = $occupation;
    }

    public function setPlace($place)
    {
        $this->place = $place;
    }

    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;
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