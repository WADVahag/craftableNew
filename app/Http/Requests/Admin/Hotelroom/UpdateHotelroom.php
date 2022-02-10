<?php

namespace App\Http\Requests\Admin\Hotelroom;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateHotelroom extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.hotelroom.edit', $this->hotelroom);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string'],
            'newcustomers' => ['sometimes'],
        ];
    }

    public function getNewcustomers(): array
    {
        if ($this->has('newcustomers')) {
            $newcustomers = $this->get('newcustomers');
            return array_column($newcustomers, 'id');
        }
        return [];
    }


    /**
     * Modify input data
     *
     * @return array
     */
    public function getSanitized(): array
    {
        $sanitized = $this->validated();


        //Add your code for manipulation with request data here

        return $sanitized;
    }
}
