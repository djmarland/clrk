<?php

namespace App\Presenter;

/**
 * Class MasterPresenter
 * The entire set of page data is passed into this presenter
 */
class MasterPresenter extends Presenter
{

    private $data = [];

    /**
     * @param $key string
     * @param $value mixed
     * @param $allowedInFeed boolean whether this data should be public in feeds
     */
    public function set(
        $key,
        $value,
        $allowedInFeed = true
    ) {
        $this->data[$key] = (object) [
            'data' => $value,
            'inFeed' => $allowedInFeed
        ];
    }

    public function getData()
    {
        $data = array();
        foreach ($this->data as $key => $value) {
            $data[$key] = $value->data;
        }
        return $data;
    }

    public function getFeedData()
    {
        $data = (object) [];

        foreach ($this->data as $key => $value) {
            if ($value->inFeed) {
                $data->$key = $value->data;
            }
        }

        return $data;
    }
}
