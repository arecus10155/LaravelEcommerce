<?php

namespace App\Http\Requests;

//Author:NG SE CHIAN

use App\Rules\UpperCase;
use Illuminate\Foundation\Http\FormRequest;

class Validation extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->getCustomRules($this->input('type'));
    }

    public function getCustomRules($type)
    {
        $rules = [];

        switch ($type) {

            case "StoreCategory":
                $rules = [
                    'category_name' => ['required', 'max:255', new Uppercase],
                ];
                break;
            case "StoreProduct":
                $rules = [
                    'product_code' => 'required|regex:/^[0-9][0-9]-[0-9][0-9]-[0-9][0-9]$/i',
                    'title' => 'required|regex:/^[a-zA-Z0-9 ]+$/i',
                    'price' => 'required|regex:/^[0-9]+$/i',
                    'category' => 'required|not_in:0',
                    'image' => 'required|image|mimes:jpg,png,jpeg',
                    'color' => 'required',
                    'quantity' => 'required|regex:/^[0-9]+$/i',
                ];
                break;
            case "EditProduct":
                $rules = [
                    'product_code' => 'required|regex:/^[0-9][0-9]-[0-9][0-9]-[0-9][0-9]$/i',
                    'title' => 'required|regex:/^[a-zA-Z0-9 ]+$/i',
                    'price' => 'required|regex:/^[0-9]+$/i',
                    'image' => 'image|mimes:jpg,png,jpeg',
                    'category' => 'required|not_in:0',
                    'color' => 'required',
                    'quantity' => 'required|regex:/^[0-9]+$/i',
                ];
                break;
            case "AddtoCart":
                $rules = [
                    'qty' => 'required',
                ];
                break;

            case "Payment":
                $rules = [
                    'name' => 'required|regex:/^[a-zA-Z0-9 ]+$/i',
                    'creditNum' => 'required|regex:/^[0-9]{16}+$/i',
                    'creditExp' => 'required|regex:/^[0-9][0-9]\/[0-9][0-9]$/i',
                    'creditCCV' => 'required|regex:/^[0-9][0-9][0-9]$/i',
                    'address' => 'required',
                    'city' => 'required|regex:/^[a-zA-Z0-9 ]+$/i',
                    'state' => 'required',
                    'zipCode' => 'required|regex:/^[0-9]+$/i',
                ];
                break;

            case "UpdateOrderProcess":
                $rules = [
                    'orderID' => 'required|regex:/^[a-zA-Z0-9 ]+$/i',
                    'orderStatus' => ['required', 'max:255', new Uppercase],
                ];
                break;
            case "CreateNewUser":
                $rules = [
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users',
                    'password' => 'required|string|min:8|regex:/(?=.[a-zA-Z])(?=.[0-9])/',
                    'roleID' => 'required',
                ];
                break;
        }

        return $rules;
    }



    public function messages(): array
    {

        $rules = [];

        switch ($this->input('type')) {

            case "StoreCategory":
                $rules = [
                    'category_name.required'  => ':attribute can not be empty.',
                ];
                break;
            case "StoreProduct":
                $rules = [
                    'product_code.required' => 'Please Input Product Code',
                    'product_code.regex' => 'Format:XX-XX-XX & numbers only',
                    'title.required' => 'Please input product title',
                    'title.regex' => 'Format:Should not contain special Characters',
                    'price.required' => 'Please input product price',
                    'price.regex' => 'Only numbers & Positive numbers',
                    'category.required' => 'Please select one category',
                    'image.required' => 'Please upload product image',
                    'image.image' => 'Image type only: jpg,png,jpeg',
                    'color.required' => 'Please set product colors',
                    'quantity.required' => 'Please set product quantity',
                    'quantity.regex' => 'Only numbers & Positive numbers',

                ];
                break;

            case "EditProduct":
                $rules = [
                    'product_code.required' => 'Please Input Product Code',
                    'product_code.regex' => 'Format:XX-XX-XX & numbers only',
                    'title.required' => 'Please input product title',
                    'title.regex' => 'Format:Should not contain special Characters',
                    'price.required' => 'Please input product price',
                    'price.regex' => 'Only numbers & Positive numbers',
                    'image.image' => 'Image type only: jpg,png,jpeg',
                    'category.required' => 'Please select one category',
                    'color.required' => 'Please set product colors',
                    'quantity.required' => 'Please set product quantity',
                    'quantity.regex' => 'Only numbers & Positive numbers',
                ];
                break;

            case "Payment":
                $rules = [
                    'name.regex' => 'Format:Should not contain special Characters',
                    'creditNum.regex' => 'Format:16 numbers',
                    'creditExp.regex' => 'Format:XX/XX',
                    'creditCCV.regex' => 'Format:3 numbers',
                    'city.regex' => 'Format:Should not contain special Characters',
                    'zipCode.regex' => 'Format:Only Numbers',
                ];
                break;

            case "UpdateOrderProcess":
                $rules = [
                    'orderID.require' => 'Invalid Order ID',
                    'orderID.regex' => 'Invalid Order ID',
                    'orderStatus.require' => 'Please Seelct An Order Status',
                    'orderStatus.regex' => 'Invalid Order Status',
                ];
                break;
                
            case "CreateNewUser":
                $rules = [
                    'name.required' => 'Please fill out the name',
                    'name.max:255' => 'Please not enter name above 255 characters',
                    'email.required' => 'Please fill out the email',
                    'email.email' => 'Please enter valid email address',
                    'email.max:255' => 'Please not enter email  above 255 characters',
                    'email.unique:user' => 'This email has been registered',
                    'password.required' => 'Please fill out the password',
                    'password.min:8' => 'The minimum password length is 8',
                    'password.regex' => 'Please enter the password that consist of number and character',
                    'roleID.required' => 'RoleID cannot be empty',
                ];
                break;
        }

        return $rules;
    }
}
