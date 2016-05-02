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
     * After a payment failed.
     */
    const SUBSCRIPTION_STATUS_INACTIVE = 'inactive';

    /**
     * While in the trial period.
     */
    const SUBSCRIPTION_STATUS_TRIAL = 'trial';

    /**
     * If the subscription has a cancellation date set.
     */
    const SUBSCRIPTION_STATUS_CANCELED = 'canceled';

    /**
     * If it has reached the cancellation date.
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
            self::SUBSCRIPTION_STATUS_TRIAL,
            self::SUBSCRIPTION_STATUS_CANCELED
        );

        return in_array($this->getStatus(), $runningStatuses);
    }
}
