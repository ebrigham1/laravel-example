<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Log;

class LongTask implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $time;

    /**
     * Create a new job instance.
     *
     * @param int $time
     * @return void
     */
    public function __construct($time)
    {
        $this->time = $time;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Sleep is taking the place of our long task you can imagine this as an image upload
        // or maybe some heavy duty encryption, or a call to an API endpoint, or an email. Anything
        // we don't want the user to have to wait for.
        sleep($this->time);
        Log::info('Long task run with queue');
    }
}
