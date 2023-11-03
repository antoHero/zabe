<?php

namespace Tests\Feature;

use App\Models\Idea;
use Illuminate\Foundation\Testing\{RefreshDatabase, WithFaker};
use Tests\TestCase;

class ShowIdeasTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_of_ideas_shows_on_index_page()
    {
        $ideaOne = Idea::factory()->create([
            'title' => 'Idea one',
            'description' => 'Description for idea one'
        ]);

        $ideaTwo = Idea::factory()->create([
            'title' => 'Idea two',
            'description' => 'Description for idea two'
        ]);


        $response = $this->get(route('idea.index'));

        $response->assertSuccessful();

        $response->assertSee($ideaOne->title);
        $response->assertSee($ideaOne->description);
        $response->assertSee($ideaTwo->title);
        $response->assertSee($ideaTwo->description);
    }

    public function test_single_idea_shows_correctly_on_details_page()
    {
        $idea = Idea::factory()->create([
            'title' => 'Idea one',
            'description' => 'Description for idea one'
        ]);


        $response = $this->get(route('idea.show', $idea));

        $response->assertSuccessful();

        $response->assertSee($idea->title);
        $response->assertSee($idea->description);
    }
}
