<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;

use App\Click;
use App\Interface\ClickInterface;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClickRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_index()
    {
        // Replicate the interface
        $repository = $this->app->make(ClickInterface::class);
        // Create test click entry for today
        $click = factory(Click::class)->create();
        // Fetch click entry today
        $clickToday = $repository->index(Carbon::today());
        // Assert fetch and newly create click is same
        $this->assertSame($click['id'], $clickToday['id']);
        // Assert fetch and newly create click is same
        $this->assertSame($click['date']->format('Y-m-d 00:00:00'), $clickToday['date']);
    }

    public function test_store_or_update()
    {
        // Replicate the interface
        $repository = $this->app->make(ClickInterface::class);
        // create today date instance
        $today = Carbon::today();
        // Create or Update click entry today
        $click = $repository->storeOrUpdate($today);
         // Assert that click was created or updated have
        $this->assertNotEmpty($click);
        // Assert newly create or update click entry is same today date
        $this->assertSame($today->format('Y-m-d 00:00:00'), $click['date']);
    }
}

