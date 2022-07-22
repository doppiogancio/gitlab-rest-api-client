<?php

declare(strict_types=1);

namespace DoppioGancio\GitLab\Test\Api;

use DoppioGancio\GitLab\Client;
use DoppioGancio\GitLab\Api\BranchApi;
use DoppioGancio\GitLab\Resource\Branch;
use DoppioGancio\MockedClient\HandlerBuilder;
use DoppioGancio\MockedClient\MockedGuzzleClientBuilder;
use DoppioGancio\MockedClient\Route\RouteBuilder;
use Http\Discovery\Psr17FactoryDiscovery;
use PHPUnit\Framework\TestCase;

use function assert;

class BranchApiTest extends TestCase
{
    public function testList(): void
    {
        $repo = $this->getBranchRepository();

        /** @var Branch[] $list */
        $list = $repo->list('testproject')->wait();

        $this->assertCount(1, $list);
        $branch = $list[0];

        $this->assertEquals('master', $branch->getName());
        $this->assertFalse($branch->isMerged());
        $this->assertTrue($branch->isProtected());
        $this->assertTrue($branch->isDefault());
        $this->assertFalse($branch->isDevelopersCanPush());
        $this->assertFalse($branch->isDevelopersCanMerge());
        $this->assertTrue($branch->isCanPush());
        $this->assertEquals('https://gitlab.example.com/my-group/my-project/-/tree/master', $branch->getWebUrl());

        $commit = $branch->getCommit();
        $this->assertEquals('john@example.com', $commit->getAuthorEmail());
        $this->assertEquals('John Smith', $commit->getAuthorName());
        $this->assertEquals('2012-06-27T05:51:39-07:00', $commit->getAuthoredDate());
        $this->assertEquals('2012-06-28T03:44:20-07:00', $commit->getCommittedDate());
        $this->assertEquals('john@example.com', $commit->getCommitterEmail());
        $this->assertEquals('John Smith', $commit->getCommitterName());

        $this->assertEquals('7b5c3cc8be40ee161ae89a06bba6229da1032a0c', $commit->getId());
        $this->assertEquals('7b5c3cc', $commit->getShortId());
        $this->assertEquals('add projects API', $commit->getTitle());
        $this->assertEquals('add projects API', $commit->getMessage());
        $this->assertEquals(['4ad91d3c1144c406e50c7b33bae684bd6837faf8'], $commit->getParentIds());
    }

    public function testCreate(): void
    {
        $repo = $this->getBranchRepository();

        $newBranch = $repo->create('testproject', 'aa', 'xxx')->wait();
        assert($newBranch instanceof Branch);

        $this->assertEquals('newbranch', $newBranch->getName());
    }

    public function getBranchRepository(): BranchApi
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
                ->withPath('projects/testproject/repository/branches')
                ->withFileResponse(__DIR__ . '/../fixtures/branch.list.json')
                ->build()
        );

        $handlerBuilder->addRoute(
            $rb->new()
                ->withMethod('POST')
                ->withPath('projects/testproject/repository/branches')
                ->withFileResponse(__DIR__ . '/../fixtures/branch.create.json')
                ->build()
        );

        $client = (new MockedGuzzleClientBuilder($handlerBuilder))->build();
        return (new Client($client))->branch();
    }
}
