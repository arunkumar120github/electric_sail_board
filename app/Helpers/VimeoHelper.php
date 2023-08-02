<?php

namespace App\Helpers;

use TheSeer\Tokenizer\Exception;
use Vimeo\Laravel\Facades\Vimeo;
use App\Models\SailboatVideo;

class VimeoHelper
{
    public static function upload(SailboatVideo $video)
    {
        $response = null;
        try {
            if ($video && file_exists($video->video_path)) {
                $response = Vimeo::connection('main')->upload($video->video_path, [
                    'name' => $video->title,
                    'description' => $video->description,
                    'privacy' => [
                        'download' => false,
                        'embed' => 'public',
                        'view' => 'anybody'
                    ]
                ]);
            }
        } catch (Exception $e) {
            return "Error occured while uploading video: {$e->getMessage()}";
        }

        if ($response) {
            $data = explode('/', $response);
            $video->vimeo_id = end($data);
            $video->save();
        }
        return $video;
    }
}