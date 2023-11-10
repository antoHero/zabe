<?php

namespace Tests\Feature;

use App\Livewire\{IdeaIndex, IdeaShow};
use App\Models\{Category, Idea, Status, User, Vote};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class VoteTest extends TestCase
{
    use RefreshDatabase;

    public function test_show_page_contains_idea_show_livewire_component()
    {
        $user = User::factory()->create();

        $category = Category::factory()->create(['name' => 'Laravel']);

        $statusOpen = Status::factory()->create(['name' => 'Open']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $statusOpen->id,
            'title' => 'My first Idea',
            'description' => 'This is my first idea'
        ]);

        $this->get(route('idea.show', $idea))
            ->assertSeeLivewire('idea-show');
    }

    public function test_show_page_correctly_receives_votes_count()
    {
        $user = User::factory()->create();

        $userTwo = User::factory()->create();

        $category = Category::factory()->create(['name' => 'Laravel']);

        $statusOpen = Status::factory()->create(['name' => 'Open']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $statusOpen->id,
            'title' => 'My first Idea',
            'description' => 'This is my first idea'
        ]);

        Vote::factory()->create([
            'user_id' => $user->id,
            'idea_id' => $idea->id
        ]);

        Vote::factory()->create([
            'user_id' => $userTwo->id,
            'idea_id' => $idea->id
        ]);

        $this->get(route('idea.show', $idea))
            ->assertViewHas('voteCount', 2);
    }

    public function test_vote_count_show_correctly_on_show_livewire_component()
    {
        $user = User::factory()->create();


        $category = Category::factory()->create(['name' => 'Laravel']);

        $statusOpen = Status::factory()->create(['name' => 'Open']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $statusOpen->id,
            'title' => 'My first Idea',
            'description' => 'This is my first idea'
        ]);

        Vote::factory()->create([
            'user_id' => $user->id,
            'idea_id' => $idea->id
        ]);

        Livewire::test(IdeaShow::class, [
            'idea' => $idea,
            'voteCount' => 2
        ])
        ->assertSet('voteCount', 2)
        ->assertSeeHtml('<div class="text-xl leading-snug">2</div>')
        ->assertSeeHtml('<div class="text-sm font-bold leading-none">2</div>');
    }

    public function test_index_page_contains_idea_index_livewire_component()
    {
        $user = User::factory()->create();

        $category = Category::factory()->create(['name' => 'Laravel']);

        $statusOpen = Status::factory()->create(['name' => 'Open']);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $statusOpen->id,
            'title' => 'My first Idea',
            'description' => 'This is my first idea'
        ]);

        $this->get(route('idea.index'))
            ->assertSeeLivewire('idea-index');
    }

    public function test_index_page_correctly_receives_votes_count()
    {
        $user = User::factory()->create();

        $userTwo = User::factory()->create();

        $category = Category::factory()->create(['name' => 'Laravel']);

        $statusOpen = Status::factory()->create(['name' => 'Open']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $statusOpen->id,
            'title' => 'My first Idea',
            'description' => 'This is my first idea'
        ]);

        Vote::factory()->create([
            'user_id' => $user->id,
            'idea_id' => $idea->id
        ]);

        Vote::factory()->create([
            'user_id' => $userTwo->id,
            'idea_id' => $idea->id
        ]);

        $this->get(route('idea.index'))
            ->assertViewHas('ideas', fn ($ideas) => $ideas->first()->votes_count == 2);
    }

    public function test_vote_count_show_correctly_on_index_livewire_component()
    {
        $user = User::factory()->create();

        $category = Category::factory()->create(['name' => 'Laravel']);

        $statusOpen = Status::factory()->create(['name' => 'Open']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $statusOpen->id,
            'title' => 'My first Idea',
            'description' => 'This is my first idea'
        ]);

        Vote::factory()->create([
            'user_id' => $user->id,
            'idea_id' => $idea->id
        ]);

        Livewire::test(IdeaIndex::class, [
            'idea' => $idea,
            'voteCount' => 2
        ])
        ->assertSet('voteCount', 2)
        ->assertSeeHtml('<div class="font-semibold text-2xl">2</div>')
        ->assertSeeHtml('<div class="text-sm font-bold leading-none">2</div>');
    }
}
