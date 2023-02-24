<?php

namespace App\Http\Controllers;

use App\Events\LogActivityEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Repositories\News\NewsRepositoryInterface;

class NewsController extends Controller
{
    private $newsRepository;

    public function __construct(NewsRepositoryInterface $newsRepositoryInterface)
    {
        $this->middleware(['auth:api','isAdmin'])->except('index','show');

        $this->newsRepository = $newsRepositoryInterface;
    }

    public function index()
    {
        $response = $this->newsRepository->getNews();

        return response()->json([
            "status" => true,
            "data" => $response
        ], 200);
    }

    public function show($id){
        $response = $this->newsRepository->getNewsById($id);

        return response()->json([
            "status" => true,
            "data" => $response
        ]);
    }

    public function store(Request $request){
        $user_id = 1;
        $this->validate($request,[
            'title'=> 'required|string|max:255',
            'content'=> 'required|string',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $uploadFolder = 'assets/image';
        $file = $request->file('image');
        $image_uploaded_path = $file->store($uploadFolder, 'public');
        $uploadedImageResponse = array(
           "image_name" => basename($image_uploaded_path),
           "image_url" => Storage::disk('public')->url($image_uploaded_path),
           "mime" => $file->getClientMimeType() 
        );

        $request->image = 'storage/'.$uploadFolder.'/'.$uploadedImageResponse["image_name"];

        try {
            $response = $this->newsRepository->storeNews($request);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'error' => $ex->getMessage(),
            ], 500);
        }

        event(new LogActivityEvent("News successfully created!",$user_id,$request->url(),$request->method(), $request->ip(),$request->userAgent()));

        return response()->json([
            'status' => true,
            'data' => $response
        ],200);
    }

    public function update(Request $request, $id){
        $user_id = 1;
        $this->validate($request,[
            'title'=> 'required|string|max:255',
            'content'=> 'required|string',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        
        $uploadFolder = 'assets/image';
        $file = $request->file('image');
        $image_uploaded_path = $file->store($uploadFolder, 'public');
        $uploadedImageResponse = array(
           "image_name" => basename($image_uploaded_path),
           "image_url" => Storage::disk('public')->url($image_uploaded_path),
           "mime" => $file->getClientMimeType() 
        );

        $request->image = 'storage/'.$uploadFolder.'/'.$uploadedImageResponse["image_name"];

        try {
            $this->newsRepository->updateNewsById($request, $id);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'error' => $ex->getMessage(),
            ], 500);
        }

        event(new LogActivityEvent("News successfully updated!",$user_id, $request->url(),$request->method(), $request->ip(),$request->userAgent()));
        return response()->json([
            'status' => true,
        ],200);
    }
    
    public function destroy(Request $request, $id){
        $user_id = 1;
        try {
            $this->newsRepository->destroyNewsById($id);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'error' => $ex->getMessage(),
            ], 500);
        }

        event(new LogActivityEvent("News successfully deleted!",$user_id, $request->url(),$request->method(), $request->ip(),$request->userAgent()));
        return response()->json([
            'status' => true,
        ],200);
    }
}
