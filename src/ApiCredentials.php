<?php

namespace Speicher210\Fastbill\Api;

/**
 * Store the API credentials for fastbill API.
 */
class ApiCredentials
{

    /**
     * The email for authentication to fastbill API.
     *
     * @var string
     */
    protected $email;

    /**
     * The API key for authentication to fastbill API.
     *
     * @var string
     */
    protected $apiKey;

    /**
     * Constructor.
     *
     * @param string $email The email for authentication to fastbill API.
     * @param string $apiKey The email for authentication to fastbill API.
     */
    public function __construct($email, $apiKey)
    {
        $this->email = $email;
        $this->apiKey = $apiKey;
    }

    /**
     * Get the email for authentication to fastbill API.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the API key for authentication to fastbill API.
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }
}
