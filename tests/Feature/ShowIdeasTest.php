<?php

namespace Tests\Feature;

use App\Models\{Category, Idea};
use Illuminate\Foundation\Testing\{RefreshDatabase, WithFaker};
use Tests\TestCase;

class ShowIdeasTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_of_ideas_shows_on_index_page()
    {
        $categoryOne = Category::factory()->create(['name' => 'AWS Lambda']);
        $categoryTwo = Category::factory()->create(['name' => 'Laravel']);

        $ideaOne = Idea::factory()->create([
            'title' => 'Idea one',
            'category_id' => $categoryOne->id,
            'description' => 'Description for idea one'
        ]);

        $ideaTwo = Idea::factory()->create([
            'title' => 'Idea two',
            'category_id' => $categoryTwo->id,
            'description' => 'Description for idea two'
        ]);


        $response = $this->get(route('idea.index'));

        $response->assertSuccessful();

        $response->assertSee($ideaOne->title);
        $response->assertSee($ideaOne->description);
        $response->assertSee($categoryOne->name);
        $response->assertSee($ideaTwo->title);
        $response->assertSee($ideaTwo->description);
        $response->assertSee($categoryTwo->name);
    }

    public function test_single_idea_shows_correctly_on_details_page()
    {
        $category = Category::factory()->create(['name' => 'AWS Lambda']);

        $idea = Idea::factory()->create([
            'title' => 'Idea one',
            'category_id' => $category->id,
            'description' => 'Description for idea one'
        ]);


        $response = $this->get(route('idea.show', $idea));

        $response->assertSuccessful();

        $response->assertSee($idea->title);
        $response->assertSee($idea->description);
        $response->assertSee($category->name);
    }

    public function test_same_idea_title_with_different_slugs()
    {
        $categoryOne = Category::factory()->create(['name' => 'AWS Lambda']);
        $categoryTwo = Category::factory()->create(['name' => 'Laravel']);

        $ideaOne = Idea::factory()->create([
            'title' => 'Idea one',
            'category_id' => $categoryOne->id,
            'description' => 'Description for idea one'
        ]);

        $ideaTwo = Idea::factory()->create([
            'title' => 'Idea one',
            'category_id' => $categoryTwo->id,
            'description' => 'Description for second idea'
        ]);

        $response = $this->get(route('idea.show', $ideaOne));

        $response->assertSuccessful();

        $response = $this->get(route('idea.show', $ideaTwo));

        $response->assertSuccessful();

        $this->assertTrue(request()->path() === 'ideas/idea-one-2');
    }
}
