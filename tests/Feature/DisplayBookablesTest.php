<?php

namespace Tests\Feature;

use App\Models\BookableFlight;
use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class DisplayBookablesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function show_all_bookables()
    {
        $event = factory(Event::class)->create();
        $flights = factory(BookableFlight::class, 3)->create([
            'event_id' => $event->id,
        ]);

        $displayBookablesComponent = Livewire::test('display-bookables', ['event' => $event]);

        $bookables = $displayBookablesComponent->viewData('bookables');

        $flights->assertEquals($bookables);
    }

    /** @test */
    public function a_bookable_can_be_deleted()
    {
        $this->assertTrue(false);
    }
}