<?php

namespace App\Presenter\Molecule\Form;

use App\Presenter\Presenter;

/**
 * Class FormPresenter
 * An object for displaying a form object
 */
class FormPresenter extends Presenter implements FormPresenterInterface
{
    /**
     * Default set of options
     * @var array
     */
    protected $options = [];

    /**
     * @param array|null $values
     * @param array $options
     */
    public function __construct(
        $values = [],
        $options = []
    ) {
        parent::__construct(null, $options);
        $this->values = $values;
    }

    /**
     * @var array|null
     */
    private $values = [];

    /**
     * @return array|null
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public function get($key)
    {
        if ($this->values[$key]) {
            return $this->values[$key];
        }
        return null;
    }

    /**
     * @var array
     */
    private $validationErrors = [];

    /**
     * @return array
     */
    public function getValidationErrors()
    {
        return $this->validationErrors;
    }

    /**
     * @param $key
     * @param $message
     * @return array
     */
    public function addValidationError($key, $message)
    {
        $this->validationErrors[$key] = $message;
        return true;
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        return (empty($this->validationErrors));
    }

    public function getClasses()
    {
        $classes = [];
        foreach (array_keys($this->validationErrors) as $key) {
            $classes[$key] = 'error';
        }
        return $classes;
    }
}
