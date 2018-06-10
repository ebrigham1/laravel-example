<?php

namespace App\Contracts;

use App\Models\User;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

/**
 * Interface ActivityLogEventContract
 *
 * Activity log events must define two functions. One that gives the activity log its description
 * and one that gives it its user when being created.
 *
 * @package App\Contracts
 */
interface ActivityLogEventContract extends ShouldBroadcast
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
