<?php

namespace Speicher210\Fastbill\Api\Service\Article\Get;

use JMS\Serializer\Annotation as JMS;
use Speicher210\Fastbill\Api\AbstractRequest;

/**
 * The request for getting the articles.
 */
class Request extends AbstractRequest
{

    /**
     * The request body.
     *
     * @var array
     *
     * @JMS\Type("Speicher210\Fastbill\Api\Service\Article\Get\RequestData")
     * @JMS\SerializedName("FILTER")
     */
    protected $filter;

    /**
     * Constructor.
     *
     * @param RequestData $requestData The data for the request.
     */
    public function __construct(RequestData $requestData = null)
    {
        parent::__construct();
        $this->filter = $requestData;
    }

    /**
     * {@inheritdoc}
     */
    public function getService()
    {
        return 'article.get';
    }
}
