<?php

namespace WHMCS;

use GuzzleHttp\Client;

class WhmcsCore {
        
    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var string
     */
    protected $api_identifier;

    /**
     * @var string
     */
    protected $api_secret;

    /**
     * @var int
     */
    protected $timeout;

    /**
     * @var string
     */
    protected $response_type;

    /**
     * Instantiate a new instance
     * 
     * @return void
     */
    public function __construct()
    {

        // For Authenticating with Login Credentials

        //$this->username         = config('whmcs.username');
        //$this->password         = config('whmcs.password');

        // For Authenticating with API Credentials

        $this->api_identifier   = config('whmcs.api_identifier');
        $this->api_secret       = config('whmcs.api_secret');

        $this->response_type    = strtolower(config('whmcs.response_type'));

        $this->client = new Client([
            'base_uri'  => config('whmcs.url'),
            'timeout'   => config('whmcs.timeout'),
            'headers'   => ['Accept' => 'application/json']
        ]);
    }

    /**
     * Respond to a WHMCS request
     * 
     * @param type 
     * @return array
     */
    public function submitRequest($data)
    {
        $data = $this->addNecessaryParams($data);
        $response = $this->client->request('POST', '', [
            'query' => $data,
            'http_errors' => true,
            'verify' => false
        ]);

        return $this->handleResponse($response);
    }

    /**
     * Adds the WHMCS username, password and response to the request
     * 
     * @param array $params
     * @return array
     */
    protected function addNecessaryParams($params)
    {
        // For authenticating with Login Credentials

        //$params['username']         = $this->username;
        //$params['password']         = md5($this->password);

        // For Authenticating with API Credentials

        $params['identifier']         = $this->api_identifier;
        $params['secret']             = $this->api_secret;

        $params['responsetype']       = $this->response_type;

        return $params;
    }

    /**
     * Formats the response based on the set response_type
     *
     * @param array $response
     * @return array
     */
    protected function handleResponse($response)
    {
        if($this->response_type === 'json')
            return json_decode($response->getBody(), true);

        return simplexml_load_string($response->getBody());
    }

}