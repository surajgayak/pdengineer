<?php

namespace App\Http\Controllers;

use App\Enums\ClientPartnerType;
use App\Models\Product;
use App\Models\Project;
use App\Models\Service;
use App\Services\ClientPartnerService;
use App\Services\PortfolioService;
use App\Services\SliderService;

class FrontendController extends Controller
{
    public function welcome()
    {
        // $clients = ClientPartnerService::getClientPartnerByType(ClientPartnerType::CLIENT)->orderBy('name','ASC')->get();
        // $partners = ClientPartnerService::getClientPartnerByType(ClientPartnerType::PARTNER)->orderBy('name','ASC')->get();
        // $sliders = SliderService::getAll();
        // $portfolios = PortfolioService::getAll()->sortByDesc('id');
        return view('frontend.pages.welcome');
    }
 
}
