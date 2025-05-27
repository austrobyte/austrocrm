<?php

namespace Austro\Crm\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Austro\Crm\AustroCrm
 */
class AustroCrm extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Austro\Crm\AustroCrm::class;
    }
}
