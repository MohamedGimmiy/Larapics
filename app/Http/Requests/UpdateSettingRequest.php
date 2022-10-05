<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'social.*' => 'nullable|url',
            'options.disable_comments' => 'boolean',
            'options.moderate_comments' => 'boolean',
            'options.email_notification.*' => 'nullable'

        ];
    }
    public function attributes()
    {
        return [
            'social.facebook' => 'facebook',
            'social.twitter' => 'twitter',
            'social.website' => 'website',
            'social.instagram' => 'instagram',
        ];
    }
    public function getData()
    {
        return $this->validated();
    }
}
