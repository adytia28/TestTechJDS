<?php

namespace App\Interfaces;

interface ActivityRepositoryInterface {
    public function createActivityLog($log);
    public function updateActivityLog($log);
    public function deleteActivityLog($log);
}

?>
