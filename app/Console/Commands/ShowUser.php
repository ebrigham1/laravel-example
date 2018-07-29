<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ShowUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'show:user 
                            {userId? : The id of the user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show information for the user given by {userId}';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $userId = $this->argument('userId');
        if (!$userId) {
            $userId = $this->ask('Please provide the id of the user you wish to lookup');
        }
        try {
            $user = User::findOrFail($userId)->toArray();
            $this->table(array_keys($user), [$user]);
        } catch (ModelNotFoundException $exception) {
            $this->error('Could not find user given by id: ' . $userId);
        }
    }
}
