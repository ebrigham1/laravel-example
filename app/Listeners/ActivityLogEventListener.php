<?php

namespace App\Listeners;

use App\Events\ActivityLogEvent;

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
     * @param \App\Events\ActivityLogEvent $event
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
