<?php

namespace App\Events;

use App\Contracts\ActivityLogEvent;
use App\Models\Role;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class UserDetachedFromRole implements ActivityLogEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $user;
    private $detachedUser;
    private $role;
    private $description;

    /**
     * Create a new event instance.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Role $role
     * @return void
     */
    public function __construct(User $user, User $detachedUser, Role $role)
    {
        $this->user = $user;
        $this->detachedUser = $detachedUser;
        $this->role = $role;
        $this->description = "User '"
            . $this->detachedUser->name
            . "' detached from role '"
            . $this->role->display_name . "'.";
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'ActivityLogCreated';
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('ActivityLog');
    }

    /**
     * Define what properties should be broadcast to the client
     *
     * @return array
     */
    public function broadcastWith(): array
    {
        return [
            'user_name' => $this->user->name,
            'description' => $this->description,
        ];
    }

    /**
     * Return the description for this event
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Return the auth user for this event
     *
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}
