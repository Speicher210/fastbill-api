<?php

namespace Speicher210\Fastbill\Api\Model;

/**
 * Subscription model.
 */
class Subscription
{
    use SubscriptionTrait;

    const SUBSCRIPTION_STATUS_ACTIVE = 'active';

    /**
     * Inactive subscription, usually after a payment failed.
     */
    const SUBSCRIPTION_STATUS_INACTIVE = 'inactive';

    /**
     * While in the trial period.
     */
    const SUBSCRIPTION_STATUS_TRIAL = 'trial';

    /**
     * If it has reached the cancellation date.
     */
    const SUBSCRIPTION_STATUS_CANCELED = 'canceled';

    /**
     * If the subscription is closed.
     */
    const SUBSCRIPTION_STATUS_CLOSED = 'closed';

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
