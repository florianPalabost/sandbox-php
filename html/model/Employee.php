<?php

class Employee
{

    public function __construct(private int $employeeNumber, )
    {
    }

    /**
     * @return int
     */
    public function getEmployeeNumber()
    {
        return $this->employeeNumber;
    }

    /**
     * @param int $employeeNumber
     */
    public function setEmployeeNumber($employeeNumber)
    {
        $this->employeeNumber = $employeeNumber;
    }


}