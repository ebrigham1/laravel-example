<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use App\Jobs\LongTask;
use Session;

class QueueExampleController extends Controller
{
    /**
     * Display the queue example page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('queueExample');
    }

    /**
     * Perform the long task without queue
     *
     * @return \Illuminate\Http\Response
     */
    public function withoutQueue()
    {
        // Sleep is taking the place of our long task you can imagine this as an image upload
        // or maybe some heavy duty encryption, or a call to an API endpoint, or an email. Anything
        // we don't want the user to have to wait for.
        sleep(5);
        Log::info('Long task run without queue');
        Session::flash('success', 'Successfully completed long running task');
        return redirect()->route('queueExample');
    }

    /**
     * Perform the long task with queue
     *
     * @return \Illuminate\Http\Response
     */
    public function withQueue()
    {
        // You can pass anything you need into the job so there is no worrying about losing
        // access to needed resources when the job is actually running, passing time in as an example
        // but you can pass models in or anything you want really.
        LongTask::dispatch(5);
        Session::flash('success', 'Successfully queued long running task');
        return redirect()->route('queueExample');
    }
}
