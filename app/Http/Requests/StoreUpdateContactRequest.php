<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateContactRequest extends FormRequest
{
    public function rules()
    {
        $id = $this->segment(2);

        return [
            'name'      => "required|min:5",
            'contact'   => "required|integer|digits:9|unique:contacts,contact,{$id},id",
            'email'     => "required|string|email|max:255|unique:contacts,email,{$id},id"
        ];
    }
}