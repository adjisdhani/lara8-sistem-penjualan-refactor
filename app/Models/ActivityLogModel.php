<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ActivityLogModel extends Model
{
    use LogsActivity;

    protected static $logOnlyDirty = true;

    public function getLogNameToUse(string $eventName = ''): string
    {
        return class_basename($this);
    }
}
