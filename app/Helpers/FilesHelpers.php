<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\ImageOptimizer\OptimizerChainFactory;

function ImagesMulti($request) // by me
{
    $image = array();
    if($files = $request->file('image'))
    {
        foreach ($files as  $file)
        {
            $image_name= md5(rand(1000, 10000));
            $ext = strtolower($file->getClientOriginalExtension());
            $image_full_name= $image_name.'.'.$ext;
            $upload_path='public/mulit_images/';
            $image_url=$upload_path.$image_full_name;
            $file->move($upload_path,$image_full_name);
            $image[]=$image_url;
        }
    }
    return $image;
}
