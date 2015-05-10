<?php
namespace Rosello\T411\Authentication;

use Rosello\T411\Config\AuthConfig;

/**
 * Class AuthenticationTest
 */
class AuthenticationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Authentication
     */
    private $authentication;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $client;

    public function setUp()
    {
        $this->client = $this->getMock('GuzzleHttp\ClientInterface');
        $this->authentication = new Authentication($this->client);
    }

    /**
     * @expectedException        \Rosello\T411\Exception\AuthenticationException
     * @expectedExceptionCode    101
     * @expectedExceptionMessage User not found
     */
    public function testShouldThrowExceptionIfInvalidUser()
    {
        $authConfig = new AuthConfig('username', 'password');

        $response = $this->getMock('GuzzleHttp\Message\ResponseInterface');
        $response
            ->expects($this->once())
            ->method('json')
            ->willReturn(array(
                "error" => "User not found",
                "code" => 101
            ));

        $this->client
            ->expects($this->once())
            ->method('post')
            ->with(
                $authConfig->getBaseUrl() . '/auth',
                array('body' => array(
                    'username' => 'username',
                    'password' => 'password'
                ))
            )
            ->willReturn($response);

        $this->authentication->auth($authConfig);
    }

    public function testShouldReturnTokenConfigIfSuccessAuth()
    {
        $authConfig = new AuthConfig('username', 'password');

        $response = $this->getMock('GuzzleHttp\Message\ResponseInterface');
        $response
            ->expects($this->once())
            ->method('json')
            ->willReturn(array(
                "token" => "some_token"
            ));

        $this->client
            ->expects($this->once())
            ->method('post')
            ->with(
                $authConfig->getBaseUrl() . '/auth',
                array('body' => array(
                    'username' => 'username',
                    'password' => 'password'
                ))
            )
            ->willReturn($response);

        $tokenConfig = $this->authentication->auth($authConfig);

        $this->assertInstanceOf('Rosello\T411\Config\TokenConfig', $tokenConfig);
        $this->assertSame('some_token', $tokenConfig->getToken());
    }
}
