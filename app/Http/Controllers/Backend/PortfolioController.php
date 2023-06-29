<?php

namespace App\Http\Controllers\Backend;

use App\Enums\Message;
use App\Helper\Helper;
use App\Helper\Toastr;
use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Services\PortfolioService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {

        try {
            $this->authorize('portfolio_view', Portfolio::class);
            $portfolios = PortfolioService::getAll()->sortByDesc('id');
            return view('backend.pages.portfolios.index', compact('portfolios'));
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
            $this->authorize('portfolio_create', Portfolio::class);
            return view('backend.pages.portfolios.create');
        } catch (AuthorizationException $e) {
            Toastr::warning(Message::UN_AUTHORIZED);
            return back();
        } catch (\Exception $e) {
            Toastr::error(Message::FAILED);
            return back();
        }
    }

    public function edit(Portfolio $portfolio)
    {

        try {
            $this->authorize('portfolio_edit', $portfolio);
            return view('backend.pages.portfolios.edit', compact('portfolio'));
        } catch (AuthorizationException $e) {
            Toastr::warning(Message::UN_AUTHORIZED);
            return back();
        } catch (\Exception $e) {
            Toastr::error(Message::FAILED);
            return back();
        }
    }

    public function delete(Portfolio $portfolio)
    {
        try {
            $this->authorize('portfolio_delete', $portfolio);
            if (!$portfolio) :
                Toastr::error(Message::NOT_FOUND);
                return back();
            endif;
            if ($portfolio->image) :
                Helper::deleteOldImage($portfolio->image);
            endif;
            $portfolio->delete($portfolio);
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
