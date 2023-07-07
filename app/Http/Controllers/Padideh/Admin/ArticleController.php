<?php

namespace App\Http\Controllers\Padideh\Admin;

use App\Http\Controllers\Controller;
use App\Models\Padideh\Article;
use App\Repositories\Admin\ArticleRepo;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

public $articleCategoryRepo;
   public function __construct(ArticleRepo $articleRepo)
   {
       $this->articleRepo = $articleRepo;
   }

    public function index()
    {
        return $this->articleRepo->all();
    }


    public function create()
    {
        return $this->articleRepo->create();

    }


    public function store(Request $request)
    {
        $article = $this->articleRepo->store($request);
        if($article){
            return redirect()->route('panel.articles.index')->with([
                'success' => 'با موفقیت ثبت شد'
            ]);
        }
    }


    public function show(Article $article)
    {
        return $this->articleRepo->show($article);

    }


    public function edit(Article $article)
    {
        return $this->articleRepo->edit($article);

    }


    public function update(Request $request,Article $article)
    {
        $article = $this->articleRepo->update($request,$article);
        if($article){
            return redirect()->back()->with([
                'success' => 'با موفقیت ثبت شد'
            ]);
        }
    }


    public function destroy(Article $article)
    {
        $result = $this->articleRepo->destroy($article);
        if($result){
            return redirect()->back()->with([
                'success' => 'با موفقیت حذف شد'
            ]);
        }

    }
}
