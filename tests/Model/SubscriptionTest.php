<?php

namespace Speicher210\Fastbill\Test\Api\Model\Coupon;
use Speicher210\Fastbill\Api\Model\Subscription;

/**
 * Test for the subscription model.
 */
class SubscriptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Data provider for testSubscriptionRunning.
     *
     * @return array
     */
    public static function dataProviderTestSubscriptionRunning()
    {
        return array(
            array('active', true),
            array('trial', true),
            array('canceled', false),
            array('bogus', false)
        );
    }

    /**
     * @dataProvider dataProviderTestSubscriptionRunning
     *
     * @param string $status The status.
     * @param boolean $expected The expected running status.
     */
    function testSubscriptionRunning($status, $expected)
    {
        $subscription = new Subscription();
        $subscription->setStatus($status);

        $this->assertSame($expected, $subscription->isRunning());
    }
}
