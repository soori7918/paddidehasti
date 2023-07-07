<?php

namespace App\Http\Controllers\Padideh\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Padideh\BannerResource;
use App\Repositories\Admin\BannerRepo;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    private $bannerRepository;

    public function __construct(BannerRepo $bannerRepo)
    {
        $this->bannerRepository = $bannerRepo;
    }

    public function bannerList(Request $request){
        $banners = BannerResource::collection($this->bannerRepository->getbanners($request));
        return $this->successResponse('لیست بنرها', $banners);
    }
}
