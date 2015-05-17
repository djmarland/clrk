<?php

namespace App\Presenter;

/**
 * Class Presenter
 * For those which the base Presenter classes inherit (for view logic)
 */
abstract class Presenter
{
    /**
     * @var object
     */
    protected $domainModel;

    /**
     * @var array
     */
    protected $options = [
        'classType' => 'Presenter'
    ];

    /**
     * @param object $domainModel optional
     * @param array  $options     optional
     */
    public function __construct(
        $domainModel = null,
        $options = []
    ) {
        $this->domainModel = $domainModel;
        $this->options = array_merge($this->options, $options);
    }

    /**
     * Convert the options to an object and return
     * @return object
     */
    public function getOptions()
    {
        return (object) $this->options;
    }

    /**
     * A unique generated ID for this object
     * Only relevant for page renders that need a reference
     *
     * @var
     */
    protected $uniqueId;

    /**
     * Get or generate a unique ID. Once generated once the same one will be used
     * Only used for unique references in a single render
     * @return string
     */
    public function getUniqueID()
    {
        if (!$this->uniqueId) {
            $parts = explode('\\', get_called_class());

            $class = end($parts);
            $this->uniqueId = 'View-' . $class . '-' . mt_rand();
        }
        return $this->uniqueId;
    }
}
