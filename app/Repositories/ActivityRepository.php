<?php

namespace App\Repositories;

use App\Interfaces\ActivityRepositoryInterface;
use App\Models\LogActivity;

class ActivityRepository implements ActivityRepositoryInterface {

    public function createActivityLog($log) {
        $data = json_decode($log->data, true);
        $this->eloquentActivity('Create News', $data);
    }

    public function updateActivityLog($log) {
        $data = json_decode($log->data, true);
        $this->eloquentActivity('Update News', $data);
    }

    public function deleteActivityLog($log) {
        $data = json_decode($log->data, true);
        $this->eloquentActivity('Delete News', $data);
    }

    public function eloquentActivity($subject, $data) {
        $logs = new LogActivity;
        $logs->subject = $subject;
        $logs->method = $data['method'];
        $logs->url = $data['url'];
        $logs->users_id = $data['users_id'];
        $logs->save();
    }
}
