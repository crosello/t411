<?php

namespace Rosello\T411\Model;

class TorrentTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Torrent
     */
    private $torrent;

    public function setUp()
    {
        $this->torrent = new Torrent(15, 'Ubuntu torrent', 38, 1004, 100, '2015-05-09 12:00:00', 1181818, 1);
    }

    public function testShouldGetId()
    {
        $this->assertSame(15, $this->torrent->getId());
    }

    public function testShouldGetName()
    {
        $this->assertSame('Ubuntu torrent', $this->torrent->getName());
    }

    public function testShouldGetSeeders()
    {
        $this->assertSame(1004, $this->torrent->getSeeders());
    }

    public function testShouldGetLeechers()
    {
        $this->assertSame(100, $this->torrent->getLeechers());
    }

    public function testShouldGetAddedAt()
    {
        $this->assertEquals(new \DateTime('2015-05-09 12:00:00'), $this->torrent->getAddedAt());
    }

    public function testShouldGetIfVerified()
    {
        $this->assertTrue($this->torrent->isVerified());
    }
}
