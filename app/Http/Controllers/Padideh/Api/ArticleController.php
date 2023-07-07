<?php

namespace App\Http\Controllers\Padideh\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Padideh\ArticleResource;
use App\Repositories\Admin\ArticleRepo;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    private $articleRepository;
    public function __construct(ArticleRepo $articleRepo)
    {
        $this->articleRepository = $articleRepo;
    }
    public function articleList(Request $request)
    {
        $stories = ArticleResource::collection($this->articleRepository->getarticles($request));
        return $this->successResponse('لیست مقالات', $stories);

    }
}
