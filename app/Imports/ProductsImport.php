<?php

namespace App\Imports;

use App\Api\Helpers\HashIdHelper;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Validation\Rule;

class ProductsImport implements ToModel, WithHeadingRow, WithValidation
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
            'selling_price'    => $row['selling_price'],
            'quantity'    => $row['quantity'],
            'cost_price'    => $row['cost_price'],
            'stock_threshold'    => $row['stock_threshold'],
            'location'    => @$row['location'],
            'id_hash' => HashIdHelper::generateId(),
            'business_id' => session('business_id'),
        ];
        if (!empty($row['expiry_date']))
            $data['expiry_date'] = Carbon::parse($row['expiry_date'])->toDateString();

        if (!empty($row['category']))
            $data['category_id'] = Category::where('name', $row['category'])->first()->id;


        return new Product($data);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => [
                'string', 'max:255', 'nullable',
                Rule::unique('products')->where(function ($query) {
                    return $query->where('deleted_at', null);
                })
            ],
            'quantity' => 'numeric|min:0|nullable',
            'cost_price' => 'nullable|regex:/^[0-9]{1,12}(\.[0-9]{0,2})?$/',
            // 'selling_price' => 'regex:/^[0-9]{1,12}(\.[0-9]{0,2})?$/|gte:cost_price',
            'stock_threshold' => 'min:0|nullable',
            'expiry_date' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'category' => 'nullable|exists:categories,name',
        ];
    }
}
