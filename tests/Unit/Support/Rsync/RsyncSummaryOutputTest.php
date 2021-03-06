<?php

namespace Spatie\BackupServer\Tests\Unit\Support\Rsync;

use Spatie\BackupServer\Tasks\Backup\Support\Rsync\RsyncSummaryOuput;
use Spatie\BackupServer\Tests\TestCase;

class RsyncSummaryOutputTest extends TestCase
{
    private ?RsyncSummaryOuput $rsyncSummary;

    public function setUp(): void
    {
        parent::setUp();

        $summary = file_get_contents(__DIR__ . '/stubs/rsyncSummary.txt');

        $this->rsyncSummary = new RsyncSummaryOuput($summary);
    }

    /** @test */
    public function it_can_get_the_average_speed_in_MB()
    {
        $this->assertEquals('5.17MB/s', $this->rsyncSummary->averageSpeedInMB());
    }

    /** @test */
    public function it_returns_0_when_the_average_speed_could_not_be_determined()
    {
        $rsyncSummary = new RsyncSummaryOuput('invalid-summary');

        $this->assertEquals("0MB/s", $rsyncSummary->averageSpeedInMB());
    }
}
