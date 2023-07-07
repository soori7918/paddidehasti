<?php

namespace App\Http\Controllers\Padideh\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Padideh\StoryResource;
use App\Models\Padideh\Story;
use App\Repositories\Admin\StoryRepo;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    private $stroyRepository;
    public function __construct(StoryRepo $storyRepo)
    {
        $this->stroyRepository = $storyRepo;
    }
    public function storyList(Request $request)
    {
        $stories = StoryResource::collection($this->stroyRepository->getStory($request));
        return $this->successResponse('لیست استوری', $stories);

    }
}
