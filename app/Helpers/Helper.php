<?php

namespace App\Helpers;

class Helper
{
    public static function cssFilesPath(string $string){
        return url('resources/assets/front/css/'.$string);
    }

    public static function jsFilesPath(string $string){
        return url('resources/assets/front/js/'.$string);
    }

    public static function imageFilesPath(string $string){
        return url('resources/assets/front/images/'.$string);
    }

    public static function pluginFilesPath(string $string){
        return url('resources/assets/front/plugins/'.$string);
    }

    public static function uploadedImagesPath($model,$image){
        return url('uploads/'.$model.'/source/'.$image);
    }

    
    public static function uploadedSliderImagesPath($model,$image){
        return url('uploads/sliders/'.$model.'/source/'.$image);
    }

}