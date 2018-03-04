<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\checkAge;


class OperatorRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {

        switch($this->method())
        {
            case 'POST':
            {
                return [
                    'lastName' => 'required|alpha_dash|max:35',
                    'firstName' => 'required|alpha_dash|max:35',
                    'middleName' => 'required|alpha_dash|max:35',
                    'contactNumber' => 'digits:10',
                    'address' => 'required|max:100',
                    'provincialAddress' => 'required|max:100',
                    'birthDate' => ['required','date_format:m/d/Y','after:1/1/1918', new checkAge],
                    'birthPlace' => 'alpha|required|max:50',
                    'gender' => [
                        'required',
                        Rule::in(['Male', 'Female'])
                    ],
                    'citizenship' => 'alpha|required|max:35',
                    'civilStatus' => [
                        'required',
                        Rule::in(['Single', 'Married', 'Divorced']) 
                    ],
                    'nameOfSpouse' => 'alpha_dash|required_with:spouseBirthDate|max:120',
                    'spouseBirthDate' => 'required_with:nameOfSpouse|nullable|date|before:today',
                    'fathersName' => 'alpha_dash|required_with:fatherOccupation|max:120',
                    'fatherOccupation' => 'required_with:fathersName|max:50',
                    'mothersName' => 'alpha_dash|required_with:motherOccupation|max:120',
                    'motherOccupation' => 'required_with:mothersName|max:50',
                    'contactPerson' => 'alpha_dash|required|max:120',
                    'contactPersonAddress' => 'required|max:50',
                    'contactPersonContactNumber' => 'required|digits:10',
                    'sss' => 'unique:member,SSS|required|max:10',
                    'licenseNo' => 'required_with:licenseExpiryDate|max:20',
                    'licenseExpiryDate' => 'required_with:licenseNo|nullable|date|after:today',
                    'children.*' => 'required_with:childrenBDay.*|distinct',
                    'childrenBDay.*' => 'required_with:children.*|nullable|date|before:tomorrow'
                ];
            }
            case 'PATCH':
            {
//                dd($this->all());
                    return [
                        'lastName' => 'required|alpha_dash|max:35',
                        'firstName' => 'required|alpha_dash|max:35',
                        'middleName' => 'required|alpha_dash|max:35',
                        'contactNumber' => 'digits:10',
                        'address' => 'required|max:100',
                        'provincialAddress' => 'required|max:100',
                        'birthDate' => ['required','date_format:m/d/Y','after:1/1/1918', new checkAge],
                        'birthPlace' => 'alpha|required|max:50',
                        'gender' => [
                            'required',
                            Rule::in(['Male', 'Female'])
                        ],
                        'citizenship' => 'alpha|required|max:35',
                        'civilStatus' => [
                            'required',
                            Rule::in(['Single', 'Married', 'Divorced'])
                        ],
                        'nameOfSpouse' => 'alpha_dash|required_with:spouseBirthDate|max:120',
                        'spouseBirthDate' => 'required_with:nameOfSpouse|nullable|date|before:today',
                        'fathersName' => 'alpha_dash|required_with:fatherOccupation|max:120',
                        'fatherOccupation' => 'required_with:fathersName|max:50',
                        'mothersName' => 'alpha_dash|required_with:motherOccupation|max:120',
                        'motherOccupation' => 'required_with:mothersName|max:50',
                        'contactPerson' => 'alpha_dash|required|max:120',
                        'contactPersonAddress' => 'required|max:50',
                        'contactPersonContactNumber' => 'required|digits:10',
                        'sss' => 'unique:member,SSS,'.$this->route('operator')->member_id.',member_id|required|max:10',
                        'licenseNo' => 'required_with:licenseExpiryDate|max:20',
                        'licenseExpiryDate' => 'required_with:licenseNo|nullable|date|after:today',
                        'children.*' => 'required_with:childrenBDay.*|distinct',
                        'childrenBDay.*' => 'required_with:children.*|nullable|date|before:tomorrow'
                    ];

            }
            default:break;
        }
    }
}
