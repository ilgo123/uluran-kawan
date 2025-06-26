<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCampaignRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'target_amount' => 'sometimes|integer|min:1',
            'collected_amount' => 'sometimes|integer|min:0',
            'start_date' => 'sometimes|date',
            'end_date' => 'sometimes|date|after:start_date',
        ];
    }
}