<?php

namespace App\Repositories;

use App\Models\Company;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class CompanyRepository implements CompanyRepositoryInterface
{
    protected $modelName;

    public function __construct()
    {
        $this->modelName = new Company();
    }

    public function getAllCompanies()
    {
        return $this->modelName::orderBy('name', 'asc')->get();
    }

    public function getCompaniesWithPaginate()
    {
        return $this->modelName::orderBy('id', 'desc')->paginate(10);
    }

    public function createCompany(array $data)
    {
        if (isset($data['logo'])) {
            $data['logo'] = $this->storeImage($data['logo']);
        }
        return $this->modelName::create($data);
    }

    public function updateCompany(int $id, array $data)
    {
        $company = $this->modelName::findOrFail($id);

        if (isset($data['logo'])) {
            if ($company->logo) {
                Storage::disk('public')->delete('logos/'.$company->logo);
            }
            $data['logo'] = $this->storeImage($data['logo']);
        }
        $company->update($data);
        return $company;
    }

    public function deleteCompany(int $id)
    {
        $company = $this->modelName::findOrFail($id);
        if ($company->logo) {
            Storage::disk('public')->delete('logos/'.$company->logo);
        }
        return $company->delete();
    }

    protected function storeImage($image)
    {
        if ($image) {
            $imagePath = public_path('logos');
            if (!file_exists($imagePath)) {
                mkdir($imagePath, 0755, true);
            }

            $imageName = md5(time().'_'.$image->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();
            
            Storage::disk('public')->putFileAs(
                'logos',
                $image,
                $imageName
            );
            return $imageName;
        }
        return null;
    }
}