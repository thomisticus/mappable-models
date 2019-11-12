<?php

namespace Thomisticus\MappableModels;

use Illuminate\Support\Facades\Facade;

class CoreFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'mappable-models';
    }
}
