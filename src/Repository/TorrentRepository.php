<?php
/**
 * Created by PhpStorm.
 * User: chris_000
 * Date: 2015-05-08
 * Time: 23:44
 */

namespace Rosello\T411\Repository;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Rosello\T411\Config\TokenConfig;
use Rosello\T411\Model\Factory\TorrentFactory;
use Rosello\T411\Model\Torrent;

/**
 * Class TorrentRepository
 * @package AppBundle\Providers\T411\Repository
 */
class TorrentRepository
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var TokenConfig
     */
    private $config;

    /**
     * @var
     */
    private $torrentFactory;

    /**
     * @param TokenConfig $tokenConfig
     * @param ClientInterface $client
     */
    public function __construct(TokenConfig $tokenConfig, ClientInterface $client = null)
    {
        if ($client) {
            $this->client = $client;
        } else {
            $this->client = new Client();
        }

        $this->config = $tokenConfig;
        $this->torrentFactory = new TorrentFactory();
    }

    /**
     * @param $search
     * @return Torrent[]
     */
    public function search($search)
    {
        $response = $this->client->post($this->config->getBaseUrl() . "/torrents/search/{$search}", array(
            'headers' => array(
                "Authorization" => $this->config->getToken()
            )
        ));
        $data = $response->json();

        $rows = $data['torrents'];
        $torrents = array();

        foreach ($rows as $row) {
            $torrents[] = $this->torrentFactory->create($row);
        }

        return $torrents;
    }
}