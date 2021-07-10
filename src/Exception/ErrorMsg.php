<?php

namespace Structuremedia\Versio\Exception;

final class ErrorMsg
{  
    // Generic errors
    const NOT_FOUND = "404 - Not Found (Generic error)";

    // Define user error constants
    const INVALID_DOMAIN_STATE_FILTER = "The provided domain state filter is not valid, please see the documentation at: https://www.versio.nl/RESTapidoc/#api-Domains-List";
    const INVALID_METHOD = "Invalid HTTP method specified!";
    const NOT_IMPLEMENTED = "This method is not yet implemented.";
}
