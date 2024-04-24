<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidarNombre implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Verifica si el nombre contiene al menos una letra y no consiste únicamente de números
        return preg_match('/[a-zA-Z]/', $value) && !ctype_digit($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El campo :attribute debe contener al menos una letra.';
    }
}
