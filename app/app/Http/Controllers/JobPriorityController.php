<?php

namespace App\Http\Controllers;

use App;
use App\Models\Job;
use \Cache;

class JobPriorityController extends Controller
{
    /**
     * Cache key
     * @var string
     */
    private $cache_key = 'job';
    /**
     * Job Queue Status
     * @var string
     */
    const COMPLETE = 'complete';
    const FAILED = 'failed';
    const QUEUED = 'queued';
    /**
     * Job Priority
     * @var string
     */
    const HIGH_PRIORITY = 'high';
    const LOW_PRIORITY = 'low';

    /**
     * Get the job id with highest priority and next in the queue
     *
     * @return void
     */
    public function getJobs()
    {

        if (Cache::has($this->cache_key)) {
            $jobsByPriority = Cache::get($this->cache_key);
        } else {
            $jobs = new Job();
            $jobsByPriority = $jobs->where('queue', self::HIGH_PRIORITY)->get();
            Cache::put($this->cache_key, $jobsByPriority, 15);
        }

        if (isset($jobsByPriority[0]['id'])) {

            printf("[%d] is the highest priority job", $jobsByPriority[0]['id']);

        } else {

            $message = "No high priority jobs in the queue";
            printf("[%s]", $message);
        }
    }

    /**
     * Get the job id with highest priority and next in the queue
     *
     * @return void
     */
    public function getJobStatus($id)
    {

        // check if in queue status
        if (Cache::has($this->cache_key)) {
            $jobQueueStatus = Cache::get($this->cache_key);
        } else {
            $jobs = new Job();
            $jobQueueStatus = $jobs->where('id', $id)->get();
            Cache::put($this->cache_key, $jobQueueStatus, 1);
        }

        // check if in failed status
        if (Cache::has($this->cache_key)) {
            $jobFailStatus = Cache::get($this->cache_key);
        } else {
            $jobs = new Fail();
            $jobFailStatus = $jobs->where('id', $id)->get();
            Cache::put($this->cache_key, $jobQueueStatus, 1);
        }

        // if not present in either models then status is complete
        if ($jobQueueStatus[0]) {
            printf('[status is %s]', self::QUEUED);
        } else if ($jobFailStatus[0]) {
            printf('[status is %s]', self::FAILED);
        } else {
            printf('[status is %s]', self::COMPLETE);
        }

    }

}
