<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Models\Website;
use Illuminate\Foundation\Http\FormRequest;

class SubscribeWebsiteRequst extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge([
            'websites_website_id' => $this->route('website'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'websites_website_id' => 'required|integer|exists:websites,website_id',
            'users_user_id'       => 'required|integer|exists:users,user_id',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $website = Website::find($this->offsetGet('websites_website_id'));
            $user = User::find($this->offsetGet('users_user_id'));

            if ($website->users->contains($user)) {
                $validator->errors()->add('users_user_id', 'User already subscribed to this website');
            }
        });
    }
}
