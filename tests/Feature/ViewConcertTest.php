<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Concert;
use Carbon\Carbon;

class ViewConcertListingTest extends TestCase
{

  use DatabaseMigrations;

  /** @test */
  function user_can_view_a_concert_listing ()
  {
      // Arrange
      // Create a concert
      $concert = Concert::create([
        'title' => 'The Red Chord',
        'subtitle' => 'with Aminosity',
        'date' => Carbon::parse('December 13, 2016 8:00pm'),
        'ticket_price' => 3250,
        'venue' => 'The Mosh Pit',
        'venue_address' => '123 Example Lane',
        'city' => 'Laraville',
        'state' => 'ON',
        'zip' => 17916,
        'additional_information' => 'For tickets, call (555)1323 - 123123',
      ]);

      // Act
      // View The concert listing
      $this->browse(function ($browser) {
        $browser->visit('/concerts/' . $concert->id)
          ->assertSee('The Red Chord')
          ->assertSee('with Aminosity')
          ->assertSee('December 13, 2016')
          ->assertSee('8:00pm')
          ->assertSee('32.50')
          ->assertSee('The Mosh Pit')
          ->assertSee('123 Example Lane')
          ->assertSee('Laraville, ON 17916')
          ->assertSee('For tickets, call (555)1323 - 123123');
      });
  }
}
