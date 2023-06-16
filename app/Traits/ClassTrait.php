<?php

namespace App\Traits;

use App\Models\Cls;

trait ClassTrait
{
    public function classes()
    {
        return Cls::with('className')
            ->where('root_id', rootId())
            ->get();
    }
}
