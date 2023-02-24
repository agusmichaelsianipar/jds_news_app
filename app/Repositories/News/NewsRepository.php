<?php

namespace App\Repositories\News;

use App\Models\News;
use App\Http\Resources\NewsResource;

class NewsRepository implements NewsRepositoryInterface {
    
    private $model;

    public function __construct(News $model){
        $this->model = $model;
    }

    public function getNews(){
        $data = News::paginate(10);
        return [
            'key' => NewsResource::collection($data)->response()->getData(true)
        ];
    }

    public function getNewsById($id){
        return new NewsResource($this->model->with('comment')->findOrFail($id));
    }

    public function storeNews($data){
        $news = News::create([
            'user_id' => $data->user,
            'title' => $data->title,
            'content' => $data->content,
            'image' => $data->image
        ]);

        return $news;
    }
    
    public function updateNewsById($data, $id){

        News::where('id', $id)->update([
            'title' => $data->title,
            'content' => $data->content,
            'image' => $data->image

        ]);

    }
    
    public function destroyNewsById($id){
         
        $news = News::findOrFail($id);

        $news->delete();

    }
}

