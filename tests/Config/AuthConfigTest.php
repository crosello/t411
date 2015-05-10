<?php

namespace Rosello\T411\Config;

/**
 * Class AuthConfigTest
 *
 * @package Rosello\T411\Config
 */
class AuthConfigTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AuthConfig
     */
    private $authConfig;

    public function setUp()
    {
        $this->authConfig = new AuthConfig('username', 'password');
    }

    public function testShouldGetUsername()
    {
        $this->assertSame('username', $this->authConfig->getUsername());
    }

    public function testShouldGetPassword()
    {
        $this->assertSame('password', $this->authConfig->getPassword());
    }
}
