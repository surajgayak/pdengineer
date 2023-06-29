<?php

namespace App\Http\Controllers\Backend;

use App\Enums\ClientPartnerType;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Services\CategoryService;
use App\Services\ClientPartnerService;
use App\Services\PortfolioService;
use App\Services\ProductService;
use App\Services\ProjectService;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Services\Services;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $userCount = UserService::getAll()->count();
        // $categoryCount = CategoryService::getAll()->count();
        // $productCount = ProductService::getAll()->count();
        // $serviceCount = Services::getAll()->count();
        // $projectCount = ProjectService::getAll()->count();
        // $clientCount = ClientPartnerService::getClientPartnerByType(ClientPartnerType::CLIENT)->count();
        // $partnerCount = ClientPartnerService::getClientPartnerByType(ClientPartnerType::PARTNER)->count();
        // $portfolioCount = PortfolioService::getAll()->count();
        return view('backend.pages.dashboard', compact('userCount'));
    }
}
