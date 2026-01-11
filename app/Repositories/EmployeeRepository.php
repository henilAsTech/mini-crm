<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Repositories\Interfaces\EmployeeRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class EmployeeRepository implements EmployeeRepositoryInterface 
{
    protected $modelName;

    public function __construct()
    {
        $this->modelName = new Employee();
    }

    public function getAllEmployees()
    {
        return $this->modelName->orderBy('id', 'desc')->paginate(10);
    }

    public function createEmployee(array $data)
    {
        if(isset($data['profile_picture'])) {
            $data['profile_picture'] = $this->storeProfilePicture($data['profile_picture']);
        }
        return $this->modelName->create($data);
    }

    public function updateEmployee(int $id, array $data)
    {
        $employee = $this->modelName::findOrFail($id);
        if(isset($data['profile_picture'])) {
            $data['profile_picture'] = $this->storeProfilePicture($data['profile_picture']);
        }
        $employee->update($data);
        return $employee;
    }

    public function deleteEmployee(int $id)
    {
        $employee = $this->modelName::findOrFail($id);
        return $employee->destroy($id);
    }

    protected function storeProfilePicture($image)
    {
        if ($image) {
            $imagePath = public_path('employee');
            if (!file_exists($imagePath)) {
                mkdir($imagePath, 0755, true);
            }

            $imageName = md5(time().'_'.$image->getClientOriginalName()). '.' . $image->getClientOriginalExtension();

            Storage::disk('public')->putFileAs(
                'employee',
                $image,
                $imageName
            );
            return $imageName;
        }
        return null;
    }
}