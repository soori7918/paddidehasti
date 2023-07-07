<?php
namespace App\Repositories\Admin;

use App\Http\Traits\FileUploadTrait;
use App\Models\Padideh\Story;
use Illuminate\Support\Facades\File;

class StoryRepo {
    use FileUploadTrait;

    public function all(){
        $stories = Story::latest()->paginate(15);
        return view('Padideh.stories.index')->with([
            'stories' => $stories,
        ]);
    }

    public function create()
    {
        return view('Padideh.stories.create');
    }

    public function store($request)
    {
        $image = null;
        if ($request->hasFile('image')) {
            $image = $this->uploadFile($request->image, Story::UPLOAD_URL, 'story_image_', 'storage', ['png','jpeg', 'jpg', 'svg']);
        }
        Story::create([
            'title' => $request->title,
            'image' => $image,
            'is_active' => $request->input('is_active') ? true : false,
        ]);

        return \redirect()->route('panel.stories.index')->with([
            'success' => 'با موفقیت ثبت شد'
        ]);
    }
    public function show($story)
    {
        return view('Padideh.stories.show')->with([
            'story' => $story
        ]);
    }
    public function edit($story)
    {
        return view('Padideh.stories.edit')->with([
            'story' => $story,
        ]);
    }

    public function update($request,$story){
        $image = null;
        if ($request->hasFile('image')) {
            $this->removeFile('storage', Story::SHOW_URL.$story->image);
            $image = $this->uploadFile($request->image, Story::UPLOAD_URL, 'story_image_', 'storage', ['png','jpeg', 'jpg', 'svg']);
        }
        return $story->update([
            'title' => $request->title,
            'image' =>  $image ?? $story->image,
            'is_active' => $request->input('is_active') ? true : false,
        ]);
        
    }


    public function destroy($story)
    {
        $this->removeFile('storage', Story::SHOW_URL.$story->image);
        return $story->delete();
        
    }


    //api

    public function getStory($request){
        return Story::query()->active()->get();
    } 
}
