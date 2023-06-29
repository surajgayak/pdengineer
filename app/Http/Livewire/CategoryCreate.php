<?php

namespace App\Http\Livewire;

use App\Enums\Message;
use App\Exceptions\ServiceDownException;
use App\Helper\Helper;
use App\Models\Category;
use App\Services\CategoryService;
use Exception;
use Illuminate\Support\Arr;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class CategoryCreate extends Component
{
    use WithFileUploads;

    public $title, $image;

    public function render()
    {
        return view('livewire.category-create');
    }
    protected $rules = [
        'title' => 'required|max:255|unique:categories,title',
        'image' => 'image|nullable'
    ];


    public function store($category)
    {
        try {
            $this->validate();
            if ($this->image) :
                $image = Helper::saveImage($this->image, 'category', false, 'public');
                $category->image = $image;
            endif;
            $category->title = $this->title;
            $category->slug = Str::slug($this->title);
            $category->save();
            $this->reset();
            $this->dispatchBrowserEvent(
                'alert',
                [
                    'type' => 'success',
                    'message' => Message::CREATED,
                ]
            );
        } catch (Exception $e) {
            $this->validate();
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'error',  'message' => Message::FAILED]
            );
        }
    }
}
