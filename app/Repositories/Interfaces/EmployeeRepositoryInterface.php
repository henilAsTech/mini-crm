<?php

namespace App\Repositories\Interfaces;

interface EmployeeRepositoryInterface {
    public function getAllEmployees();
    public function createEmployee(array $data);
    public function updateEmployee(int $id, array $data);
    public function deleteEmployee(int $id);
}