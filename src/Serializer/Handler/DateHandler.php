<?php

namespace Speicher210\Fastbill\Api\Serializer\Handler;

use JMS\Serializer\Handler\DateHandler as JMSDateHandler;
use JMS\Serializer\JsonDeserializationVisitor;

class DateHandler extends JMSDateHandler
{
    /**
     * {@inheritdoc}
     */
    public function deserializeDateTimeFromJson(JsonDeserializationVisitor $visitor, $data, array $type)
    {
        if ('' === $data || null === $data) {
            return null;
        }

        return parent::deserializeDateTimeFromJson($visitor, $data, $type);
    }
}
