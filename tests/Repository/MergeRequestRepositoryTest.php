<?php

namespace DoppioGancio\Test\GitLab\Repository;

use DoppioGancio\GitLab\Client;
use DoppioGancio\MockedClient\HandlerBuilder;
use DoppioGancio\MockedClient\MockedGuzzleClientBuilder;
use DoppioGancio\MockedClient\Route\RouteBuilder;
use Http\Discovery\Psr17FactoryDiscovery;
use PHPUnit\Framework\TestCase;
use DoppioGancio\GitLab\Domain\MergeRequest;
use DoppioGancio\GitLab\Domain\MergeRequestCreate;
use DoppioGancio\GitLab\Repository\MergeRequestRepository;

class MergeRequestRepositoryTest extends TestCase
{
    public function testList()
    {
        $repo = $this->getMergeRequestRepository();

        /** @var MergeRequest[] $list */
        $list = $repo->list()->wait();

        $this->assertCount(1, $list);
        $this->assertEquals("fixed login page css paddings", $list[0]->getDescription());
        $this->assertEquals("Douwe Maan", $list[0]->getMergedBy()->getName());
    }

    public function testCreate()
    {
        $repo = $this->getMergeRequestRepository();
        /** @var MergeRequest $newMr */
        $newMr = $repo->create(new MergeRequestCreate(
            'aaa',
            'aaa',
            'aaa',
            'aaa',
            'aaa',
        ))->wait();

        $this->assertEquals("fixed login page css paddings", $newMr->getDescription());
    }

    public function testMerge()
    {
        $repo = $this->getMergeRequestRepository();

        /** @var MergeRequest $mr */
        $mr = $repo->merge(123)->wait();

        $this->assertEquals("merged", $mr->getState());
    }

    public function getMergeRequestRepository(): MergeRequestRepository
    {
        $handlerBuilder = new HandlerBuilder(
            Psr17FactoryDiscovery::findServerRequestFactory()
        );

        $rb = new RouteBuilder(
            Psr17FactoryDiscovery::findResponseFactory(),
            Psr17FactoryDiscovery::findStreamFactory(),
        );

        $handlerBuilder->addRoute(
            $rb->new()
                ->withMethod('GET')
                ->withPath('/api/v4/projects/project-name/merge_requests')
                ->withFileResponse(__DIR__ . '/../fixtures/merge_request.list.json')
                ->build()
        );

        $handlerBuilder->addRoute(
            $rb->new()
                ->withMethod('POST')
                ->withPath('/api/v4/projects/project-name/merge_requests')
                ->withFileResponse(__DIR__ . '/../fixtures/merge_request.create.json')
                ->build()
        );

        $handlerBuilder->addRoute(
            $rb->new()
                ->withMethod('PUT')
                ->withPath('/api/v4/projects/project-name/123/merge')
                ->withFileResponse(__DIR__ . '/../fixtures/merge_request.merge.json')
                ->build()
        );

        $client = (new MockedGuzzleClientBuilder($handlerBuilder))->build();
        return (new Client($client, 'project-name'))->mergeRequest();
    }
}