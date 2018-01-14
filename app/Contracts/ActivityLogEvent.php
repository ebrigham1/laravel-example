<?php

namespace App\Contracts;

use App\Models\User;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

/**
 * Interface ActivityLogEvent
 *
 * Activity log events must define one function that gives the activity log its description when being created.
 *
 * @package App\Contracts
 */
interface ActivityLogEvent extends ShouldBroadcast
{
    /**
     * Get the description to use for this activity log entry
     *
     * @return string
     */
    public function getDescription(): string;

    /**
     * Get the user who did the activity for this log entry
     *
     * @return User
     */
    public function getUser(): User;
}
