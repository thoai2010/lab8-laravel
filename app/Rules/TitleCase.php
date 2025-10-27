<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class TitleCase implements Rule
{
    public function passes($attribute, $value)
    {
        return preg_match('/^[A-Z]/', $value);
    }

    public function message()
    {
        return 'Tiêu đề phải bắt đầu bằng chữ in hoa.';
    }
}
