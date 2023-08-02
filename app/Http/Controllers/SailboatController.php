<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;
use Illuminate\Support\Facades\Auth;
use App\Models\Sailboat;
use App\Http\Resources\SailboatResource;
use App\Models\SailboatFaq as FAQ;
use App\Models\SailboatVideo as BoatVideo;
use App\Models\SailboatPhoto;

class SailboatController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $sailboats ='';
        $sailboats = Sailboat::where(function ($q) use($user) {
                if ($user && $user->role == 'Member') {
                    $q->where('user_id', $user->id);
                }
            })->orderBy('id', 'desc')->paginate(10);

            $options = [
                'displacements' => Sailboat::select('displacement')->distinct()->pluck('displacement')->toArray(),
                'battery_types' => Sailboat::select('battery_type')->distinct()->pluck('battery_type')->toArray(),
                'sailing_types' => Sailboat::select('sailing_type')->distinct()->pluck('sailing_type')->toArray(),
                'gensets' => Sailboat::select('genset')->distinct()->pluck('genset')->toArray(),
                'status' => Sailboat::select('status')->distinct()->pluck('status')->toArray(),
                'motors' => Sailboat::select('motor')->distinct()->pluck('motor')->toArray(),
            ];
       
        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'sailboats' => SailboatResource::collection($sailboats)->response()->getData(true)
            ]);
        }
        return view('admin.sailboats.index', compact('sailboats','options'));
    }

    public function create()
    {
        return view('admin.sailboats.create');
    }

    public function edit($id)
    {
        $sailboat = Sailboat::findOrFail($id);
        return view('admin.sailboats.edit', compact('sailboat'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'year' => 'required|numeric',
            'manufacturer' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'displacement' => 'required|string|max:255',
            'status' => 'required|string|in:Complete,In Process',
            'loa' => 'required|string|max:255',
            'motor' => 'required|string|max:255',
            'battery_brand' => 'required|string|max:255',
            'battery_type' => 'required|string|max:255',
            'solar_panel' => 'required|string|max:255',
            'wind_generator' => 'required|string|max:255',
            'genset' => 'required|string|max:255',
            'controller' => 'required|string|max:255',
            'sailing_type' => 'required|string|max:255',
            'description' => 'required',
            'faqs' => 'required|array',
            'faqs.*.question' => 'required',
            'faqs.*.answer' => 'required',
        ],[
            'faqs.*.question.required' => 'Empty questions are not accepted',
            'faqs.*.answer.required' => 'Empty answers are not accepted',
        ],[
            'user_id' => 'member',
            'sailing_type' => 'type of sailing',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 400);
        }
        
        $user = Auth::user();
        $sailboat = Sailboat::create([
            'user_id' => $user->id,
            'title' => $request->title,
            'year' => $request->year,
            'manufacturer' => $request->manufacturer,
            'model' => $request->model,
            'displacement' => $request->displacement,
            'status' => $request->status,
            'loa' => $request->loa,
            'motor' => $request->motor,
            'battery_brand' => $request->battery_brand,
            'battery_type' => $request->battery_type,
            'solar_panel' => $request->solar_panel,
            'wind_generator' => $request->wind_generator,
            'genset' => $request->genset,
            'controller' => $request->controller,
            'sailing_type' => $request->sailing_type,
            'description' => $request->description,
        ]);

        if (count($request->faqs) > 0) {
            foreach ($request->faqs as $faq) {
                FAQ::create([
                    'sailboat_id' => $sailboat->id,
                    'question' => $faq['question'],
                    'answer' => $faq['answer'],
                ]);
            }
        }

        if (count([$request->hasFile('images')]) > 0) {
            foreach ($request->hasFile('images') as $file) {
                $path = $file->store('sailboat-images');
                SailboatPhoto::create([
                    'sailboat_id' => $sailboat->id,
                    'image_path' => $path
                ]);
            }
        }

        if (count($request->videos) > 0) {
            foreach ($request->videos as $path) {
                if (!is_array($path)) {
                    Storage::makeDirectory('sailboat-videos');
                    $newPath = str_replace('sailboat-tmp-videos', 'sailboat-videos', $path);
                    if (Storage::move($path, $newPath)) {
                        BoatVideo::create([
                            'sailboat_id' => $sailboat->id,
                            'video_path' => $newPath,
                        ]);
                    }
                }
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Sailboat successfully created'
        ]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sailboat_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'year' => 'required|numeric',
            'manufacturer' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'displacement' => 'required|string|max:255',
            'status' => 'required|string|in:Complete,In Process',
            'loa' => 'required|string|max:255',
            'motor' => 'required|string|max:255',
            'battery_brand' => 'required|string|max:255',
            'battery_type' => 'required|string|max:255',
            'solar_panel' => 'required|string|max:255',
            'wind_generator' => 'required|string|max:255',
            'genset' => 'required|string|max:255',
            'controller' => 'required|string|max:255',
            'sailing_type' => 'required|string|max:255',
            'description' => 'required',
            'faqs' => 'required|array',
            'faqs.*.question' => 'required',
            'faqs.*.answer' => 'required',
        ],[
            'faqs.*.question.required' => 'Empty questions are not accepted',
            'faqs.*.answer.required' => 'Empty answers are not accepted',
        ],[
            'sailing_type' => 'type of sailing',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 400);
        }

        $sailboat = Sailboat::findOrFail($request->sailboat_id);
        $sailboat->update([
            'title' => $request->title,
            'year' => $request->year,
            'manufacturer' => $request->manufacturer,
            'model' => $request->model,
            'displacement' => $request->displacement,
            'status' => $request->status,
            'loa' => $request->loa,
            'motor' => $request->motor,
            'battery_brand' => $request->battery_brand,
            'battery_type' => $request->battery_type,
            'solar_panel' => $request->solar_panel,
            'wind_generator' => $request->wind_generator,
            'genset' => $request->genset,
            'controller' => $request->controller,
            'sailing_type' => $request->sailing_type,
            'description' => $request->description,
        ]);

        FAQ::where('sailboat_id', $sailboat->id)->delete();
        if (count($request->faqs) > 0) {
            foreach ($request->faqs as $faq) {
                FAQ::create([
                    'sailboat_id' => $sailboat->id,
                    'question' => $faq['question'],
                    'answer' => $faq['answer'],
                ]);
            }
        }

        if (count($request->hasFile('images')) > 0) {
            foreach ($request->hasFile('images') as $file) {
                $path = $file->store('sailboat-images');
                SailboatPhoto::create([
                    'sailboat_id' => $sailboat->id,
                    'image_path' => $path
                ]);
            }
        }

        if (count($request->videos) > 0) {
            foreach ($request->videos as $path) {
                if (!is_array($path)) {
                    Storage::makeDirectory('sailboat-videos');
                    $newPath = str_replace('sailboat-tmp-videos', 'sailboat-videos', $path);
                    if (Storage::move($path, $newPath)) {
                        BoatVideo::create([
                            'sailboat_id' => $sailboat->id,
                            'video_path' => $newPath,
                        ]);
                    }
                }

            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Sailboat successfully updated'
        ]);
    }

   
    public function show(Request $request, $id)
    {
        $sailboat = Sailboat::findOrFail($id);
        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'sailboat' => new SailboatResource($sailboat)
            ]);
        }
        return view('admin.sailboats.show',compact('sailboat'));
        //create view in admin section & display here
    }

    public function destroy($id)
    {
        $sailboat = Sailboat::findOrFail($id);
        $sailboat->delete();

        session()->flash('flash.banner', 'Sailboat successfully deleted.');
        session()->flash('flash.bannerStyle', 'success');
        return redirect()->route('sailboats.index');
    }

    public function uploadVideo(Request $request)
    {
        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));

        if ($receiver->isUploaded() === false) {
            throw new UploadMissingFileException();
        }

        $fileReceived = $receiver->receive();
        if ($fileReceived->isFinished()) {
            $file = $fileReceived->getFile();
            $extension = $file->getClientOriginalExtension();
            $fileName = str_replace('.'.$extension, '', $file->getClientOriginalName());
            $fileName .= '_' . md5(time()) . '.' . $extension;

            $disk = Storage::disk(config('filesystems.default'));
            $path = $disk->putFileAs('sailboat-tmp-videos', $file, $fileName);

            unlink($file->getPathname());
            return [
                'path' => $path,
                'filename' => $fileName
            ];
        }

        $handler = $fileReceived->handler();
        return [
            'done' => $handler->getPercentageDone(),
            'status' => true
        ];
    }

   
    public function searchSailboats(Request $request) 
    {
        $user = Auth::user();
        $sailboats = Sailboat::filter($request)->orderBy('id', 'desc')->paginate(10);
        
        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'sailboats' => SailboatResource::collection($sailboats)->response()->getData(true)
            ]);
        }

        return false;
    }
    public function removeVideo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 400);
        }

        $video = BoatVideo::findOrFail($id);
        Storage::disk(config('filesystems.default'))->delete($video->video_path);
        $video->delete();

        return response()->json([
            'success' => true,
            'message' => 'Sailboat video successfully deleted'
        ]);
    }

    public function removeImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 400);
        }

        $photo = SailboatPhoto::findOrFail($request->id);
        Storage::disk(config('filesystems.default'))->delete($photo->image_path);
        $photo->delete();
        return response()->json([
            'success' => true,
            'message' => 'Sailboat image successfully deleted'
        ]);
    }

    public function searchOptions(Request $request) 
    {
        $options = [
            'displacements' => Sailboat::select('displacement')->distinct()->pluck('displacement')->toArray(),
            'battery_types' => Sailboat::select('battery_type')->distinct()->pluck('battery_type')->toArray(),
            'sailing_types' => Sailboat::select('sailing_type')->distinct()->pluck('sailing_type')->toArray(),
            'gensets' => Sailboat::select('genset')->distinct()->pluck('genset')->toArray(),
            'status' => Sailboat::select('status')->distinct()->pluck('status')->toArray(),
            'motors' => Sailboat::select('motor')->distinct()->pluck('motor')->toArray(),
        ];

     if ($request->wantsJson()) {
        return response()->json([
            'success' => true,
            'options' => $options
        ]);
      }
     
    }

   

}
