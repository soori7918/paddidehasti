<?php
namespace App\Repositories\Admin;

use App\Http\Traits\FileUploadTrait;
use App\Models\Padideh\Article;
use App\Models\Padideh\ArticleCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ArticleRepo {
    use FileUploadTrait;

    public function all(){
        $articles = Article::latest()->paginate(15);
        return view('Padideh.articles.index')->with([
            'articles' => $articles,
        ]);
    }

    public function create()
    {
        $categories = ArticleCategory::all();
        return view('Padideh.articles.create')->with([
            'categories' => $categories
        ]);
    }

    public function store($request)
    {
        $image = null;
        if ($request->hasFile('image')) {
            $image = $this->uploadFile($request->image, Article::UPLOAD_URL, 'article_image_', 'storage', ['png','jpeg', 'jpg', 'svg']);
        }
        $article = Article::create([
            'title' => $request->title,
            'short_description' => $request->short_description,
            'full_description' => $request->full_description,
            'published' => $request->published ? true : false,
            'can_comment' => $request->can_comment ? true : false,
            'user_id' => Auth::id(),
            'image' => $image,
        ]);

        $article->article_categories()->attach(
            $request->category_id
        );
        return $article;
      
    }

    public function show($article)
    {
        return view('Padideh.articles.show')->with([
            'article' => $article
        ]);
    }

    public function edit($article)
    {
        $categories = ArticleCategory::all();
        return view('Padideh.articles.edit')->with([
            'article' => $article,
            'categories' => $categories
        ]);
    }

    public function update($request,$article){
   
        $image = null;
        if ($request->hasFile('image')) {
            $this->removeFile('storage', Article::SHOW_URL.$article->image);
            $image = $this->uploadFile($request->image, Article::UPLOAD_URL, 'article_image_', 'storage', ['png','jpeg', 'jpg', 'svg']);
        }
        
        $article->update([
            'title' => $request->title,
            'short_description' => $request->short_description,
            'full_description' => $request->full_description,
            'published' => $request->published,
            'image' =>  $image ?? $article->image,
            'can_comment' =>  $request->can_comment,
            'can_rate' => $request->can_rate,
            'user_id' => Auth::id(),
        ]);

        $article->article_categories()->sync(
            $request->category_id
        );
        
    }


    public function destroy($article)
    {
        $this->removeFile('storage', Article::SHOW_URL.$article->image);
        return $article->delete();
       
    }

    //api

    public function getarticles($request)
    {
        return Article::query()->active()->get();
    }


}
