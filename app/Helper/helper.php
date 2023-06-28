<?php

function dateFormat($date){
    
    return \Carbon\Carbon::parse($date)->format('d-m-Y H:i:s');
}

function getFile($path){

    return "https://isport-india.s3.ap-south-1.amazonaws.com/".$path;
}

function uploadImage($image, $upath = '')
{

    if ($image != null || isset($image)) {

        $path = ($upath == '') ? 'images/' : $upath;

        $storepath = Storage::disk('public')->path($path);

        if (!is_dir($storepath)) {

            \File::makeDirectory($storepath, 0777, true);
        }

        $imageName = time() . '-' . Str::random(5) . '.' . $image->extension();

        $image->storeAs('public/' . $path, $imageName);

        return $path . '/' . $imageName;
    }

    return null;
}

function getImageUrl($image)
{

    if ($image != null) {

        return Storage::disk('public')->url($image);
    }

    return null;
}

function deleteImage($imageUrl)
{

    if ($imageUrl != null) {

        if (Storage::disk('public')->exists($imageUrl)) {

            Storage::disk('public')->delete($imageUrl);

            return true;
        }
    }

    return false;
}