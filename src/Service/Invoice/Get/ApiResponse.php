<?php

namespace Speicher210\Fastbill\Api\Service\Invoice\Get;

use JMS\Serializer\Annotation as JMS;
use Speicher210\Fastbill\Api\AbstractApiResponse;

/**
 * API response when getting an invoice.
 *
 * @method Response getResponse()
 */
class ApiResponse extends AbstractApiResponse
{
    /**
     * The Request.
     *
     * @var Request
     *
     * @JMS\Type("Speicher210\Fastbill\Api\Service\Invoice\Get\Request")
     * @JMS\SerializedName("REQUEST")
     */
    protected $request;

    /**
     * The response.
     *
     * @var array
     *
     * @JMS\Type("Speicher210\Fastbill\Api\Service\Invoice\Get\Response")
     * @JMS\SerializedName("RESPONSE")
     */
    protected $response;
}
