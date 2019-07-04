<?php

namespace WHMCS;

class WHMCS extends WhmcsCore {
    
    /**
     * Instantiate a new instance
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Generic function to call WHMCS API
     * 
     * @param string $action
     * @param array $data
     * @return array
     */

    public function callAPI($request)
    {
        return $this->submitRequest($request);
    }

}