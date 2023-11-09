<?php

namespace App\Livewire;

use App\Models\{Category, Idea};
use Livewire\Component;
use Symfony\Component\HttpFoundation\Response;

class CreateIdea extends Component
{
    public $title;
    public $description;
    public $category = 1;

    protected $rules = [
        'title' => 'required|min:4',
        'category' => 'required|integer',
        'description' => 'required|min:4'
    ];

    public function handleCreate()
    {
        if(auth()->check()) {
            $this->validate();
            Idea::create([
                'user_id' => auth()->id(),
                'category_id' => $this->category,
                'status_id' => 1,
                'title' => $this->title,
                'description' => $this->description
            ]);

            session()->flash('success_message', 'Idea created successfully');

            $this->reset();

            return redirect()->route('idea.index');
        }

        abort(Response::HTTP_FORBIDDEN);
    }

    public function render()
    {
        return view('livewire.create-idea', [
            'categories' => Category::all()
        ]);
    }
}
