<?php

namespace Humantech\Zoho\Recruit\Api\Tests\Client;

use Humantech\Zoho\Recruit\Api\Client\Client;
use Humantech\Zoho\Recruit\Api\Tests\TestCase;

class ClientTestCase extends TestCase
{
    /**
     * Get the content of a file.
     *
     * @param  string $filename
     * @return string
     */
    public function getResourceFakeResponseByName($filename)
    {
        return file_get_contents(realpath(dirname(__FILE__) . '/Resources/FakeResponse/' . $filename));
    }

    /**
     * @return Client
     */
    public function getClientOriginalInstance()
    {
        return new Client();
    }

    /**
     * @param  array $methods
     *
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    public function getClientMock(array $methods)
    {
        return $this->getMockBuilder('\\Humantech\\Zoho\\Recruit\\Api\\Client\\Client')
            ->disableOriginalConstructor()
            ->setMethods($methods)
            ->getMock()
        ;
    }
}
