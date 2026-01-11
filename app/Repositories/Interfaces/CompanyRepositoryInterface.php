<?php

namespace App\Repositories\Interfaces;

interface CompanyRepositoryInterface
{
    public function getAllCompanies();
    public function createCompany(array $data);
    public function updateCompany(int $id, array $data);
    public function deleteCompany(int $id);
}