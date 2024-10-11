<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DocumentNumberRule implements Rule
{
    public function passes($attribute, $value)
    {
        return preg_match('/^\d+\/\d+\/\d+$/', $value);
    }

    public function message()
    {
        return 'The :attribute must be in the format number/number/number.';
    }
}
