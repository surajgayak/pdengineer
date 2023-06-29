<?php

namespace App\Http\Controllers\Backend;

use App\Enums\Message;
use App\Helper\Toastr;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            $this->authorize('category_view', Category::class);
            $categories = CategoryService::getAll();
            return view('backend.pages.categories.index', compact('categories'));
        } catch (AuthorizationException $e) {
            Toastr::warning(Message::UN_AUTHORIZED);
            return back();
        } catch (\Exception $e) {
            Toastr::error(Message::FAILED);
            return back();
        }
    }
    public function create()
    {
        try {
            $this->authorize('category_create', Category::class);
            return view('backend.pages.categories.create');
        } catch (AuthorizationException $e) {
            Toastr::warning(Message::UN_AUTHORIZED);
            return back();
        } catch (\Exception  $e) {
            Toastr::error(Message::FAILED);
            return back();
        }
    }

    public function edit(Category $category)
    {
        try {
            $this->authorize('category_edit', $category);
            return view('backend.pages.categories.edit', compact('category'));
        } catch (AuthorizationException $e) {
            Toastr::warning(Message::UN_AUTHORIZED);
            return back();
        } catch (\Exception  $e) {
            Toastr::error(Message::FAILED);
            return back();
        }
    }
}
