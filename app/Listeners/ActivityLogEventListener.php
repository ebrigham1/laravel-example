<?php

namespace App\Listeners;

use App\Contracts\ActivityLogEvent;
use App\Events\UsersAttachedToRole;
use App\Events\UserDetachedFromRole;
use App\Models\ActivityLog;

/**
 * Class ActivityLogEventListener handles all events that should generate
 * a record in the activity log
 *
 * @package App\Listeners
 */
class ActivityLogEventListener
{
    /**
     * Handle an activity log event
     *
     * @param \App\Contracts\ActivityLogEvent $event
     * @return void
     */
    public function handle(ActivityLogEvent $event)
    {
        // Get the user that created did the activity
        $user = $event->getUser();
        // Create the log of said activity
        $user->activityLogs()->create(
            [
                'description' => $event->getDescription(),
            ]
        );
    }
}
