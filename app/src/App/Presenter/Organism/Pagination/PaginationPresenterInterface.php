<?php

namespace App\Presenter\Organism\Pagination;

/**
 * Class PaginationPresenterInterface
 */
interface PaginationPresenterInterface
{
    public function getPrevUrl();
    public function getNextUrl();
    public function getIsActive();
    public function getShowStatus();
    public function getStart();
    public function getEnd();
    public function getTotal();
}
