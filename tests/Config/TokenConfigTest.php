<?php
/**
 * Created by PhpStorm.
 * User: chris_000
 * Date: 2015-05-09
 * Time: 12:05
 */

namespace Rosello\T411\Config;

/**
 * Class TokenConfigTest
 * @package Rosello\T411\Config
 */
class TokenConfigTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TokenConfig
     */
    private $tokenConfig;

    public function setUp()
    {
        $this->tokenConfig = new TokenConfig('some_token');
    }

    public function testShouldGetToken()
    {
        $this->assertSame('some_token', $this->tokenConfig->getToken());
    }
}
