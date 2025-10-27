<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NoForbiddenWords implements Rule
{
    protected $forbidden = ['xấu', 'bậy', 'xxx', 'tục'];

    public function passes($attribute, $value)
    {
        foreach ($this->forbidden as $word) {
            if (stripos($value, $word) !== false) {
                return false;
            }
        }
        return true;
    }

    public function message()
    {
        return 'Trường :attribute chứa từ không phù hợp.';
    }
}
