<?php

namespace App\Http\Requests\SettingMenu;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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

    public function rules(): array
    {
        return [
            'label'   => 'required|string|unique:menus,label,'.$this->route('setting_menu'),
            'route'   => 'required|string|unique:menus,route,'.$this->route('setting_menu'),
            'icon'    => 'required|string',
            'key'     => 'required|string|unique:menus,key,'.$this->route('setting_menu'),
            'roles'   => 'required|array'
        ];
    }

    public function messages()
    {
        return [
            'label.required'  => 'Label menu harus diisi',
            'route.required'  => 'Route menu harus diisi',
            'icon.required'   => 'Icon menu harus diisi',
            'key.required'    => 'Key menu harus diisi',
            'roles.required'  => 'Roles menu harus diisi',
            'label.unique'    => 'Label menu sudah terdaftar',
            'route.unique'    => 'Route menu sudah terdaftar',
            'key.unique'      => 'Key menu sudah terdaftar'
        ];
    }
}
