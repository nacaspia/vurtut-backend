<?php

namespace App\Helpers;

use App\Models\Support;
use Illuminate\Support\Carbon;

class SupportHelper
{
    public static function convert($data)
    {
        $support = new Support();
        $support->admin_id = $data['admin_id'] ?? NULL;
        $support->obj_id = $data['obj_id'];
        $support->note = $data['note'];
        $support->type = $data['type'];
        $support->created_at = Carbon::now();
        $support->save();
    }
}
