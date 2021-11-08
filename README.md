# GitLab Rest API Client
A PHP client for GitLab Rest API

## Install
Via Composer

```shell
$ composer require doppiogancio/gitlab-rest-api-client
```

## Requirements
* This version requires a minimum PHP version 7.4
* A GitLab project id
* An api [token](https://docs.gitlab.com/ee/user/profile/personal_access_tokens.html) to that project id

## The GitLab Rest API Client
So far the client offers only functionalities only for two components:
1. branch `$gitlab->branch()`
2. merge request  `$gitlab->mergeRequest()`

Every request is asynchronous, so use the **wait()** to get the results
```php
$mergeRequests = $gitlab->mergeRequest()->list()->wait();
```

## How to use the client
```php
use DoppioGancio\GitLab\Client;
use DoppioGancio\GitLab\Domain\MergeRequest;
use GuzzleHttp\Client as GuzzleClient;

$client = new GuzzleClient([
    'base_uri' => 'https://gitlab.com/',
    'headers' => [
        'PRIVATE-TOKEN' =>  'my-gitlab-api-token',
    ]
]);

$gitlab = new Client($client, 'my-gitlab-project-id');

print_r(array_map(function (MergeRequest $mr) {
    return $mr->getTitle();
}, $gitlab->mergeRequest()->list()->wait()));

// will return
Array
(
    [0] => Draft: [PM-1234] Adding a red button
    [1] => [PM-1235] Adding a green button
    [2] => [PM-1236] Adding a yellow button  
)
```