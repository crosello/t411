<?php

namespace Rosello\T411\Downloader;

use Rosello\T411\Config\TokenConfig;

/**
 * Class TorrentDownloaderTest
 * @package Rosello\T411\Downloader
 */
class TorrentDownloaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TorrentDownloader
     */
    private $downloader;

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
        $this->downloader = new TorrentDownloader($this->config, $this->client);
    }

    public function testShouldDownloadTorrentFile()
    {
        $content = 'content_file';

        $stream = $this->getMock('GuzzleHttp\Stream\StreamInterface');
        $stream
            ->expects($this->once())
            ->method('getContents')
            ->willReturn($content);

        $response = $this->getMock('GuzzleHttp\Message\ResponseInterface');
        $response
            ->expects($this->once())
            ->method('getBody')
            ->willReturn($stream);

        $this->client
            ->expects($this->once())
            ->method('post')
            ->with(
                $this->config->getBaseUrl() . '/torrents/download/18',
                array(
                    'headers' => array(
                        'Authorization' => 'token'
                    )
                )
            )
            ->willReturn($response);

        $torrent = $this->getMockBuilder('Rosello\T411\Model\Torrent')
            ->disableOriginalConstructor()
            ->getMock();
        $torrent
            ->expects($this->once())
            ->method('getId')
            ->willReturn(18);

        $this->assertSame($content, $this->downloader->download($torrent));
    }
}
