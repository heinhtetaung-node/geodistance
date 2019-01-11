<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidCoordinate implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if(!is_array($value)){
            return false;
        }
        if(sizeof($value)>2 || sizeof($value)<2){
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute must be coordinates array format [LATITUDE, LONGTITUDE].';
    }
}
