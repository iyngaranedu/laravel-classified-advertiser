<?php


namespace Iyngaran\Advertiser\Actions;

use Illuminate\Database\Eloquent\Model;

class AttachDefaultImageAction
{
    public function execute(Model $model, array $image): Model
    {
        if (isset($image['url'])) {
            if ($model->defaultImage()->exists()) {
                $model->defaultImage->delete();
            }
            $image['is_default'] = 1;
            $image['display_order'] = 1;
            $model->defaultImage()->create($image);
        }

        return $model;
    }
}
