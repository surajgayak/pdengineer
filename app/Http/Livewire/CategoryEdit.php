<?php

namespace App\Http\Livewire;

use App\Enums\Message;
use App\Helper\Helper;
use App\Models\Category;
use App\Services\CategoryService;
use Exception;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class CategoryEdit extends Component
{
    use WithFileUploads;
    public $image, $title, $category_id, $oldImage;
    public  $category_data;
    public $hasImage = false;

    public function mount(Category $category_data)
    {
        $this->category_data = $category_data;
        $this->title = $this->category_data->title;
        $this->oldImage = $this->category_data->image;
        $this->category_id = $this->category_data->id;
    }
    protected  function rules()
    {
        return [
            'title' => 'required|max:255|unique:categories,title,' . $this->category_id,
            'image' => 'nullable',

        ];
    }


    public function update()
    {
        try {
            $this->validate();
            $category = CategoryService::getById($this->category_id);
            if ($this->image) :
                $category->image !== null ?  Helper::deleteOldImage($category->image) : NULL;
                $image = Helper::saveImage($this->image, 'category', 0, 'public');
                $category->image = $image;
            endif;
            $category->title = $this->title;
            $category->slug = Str::slug($this->title);
            $category->save();
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'success', 'message' => Message::UPDATED]
            );
        } catch (\Exception $e) {
            $this->validate();
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'error',  'message' => Message::FAILED]
            );
        }
    }
    public function render()
    {
        return view('livewire.category-edit');
    }
}
