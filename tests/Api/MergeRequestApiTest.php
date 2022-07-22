<?php

declare(strict_types=1);

namespace DoppioGancio\Test\GitLab\Api;

use DoppioGancio\GitLab\Client;
use DoppioGancio\GitLab\Api\MergeRequestApi;
use DoppioGancio\GitLab\Resource\MergeRequest;
use DoppioGancio\GitLab\Resource\MergeRequestCreate;
use DoppioGancio\GitLab\Resource\Milestone;
use DoppioGancio\GitLab\Resource\User;
use DoppioGancio\MockedClient\HandlerBuilder;
use DoppioGancio\MockedClient\MockedGuzzleClientBuilder;
use DoppioGancio\MockedClient\Route\RouteBuilder;
use Exception;
use Http\Discovery\Psr17FactoryDiscovery;
use PHPUnit\Framework\TestCase;

use function assert;

class MergeRequestApiTest extends TestCase
{
    public function testList(): void
    {
        $repo = $this->getMergeRequestRepository();

        /** @var MergeRequest[] $list */
        $list = $repo->list('project-name')->wait();

        $this->assertCount(1, $list);
        $mr = $list[0];

        $this->assertEquals(1, $mr->getId());
        $this->assertEquals(1, $mr->getIid());
        $this->assertEquals(3, $mr->getProjectId());
        $this->assertEquals('test1', $mr->getTitle());
        $this->assertEquals('fixed login page css paddings', $mr->getDescription());

        $this->assertEquals('merged', $mr->getState());
        $this->assertEquals('2017-04-29T08:46:00Z', $mr->getCreatedAt());
        $this->assertEquals('2017-04-29T08:46:00Z', $mr->getUpdatedAt());

        $mergedBy = $mr->getMergedBy();
        if ($mergedBy === null) {
            throw new Exception('mergedBy should not be null');
        }

        $this->assertEquals(87854, $mergedBy->getId());
        $this->assertEquals('Douwe Maan', $mergedBy->getName());
        $this->assertEquals('DouweM', $mergedBy->getUsername());
        $this->assertEquals('active', $mergedBy->getState());
        $this->assertEquals('https://gitlab.com/DouweM', $mergedBy->getWebUrl());

        $this->assertEquals('2018-09-07T11:16:17.520Z', $mr->getMergedAt());
        $this->assertNull($mr->getClosedAt());
        $this->assertNull($mr->getClosedBy());

        $this->assertEquals('master', $mr->getTargetBranch());
        $this->assertEquals('test1', $mr->getSourceBranch());

        $this->assertEquals(1, $mr->getUserNotesCount());
        $this->assertEquals(0, $mr->getUpvotes());
        $this->assertEquals(0, $mr->getDownvotes());

        $user = $mr->getAuthor();
        $this->assertEquals(1, $user->getId());
        $this->assertEquals('Administrator', $user->getName());
        $this->assertEquals('admin', $user->getUsername());
        $this->assertEquals('active', $user->getState());
        $this->assertNull($user->getAvatarUrl());
        $this->assertEquals('https://gitlab.example.com/admin', $user->getWebUrl());

        $assignee = $mr->getAssignee();
        if ($assignee === null) {
            throw new Exception('assignee should not be null');
        }

        $this->assertEquals(1, $assignee->getId());
        $this->assertEquals('Administrator', $assignee->getName());
        $this->assertEquals('admin', $assignee->getUsername());
        $this->assertEquals('active', $assignee->getState());
        $this->assertEquals('https://gitlab.example.com/admin', $assignee->getWebUrl());

        $this->assertEquals(
            [
                new User(
                    12,
                    'Miss Monserrate Beier',
                    'axel.block',
                    'active',
                    'http://www.gravatar.com/avatar/46f6f7dc858ada7be1853f7fb96e81da?s=80&d=identicon',
                    'https://gitlab.example.com/axel.block'
                ),
            ],
            $mr->getAssignees()
        );

        $this->assertEquals(
            [
                new User(
                    2,
                    'Sam Bauch',
                    'kenyatta_oconnell',
                    'active',
                    'https://www.gravatar.com/avatar/956c92487c6f6f7616b536927e22c9a0?s=80&d=identicon',
                    'http://gitlab.example.com//kenyatta_oconnell'
                ),
            ],
            $mr->getReviewers()
        );

        $this->assertEquals(2, $mr->getSourceProjectId());
        $this->assertEquals(3, $mr->getTargetProjectId());

        $this->assertFalse($mr->isDraft());
        $this->assertFalse($mr->isWorkInProgress());

        if ($mr->getMilestone() === null) {
            throw new Exception('milestone should not be null');
        }

        $this->assertMilestone($mr->getMilestone());
    }

    private function assertMilestone(Milestone $m): void
    {
        $this->assertEquals(
            new Milestone(
                5,
                1,
                3,
                'v2.0',
                'Assumenda aut placeat expedita exercitationem labore sunt enim earum.',
                'closed',
                '2015-02-02T19:49:26.013Z',
                '2015-02-02T19:49:26.013Z',
                '2018-09-22',
                '2018-08-08',
                'https://gitlab.example.com/my-group/my-project/milestones/1'
            ),
            $m
        );

        $this->assertEquals(5, $m->getId());
        $this->assertEquals(1, $m->getIid());
        $this->assertEquals(3, $m->getProjectId());

        $this->assertEquals('v2.0', $m->getTitle());
        $this->assertEquals(
            'Assumenda aut placeat expedita exercitationem labore sunt enim earum.',
            $m->getDescription()
        );
        $this->assertEquals('closed', $m->getState());

        $this->assertEquals('2015-02-02T19:49:26.013Z', $m->getCreatedAt());
        $this->assertEquals('2015-02-02T19:49:26.013Z', $m->getUpdatedAt());
        $this->assertEquals('2018-09-22', $m->getDueDate());
        $this->assertEquals('2018-08-08', $m->getStartDate());
        $this->assertEquals('https://gitlab.example.com/my-group/my-project/milestones/1', $m->getWebUrl());
    }

    public function testCreate(): void
    {
        $repo  = $this->getMergeRequestRepository();
        $newMr = $repo->create(new MergeRequestCreate(
            'aaa',
            'aaa',
            'aaa',
            'aaa',
            'aaa',
        ))->wait();
        assert($newMr instanceof MergeRequest);

        $this->assertEquals('fixed login page css paddings', $newMr->getDescription());
        $this->assertTrue($newMr->isMergeWhenPipelineSucceeds());
        $this->assertEquals('can_be_merged', $newMr->getMergeStatus());
        $this->assertEquals('8888888888888888888888888888888888888888', $newMr->getSha());
        $this->assertEquals(null, $newMr->getMergeCommitSha());
        $this->assertEquals(null, $newMr->getSquashCommitSha());
        $this->assertEquals(['Community contribution', 'Manage'], $newMr->getLabels());
    }

    public function testMerge(): void
    {
        $repo = $this->getMergeRequestRepository();

        $mr = $repo->merge('project-name', 123)->wait();
        assert($mr instanceof MergeRequest);

        $this->assertEquals('merged', $mr->getState());
    }

    public function getMergeRequestRepository(): MergeRequestApi
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
                ->withPath('projects/project-name/merge_requests')
                ->withFileResponse(__DIR__ . '/../fixtures/merge_request.list.json')
                ->build()
        );

        $handlerBuilder->addRoute(
            $rb->new()
                ->withMethod('POST')
                ->withPath('projects/project-name/merge_requests')
                ->withFileResponse(__DIR__ . '/../fixtures/merge_request.create.json')
                ->build()
        );

        $handlerBuilder->addRoute(
            $rb->new()
                ->withMethod('PUT')
                ->withPath('projects/project-name/123/merge')
                ->withFileResponse(__DIR__ . '/../fixtures/merge_request.merge.json')
                ->build()
        );

        $client = (new MockedGuzzleClientBuilder($handlerBuilder))->build();
        return (new Client($client))->mergeRequest();
    }
}
