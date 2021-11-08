<?php

declare(strict_types=1);

namespace DoppioGancio\GitLab\Test\Repository;

use DoppioGancio\GitLab\Client;
use DoppioGancio\GitLab\Domain\Branch;
use DoppioGancio\GitLab\Repository\BranchRepository;
use DoppioGancio\MockedClient\HandlerBuilder;
use DoppioGancio\MockedClient\MockedGuzzleClientBuilder;
use DoppioGancio\MockedClient\Route\RouteBuilder;
use Http\Discovery\Psr17FactoryDiscovery;
use PHPUnit\Framework\TestCase;

use function assert;

class BranchRepositoryTest extends TestCase
{
    public function testList(): void
    {
        $repo = $this->getBranchRepository();

        /** @var Branch[] $list */
        $list = $repo->list()->wait();

        $this->assertCount(1, $list);
        $this->assertEquals('master', $list[0]->getName());
    }

    public function testCreate(): void
    {
        $repo = $this->getBranchRepository();

        $newBranch = $repo->create('aa', 'xxx')->wait();
        assert($newBranch instanceof Branch);

        $this->assertEquals('newbranch', $newBranch->getName());
    }

    public function getBranchRepository(): BranchRepository
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
                ->withPath('/api/v4/projects/project-name/repository/branches')
                ->withFileResponse(__DIR__ . '/../fixtures/branch.list.json')
                ->build()
        );

        $handlerBuilder->addRoute(
            $rb->new()
                ->withMethod('POST')
                ->withPath('/api/v4/projects/project-name/repository/branches')
                ->withFileResponse(__DIR__ . '/../fixtures/branch.create.json')
                ->build()
        );

        $client = (new MockedGuzzleClientBuilder($handlerBuilder))->build();

        return (new Client($client, 'project-name'))->branch();
    }
}
