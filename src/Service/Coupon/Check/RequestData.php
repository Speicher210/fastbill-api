<?php

namespace Speicher210\Fastbill\Api\Service\Coupon\Check;

use JMS\Serializer\Annotation as JMS;
use Speicher210\Fastbill\Api\AbstractRequestData;

/**
 * The request data for checking a coupon.
 */
final class RequestData extends AbstractRequestData
{

    /**
     * The coupon code.
     *
     * @var string
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("CODE")
     */
    protected $code;

    /**
     * Constructor.
     *
     * @param string $code The code to request.
     */
    public function __construct($code)
    {
        $this->setCode($code);
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }
}
