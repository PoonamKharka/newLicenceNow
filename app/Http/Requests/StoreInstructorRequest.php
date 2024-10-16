<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule; 

class StoreInstructorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Ensure this is set to true or adjust according to your authorization logic
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $formType = $this->input('form_type');
        $userId = $this->input('user_id');

        // Base rules that apply to all requests
        $rules = [
            'form_type' => 'required|in:personal_details,vehicle_details,suburbs_details,bank_details,price_details',
        ];

        // Extend base rules with form-specific rules
        if ($formType === 'personal_details') {
            
            $rules = array_merge($rules, [
                'user_id' => 'required|exists:users,id',
                'phoneNo' => [
                    'required',
                    Rule::unique('instructor_profile_details')->ignore($userId, 'user_id'), // Ignore current user's phone number during update
                ],
                //'profile_picture' => 'image|mimes:jpeg,png,jpg|max:2048',
                'isAuto' => 'required_without:isManual',
                'isManual' => 'required_without:isAuto',
                'driving_expirence' => 'required'
            ]);
        } elseif ($formType === 'bank_details') {
            $rules = array_merge($rules, [
                'user_id' => 'required|exists:users,id',
                'salaryPayModeId' => [
                    'required',
                    Rule::exists('salary_pay_modes', 'id')
                ],
                //'salaryPayModeId' => 'required|exists:salary_pay_modes,id',
                'salaryBankName' => 'required',
                'salaryBranchName' => 'required',
                'salaryIFSCCode' => 'required',
                'salaryAccountNumber' => 'required|string|regex:/^\d+$/|max:20',
            ]);
        }

        return $rules;
    }
}