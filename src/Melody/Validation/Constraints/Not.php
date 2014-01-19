<?php
namespace Melody\Validation\Constraints;

use Melody\Validation\Validator;

class Not
{
    protected $id = 'not';
    protected $validator;

    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    public function validate($input)
    {
        return !$this->validator->validate($input);
    }
}
