<?php

namespace App\Imports;

use App\Models\Service;
use App\Models\Category;
use Illuminate\Validation\Rule;
use App\Api\Helpers\HashIdHelper;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ServicesImport implements ToModel, WithHeadingRow, WithValidation
{
    use Importable;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if (!array_filter($row)) {
            return null;
        }

        $data = [
            'name'  => $row['name'],
            'amount'    => $row['amount'],
            'id_hash' => HashIdHelper::generateId(),
            'business_id' => session('business_id'),
        ];

        if (!empty($row['category']))
            $data['category_id'] = Category::where('name', $row['category'])->first()->id;


        return new Service($data);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => [
                'nullable', 'string', 'max:255',
                Rule::unique('services')->where(function ($query) {
                    return $query->where('deleted_at', null);
                })
            ],
            'amount' => 'nullable|regex:/^[0-9]{1,12}(\.[0-9]{0,2})?$/',
            'category' => 'nullable|exists:categories,name',
        ];
    }
}
