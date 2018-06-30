<?php

namespace App\Events;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ActivityLogEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $user;
    protected $description;

    /**
     * Create a new event instance.
     *
     * @param \App\Models\User $user
     * @param string $description
     * @return void
     */
    public function __construct(User $user, string $description)
    {
        $this->user = $user;
        $this->description = $description;
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
            'created_at_diff_for_humans' => Carbon::now()->diffForHumans(),
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
