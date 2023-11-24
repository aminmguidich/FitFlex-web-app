<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

class IsCoachAvailable extends Constraint
{
    public $message = 'The selected coach is not available on the specified date.';

}