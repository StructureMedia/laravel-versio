<?php

namespace Structuremedia\Versio\Facades;

class Versio extends \Illuminate\Support\Facades\Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'versio';
    }
}
