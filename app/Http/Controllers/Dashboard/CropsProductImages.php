<?php

namespace App\Http\Controllers\Dashboard;

use Intervention\Image\Facades\Image;

trait CropsProductImages
{
    protected function cropImages($images, array $imageIds, array $submittedMetadata)
    {
        foreach ($images as $image) {
            // $imageIds are images not marked for deletion
            // if it's gonna be deleted, don't bother processing it.
            if (! in_array($image->id, $imageIds)) {
                continue;
            }

            // if the meta information hasn't changed, no need to reprocess.
            // if it's new, then it hasn't been cropped yet.
            if (
                $image->metadata != $submittedMetadata[$image->id]
                || $image->wasRecentlyCreated
            ) {
                $this->recropImage($image, $submittedMetadata[$image->id]);
            }
        }
    }

    protected function recropImage($image, $meta)
    {
        $cropData = json_decode($meta);

        $stream = Image::make($image->file_path)
            ->crop(
                round($cropData->width),
                round($cropData->height),
                round($cropData->x),
                round($cropData->y)
            )
            ->stream();



        $imageFileName = $image::getDiskPath() . 'cropped/' . $image->media_name;
        //$imageThumbName = 'uploads/images/thumbs/cropped/' . $imageName;

        current_disk()->put($imageFileName, $stream->__toString(), 'public');
        $image->metadata = $meta;
        $image->save();

        $thumbStream = Image::make($image->cropped_file_path)
            ->resize(320, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->orientate()
            ->stream();

        $imageThumbName = $image::getDiskPath() . 'cropped/thumbs/' . $image->media_name;

        current_disk()->put($imageThumbName, $thumbStream->__toString(), 'public');
    }
}
