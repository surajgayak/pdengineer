<?php

namespace App\Http\Controllers\Backend;

use App\Enums\Message;
use App\Helper\Helper;
use App\Helper\Toastr;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\ProductService;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {

        try {
            $this->authorize('product_view', Product::class);
            $products = ProductService::getAll()->sortBy('title');
            return view('backend.pages.products.index', compact('products'));
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
            $this->authorize('product_create', Product::class);
            return view('backend.pages.products.create');
        } catch (AuthorizationException $e) {
            Toastr::warning(Message::UN_AUTHORIZED);
            return back();
        } catch (\Exception $e) {
            Toastr::error(Message::FAILED);
            return back();
        }
    }

    public function edit(Product $product)
    {

        try {
            $this->authorize('product_edit', $product);
            return view('backend.pages.products.edit', compact('product'));
        } catch (AuthorizationException $e) {
            Toastr::warning(Message::UN_AUTHORIZED);
            return back();
        } catch (\Exception $e) {
            Toastr::error(Message::FAILED);
            return back();
        }
    }

    public function delete(Product $product)
    {
        try {
            $this->authorize('product_delete', $product);
            if (!$product) :
                Toastr::error(Message::NOT_FOUND);
                return back();
            endif;
            if ($product->image) :
                Helper::deleteOldImage($product->image);
            endif;
            $product->delete($product);
            Toastr::success(Message::DELETED);
            return back();
        }  catch (AuthorizationException $e) {
            Toastr::warning(Message::UN_AUTHORIZED);
            return back();
        }
        catch (Exception $e) {
            Toastr::error(Message::FAILED);
            return back();
        }
    }
}
