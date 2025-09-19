<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Listing;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    // use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_listings(): void
    {
        $listings = Listing::latest()->get();
        $listing = $listings->first();

        $response = $this->get('/listings');

        $response->assertStatus(200);
        $response->assertViewHas('listings', function($collection) use ($listing) {
            return $collection->contains($listing);
        });
    }

    public function test_listings_pagination(): void
    {
        $listings = Listing::latest()->get();
        // last listing is not part of the page, it's paginated
        $listing = $listings->last();

        $response = $this->get('/listings');

        $response->assertStatus(200);
        $response->assertViewHas('listings', function($collection) use ($listing) {
            return !$collection->contains($listing);
        });
    }

    // public function test_listing_update_with_logged_user() {
    //     $user = User::factory()->create();
    //     $listing = Listing::factory()->create(['user_id' => $user->id]);

    //     $url = URL('listings/update', $listing->id);
    //     // $postData = get_object_vars($listing);
    //     // $postData = get_object_vars($listing);
    //     // $postData['title'] = 'MyNewTitle';

    //     $response = $this->actingAs($user)
    //         ->post($url, data: []);
    //      dd($response);
    //     // $response->assertStatus(200);
    //     // $editUrl = URL('listings/edit', $listing->id);
    //     // $response->assertRedirect($editUrl);
    // }

    public function test_listing_update_with_different_logged_user() {
        $user = User::factory()->create();
        $listing = Listing::factory()->create(['user_id' => $user->id]);
        $wrongUser = User::factory()->create();

        $url = URL('listings/update', $listing->id);
        $response = $this->actingAs($wrongUser)
            ->post($url, []);
        $response->assertStatus(405);
    }

    public function test_listing_update_not_logged_in() {
        $user = User::factory()->create();
        $listing = Listing::factory()->create(['user_id' => $user->id]);

        $url = URL('listings/edit', $listing->id);
        $response = $this->get($url);
        $response->assertRedirect(URL('login'));
    }
}
