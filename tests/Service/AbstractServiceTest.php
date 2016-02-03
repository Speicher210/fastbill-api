<?php

namespace Speicher210\Fastbill\Test\Api\Service;

use Doctrine\Common\Annotations\AnnotationRegistry;
use JMS\Serializer\SerializerBuilder;
use Speicher210\Fastbill\Api\Serializer\Handler\DateHandler;
use Speicher210\Fastbill\Api\ServiceInterface;
use Speicher210\Fastbill\Api\Transport\TransportInterface;

/**
 * Abstract class to test Fastbill services.
 */
abstract class AbstractServiceTest extends \PHPUnit_Framework_TestCase
{

    /**
     * The temporary directory for the serializer cache.
     *
     * @var string
     */
    private static $serializerTempDirectory;

    /**
     * {@inheritdoc}
     */
    public static function setUpBeforeClass()
    {
        if (self::$serializerTempDirectory === null) {
            self::$serializerTempDirectory = sys_get_temp_dir().'/'.uniqid('sp210_fastbill_api_test', true);
        }
    }

    /**
     * Get the class name under test.
     *
     * @return string
     */
    abstract protected function getClassUnderTest();

    /**
     * Get the service to test with the mocked transport.
     *
     * @return ServiceInterface
     */
    protected function getServiceToTest()
    {
        $reflection = new \ReflectionObject($this);

        $fixturesDirectory = dirname($reflection->getFileName()).'/Expected/';

        $transportRequest = file_get_contents($fixturesDirectory.$this->getName().'Request.json');
        $transportRequest = json_encode(json_decode($transportRequest));
        $transportResponse = file_get_contents($fixturesDirectory.$this->getName().'Response.json');

        $transportMock = $this->getMock(TransportInterface::class);
        $transportMock
            ->expects($this->once())
            ->method('sendRequest')
            ->with($this->equalTo($transportRequest))
            ->willReturn($transportResponse);

        AnnotationRegistry::registerLoader('class_exists');

        $serializer = SerializerBuilder::create()
            ->setCacheDir(self::$serializerTempDirectory)
            ->configureHandlers(
                function (\JMS\Serializer\Handler\HandlerRegistry $registry) {
                    $registry->registerSubscribingHandler(new DateHandler());
                }
            )
            ->build();

        $class = $this->getClassUnderTest();
        $service = new $class($transportMock, $serializer);

        return $service;
    }
}
