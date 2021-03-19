<?php


namespace Iyngaran\Advertiser\Actions;

use Illuminate\Database\Eloquent\Model;

class AttachImagesAction
{
    public function execute(Model $model, array $image): Model
    {
        if ($model->images()->exists()) {
            foreach ($model->images() as $image) {
                $image->delete();
            }
        }
        $model->images()->createMany($image);

        return $model;
    }
}
