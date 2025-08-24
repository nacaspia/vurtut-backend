<?php
namespace App\Helpers;

use App\Models\CmsLog;
use Illuminate\Support\Carbon;

class CmsLogsHelper {
    public static function convert($data)
    {
        $cmslog = new CmsLog();
        $cmslog->cms_user_id = !empty(auth('admin')->user())? auth('admin')->user()->id: 0;
        $cmslog->subj_id = $data['subj_id'];
        $cmslog->subj_table = $data['subj_table'];
        $cmslog->action = $data['actions'];
        $cmslog->note = ['az' => $data['note']];
//        $cmslog->ip_address = !empty($_SERVER['REMOTE_ADDR'])? $_SERVER['REMOTE_ADDR']: null;
        $cmslog->created_at = Carbon::now();
        $cmslog->save();
    }
}
