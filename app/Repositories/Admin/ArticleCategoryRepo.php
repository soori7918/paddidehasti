<?php
namespace App\Repositories\Admin;

use App\Http\Traits\FileUploadTrait;
use App\Models\Padideh\ArticleCategory;

class ArticleCategoryRepo {
    use FileUploadTrait;

    public function all(){
        $article_categories = ArticleCategory::latest()->paginate(15);
        return view('Padideh.article_categories.index')->with([
            'article_categories' => $article_categories,
        ]);
    }

    public function create()
    {
        $categories = ArticleCategory::all();
        return view('Padideh.article_categories.create')->with([
            'categories' => $categories
        ]);
    }

    public function store($request)
    {
        $image = null;
        if ($request->hasFile('image')) {
            $image = $this->uploadFile($request->image, ArticleCategory::UPLOAD_URL, 'article_category_image_', 'storage', ['png','jpeg', 'jpg', 'svg']);
        }

        return ArticleCategory::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'image' => $image
        ]);

      
    }

    public function destroy($article_category)
    {
        $this->removeFile('storage', ArticleCategory::SHOW_URL.$article_category->image);
        return $article_category->delete();
        
    }


}
