<?php

namespace App\Http\Controllers\Backend;

use App\Enums\Message;
use App\Helper\Helper;
use App\Helper\Toastr;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Services\SliderService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {

        try {
            $this->authorize('slider_view', Slider::class);
            $sliders = SliderService::getAll()->sortByDesc('id');
            return view('backend.pages.sliders.index', compact('sliders'));
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
            $this->authorize('slider_create', Slider::class);
            return view('backend.pages.sliders.create');
        } catch (AuthorizationException $e) {
            Toastr::warning(Message::UN_AUTHORIZED);
            return back();
        } catch (\Exception $e) {
            Toastr::error(Message::FAILED);
            return back();
        }
    }

    public function edit(Slider $slider)
    {

        try {
            $this->authorize('slider_edit', $slider);
            return view('backend.pages.sliders.edit', compact('slider'));
        } catch (AuthorizationException $e) {
            Toastr::warning(Message::UN_AUTHORIZED);
            return back();
        } catch (\Exception $e) {
            Toastr::error(Message::FAILED);
            return back();
        }
    }

    public function delete(Slider $slider)
    {
        try {
            $this->authorize('slider_delete', $slider);
            if (!$slider) :
                Toastr::error(Message::NOT_FOUND);
                return back();
            endif;
            if ($slider->image) :
                Helper::deleteOldImage($slider->image);
            endif;
            $slider->delete($slider);
            Toastr::success(Message::DELETED);
            return back();
        } catch (AuthorizationException $e) {
            Toastr::warning(Message::UN_AUTHORIZED);
            return back();
        } catch (\Exception $e) {
            Toastr::error(Message::FAILED);
            return back();
        }
    }
}
