<?php

namespace App\Observers;

use App\GalleryImage;

class GalleryImageObserver
{

    public function creating(GalleryImage $image)
    {
        if (is_null($image->order)) {
            $image->order = GalleryImage::max('order') + 1;
            return;
        }

        $lowerPriorityImages = GalleryImage::where('order', '>=', $image->order)
            ->get();

        foreach ($lowerPriorityImages as $lowerPriorityImage) {
            $lowerPriorityImage->order++;
            $lowerPriorityImage->save();
        }
    }


    public function updating(GalleryImage $image)
    {
        if ($image->isClean('order')) {
            return;
        }

        if (is_null($image->order)) {
            $image->order = GalleryImage::max('order');
        }

        if ($image->getOriginal('order') > $image->order) {
            $orderRange = [
                $image->order, $image->getOriginal('order')
            ];
        } else {
            $orderRange = [
                $image->getOriginal('order'), $image->position
            ];
        }

        $lowerPriorityImages = GalleryImage::where('id', '!=', $image->id)
            ->whereBetween('order', $orderRange)
            ->get();

        foreach ($lowerPriorityImages as $lowerPriorityImage) {
            if ($image->getOriginal('order') < $image->order) {
                $lowerPriorityImage->order--;
            } else {
                $lowerPriorityImage->order++;
            }
            $lowerPriorityImage->save();
        }
    }

    public function deleted(GalleryImage $image)
    {
        $lowerPriorityImages = GalleryImage::where('order', '>', $image->order)
            ->get();

        foreach ($lowerPriorityImages as $lowerPriorityImage) {
            $lowerPriorityImage->order--;
            $lowerPriorityImage->save();
        }
    }
}
