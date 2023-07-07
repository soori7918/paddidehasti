<?php

namespace App\Http\Controllers\Padideh\Admin;

use App\Http\Controllers\Controller;
use App\Models\Padideh\ArticleCategory;
use App\Repositories\Admin\ArticleCategoryRepo;
use Illuminate\Http\Request;

class ArticleCategoryController extends Controller
{
   public $articleCategoryRepo;
   public function __construct(ArticleCategoryRepo $articleCategoryRepo)
   {
       $this->articleCategoryRepo = $articleCategoryRepo;
   }
    public function index()
    {
        return $this->articleCategoryRepo->all();
    }


    public function create()
    {
        return $this->articleCategoryRepo->create();

    }


    public function store(Request $request)
    {
        $article_category = $this->articleCategoryRepo->store($request);
        if($article_category){
            return redirect()->route('panel.article_categories.index')->with([
                'success' => 'با موفقیت ثبت شد'
            ]);
        }
    }


    public function destroy(ArticleCategory $article_category)
    {
        $result = $this->articleCategoryRepo->destroy($article_category);
        if($result){
            return redirect()->back()->with([
                'success' => 'با موفقیت ثبت شد'
            ]);
        }

    }
}
