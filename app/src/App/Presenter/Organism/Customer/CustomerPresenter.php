<?php

namespace App\Presenter\Organism\Customer;

use App\Presenter\Presenter;
use App\Domain\Entity\Customer;

/**
 * Class CustomerPresenter
 * An object for displaying a customer object
 */
class CustomerPresenter extends Presenter implements CustomerPresenterInterface
{
    /**
     * Default set of options
     * @var array
     */
    protected $options = array(

    );

    /**
     * @param Customer $customer
     * @param array $options
     */
    public function __construct(
        Customer $customer,
        $options = []
    ) {
        parent::__construct($customer, $options);
    }

    public function getName()
    {
        return $this->domainModel->getName();
    }
}
