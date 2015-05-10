<?php

namespace Rosello\T411\Model\Factory;

/**
 * Class TorrentFactoryTest
 * @package Rosello\T411\Model\Factory
 * @covers  Rosello\T411\Model\Factory\TorrentFactory
 */
class TorrentFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TorrentFactory
     */
    private $torrentFactory;

    public function setUp()
    {
        $this->torrentFactory = new TorrentFactory();
    }

    public function testShouldCreateTorrent()
    {
        $row = array(
            'id' => 1021,
            'name' => 'Debian',
            'category' => 47,
            'seeders' => 1000,
            'leechers' => 1050,
            'added' => '2015-05-09 22:25:00',
            'size' => 151,
            'isVerified' => 1
        );

        $torrent = $this->torrentFactory->create($row);

        $this->assertInstanceOf('Rosello\T411\Model\Torrent', $torrent);

        $this->assertSame(1021, $torrent->getId());
        $this->assertSame('Debian', $torrent->getName());
        $this->assertSame(47, $torrent->getCategory());
        $this->assertSame(1000, $torrent->getSeeders());
        $this->assertSame(1050, $torrent->getLeechers());
        $this->assertInstanceOf('\DateTime', $torrent->getAddedAt());
        $this->assertSame('2015-05-09 22:25:00', $torrent->getAddedAt()->format('Y-m-d H:i:s'));
        $this->assertSame(151, $torrent->getSize());
        $this->assertTrue($torrent->isVerified());
    }
}
