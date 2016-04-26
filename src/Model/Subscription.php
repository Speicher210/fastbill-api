<?php

namespace Speicher210\Fastbill\Api\Model;

/**
 * Subscription model.
 */
class Subscription
{
    use SubscriptionTrait;

    const SUBSCRIPTION_STATUS_ACTIVE = 'active';

    const SUBSCRIPTION_STATUS_TRIAL = 'trial';

    const SUBSCRIPTION_STATUS_CANCELED = 'canceled';

    /**
     * Check if the current subscription is running.
     *
     * @return boolean
     */
    public function isRunning()
    {
        $runningStatuses = array(
            self::SUBSCRIPTION_STATUS_ACTIVE,
            self::SUBSCRIPTION_STATUS_TRIAL
        );

        return in_array($this->getStatus(), $runningStatuses);
    }
}
