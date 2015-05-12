<?php

namespace Rosello\T411\Authentication;

use Rosello\T411\Config\TokenConfig;
use Rosello\T411\Repository\TorrentRepository;

class TorrentRepositoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TorrentRepository
     */
    private $repository;

    /**
     * @var TokenConfig
     */
    private $config;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $client;

    public function setUp()
    {
        $this->client = $this->getMock('GuzzleHttp\ClientInterface');
        $this->config = new TokenConfig('token');
        $this->repository = new TorrentRepository($this->config, 2, $this->client);
    }

    public function testShouldSearchTorrents()
    {
        $result = array(
            'query' => "Ubuntu",
            'offset' => 0,
            'limit' => 10,
            'total' => "2",
            'torrents' =>
                array(
                    array(
                        'id' => "4536589",
                        'name' => "Linux Ubuntu 11.10 [Processeurs x86-32bits] [Format .iso bootable] [Français]",
                        'category' => "234",
                        'rewritename' => "linux-ubuntu-11-10-processeurs-x86-32bits-format-iso-bootable-francais",
                        'seeders' => "19",
                        'leechers' => "0",
                        'comments' => "40",
                        'isVerified' => "1",
                        'added' => "2011-12-05 18:33:22",
                        'size' => "686817280",
                        'times_completed' => "8477",
                        'owner' => "6338305",
                        'categoryname' => "Linux",
                        'categoryimage' => "app-linux",
                        'username' => "Elendil57",
                        'privacy' => "strong",
                    ),
                    array(
                        'id' => "4967435",
                        'name' => "Ubuntu-13.10 Desktop-Processeurs 64bits ",
                        'category' => "234",
                        'rewritename' => "ubuntu-13-10-desktop-processeurs-64bits",
                        'seeders' => "11",
                        'leechers' => "0",
                        'comments' => "26",
                        'isVerified' => "1",
                        'added' => "2013-10-21 17:29:02",
                        'size' => "925896640",
                        'times_completed' => "1682",
                        'owner' => "96342169",
                        'categoryname' => "Linux",
                        'categoryimage' => "app-linux",
                        'username' => "jordanx59x",
                        'privacy' => "normal"
                    )));

        $response = $this->getMock('GuzzleHttp\Message\ResponseInterface');
        $response
            ->expects($this->once())
            ->method('json')
            ->willReturn($result);

        $this->client
            ->expects($this->once())
            ->method('post')
            ->with(
                $this->config->getBaseUrl() . '/torrents/search/Ubuntu?limit=2',
                array(
                    'headers' => array(
                        'Authorization' => 'token'
                    )
                )
            )
            ->willReturn($response);

        $torrents = $this->repository->search('Ubuntu');

        $this->assertCount(2, $torrents);
    }

    /**
     * @expectedException        \InvalidArgumentException
     */
    public function testShouldThrowExceptionIfProviderANotNumericValueForLimit()
    {
        new TorrentRepository($this->config, 'not_numeric');
    }
}
