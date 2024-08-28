<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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

        // Base rules that apply to all requests
        $rules = [
            'form_type' => 'required|in:personal_details,bank_details',
        ];

        // Extend base rules with form-specific rules
        if ($formType === 'personal_details') {
            $rules = array_merge($rules, [
                'user_id' => 'required|exists:users,id',
                'phoneNo' => 'required|unique:instructor_profile_details,phoneNo',
                'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'contactAddress' => 'required',
                'state' => 'required',
                'postalCode' => 'nullable',
                'dob' => 'required|date_format:d/m/Y',
                'doj' => 'required|date_format:d/m/Y',
                'dot' => 'nullable|date_format:d/m/Y',
                'drivingExpirence' => 'required',
                'bloodGroupId' => 'required|exists:blood_groups,id',
                'genderId' => 'required|exists:genders,id',
            ]);
        } elseif ($formType === 'bank_details') {
            $rules = array_merge($rules, [
                'user_id' => 'required|exists:users,id',
                'salaryPayModeId' => 'required|exists:salary_pay_modes,id',
                'salaryBankName' => 'required',
                'salaryBranchName' => 'required',
                'salaryIFSCCode' => 'required',
                'salaryAccountNumber' => 'required',
                'postalCode' => 'nullable',
                'state' => 'required',
            ]);
        }

        return $rules;
    }
}
