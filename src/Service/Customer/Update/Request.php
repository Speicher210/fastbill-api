<?php

namespace Speicher210\Fastbill\Api\Service\Customer\Update;

use JMS\Serializer\Annotation as JMS;
use Speicher210\Fastbill\Api\AbstractRequest;

/**
 * The request for updating the customers.
 */
class Request extends AbstractRequest
{
    /**
     * @var RequestData
     *
     * @JMS\Type("Speicher210\Fastbill\Api\Service\Customer\Update\RequestData")
     * @JMS\SerializedName("DATA")
     */
    protected $data;

    /**
     * Constructor.
     *
     * @param RequestData $requestData The data for the request.
     */
    public function __construct(RequestData $requestData)
    {
        parent::__construct();

        $this->data = $requestData;
    }

    /**
     * {@inheritdoc}
     */
    public function getService()
    {
        return 'customer.update';
    }
}
