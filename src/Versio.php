<?php

namespace Structuremedia\Versio;

use Structuremedia\Versio\Modules\Domain;
use Structuremedia\Versio\Modules\Contact;
use Structuremedia\Versio\Modules\Tld;

class Versio
{

    public function domains()
    {
        return new Domain;
    }

    public function contacts()
    {
        return new Contact;
    }

    public function tlds()
    {
        return new Tld;
    }

}