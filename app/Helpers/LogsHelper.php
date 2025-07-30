<?php
namespace App\Helpers;
use App\Models\Log;
use Illuminate\Support\Carbon;

class LogsHelper {
    public static function convert($data)
    {
        $companylog = new Log();
        $companylog->user_id = $data['user_id'] ?? null;
        $companylog->company_id = $data['company_id'] ?? null;
        $companylog->obj_id = $data['obj_id'] ?? null;
        $companylog->subj_id = $data['subj_id'];
        $companylog->subj_table = $data['subj_table'];
        $companylog->action = $data['actions'];
        $companylog->note = $data['note'];
        $companylog->type = $data['type'];
        $companylog->ip_address = !empty($_SERVER['REMOTE_ADDR'])? $_SERVER['REMOTE_ADDR']: null;
        $companylog->created_at = Carbon::now();
        $companylog->save();
    }
}
