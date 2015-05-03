<?php
namespace App\Controllers;

/**
 * Main Controller Class, others to inherit from
 */
class Controller
{
    public $viewData;

    /**
     * Initial setup of all Controller files
     */
    public function __construct()
    {
        $this->viewData = new \StdClass;
    }

    /**
     * Get the ServiceFactory
     * with the required config
     */
    protected function getServiceFactory()
    {

    }
}
