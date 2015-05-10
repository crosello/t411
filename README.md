#T411 library

Search torrents in t411 api

## Installation

`composer require crosello/t411`

## Usage

### Authentication

```
$authConfig = new AuthConfig('username', 'password');`
...
$authentication = new Authentication();
$tokenConfig = $authentication->auth($authConfig);
```

### Search Torrents

```
$repository = new TorrentRepository($tokenConfig);
$torrents = $repository->search('Ubuntu');
```

### Download torrent

```
$downloader = new TorrentDownloader($tokenConfig);
$file = $downloader->download($torrents[0]);
```
