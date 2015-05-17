<?php

namespace App\Presenter\Molecule\Form;

interface FormPresenterInterface
{
    public function getValidationErrors();
    public function getValues();
}
