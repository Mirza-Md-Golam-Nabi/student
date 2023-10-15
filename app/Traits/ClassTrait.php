<?php

namespace App\Traits;

use App\Models\ClassName;
use App\Models\Cls;

trait ClassTrait
{
    public function classes()
    {
        return Cls::with('className')
            ->where('root_id', rootId())
            ->orderBy('class_name_id', 'asc')
            ->get();
    }

    public function classList()
    {
        return ClassName::orderBy('id', 'asc')->get();
    }
}
