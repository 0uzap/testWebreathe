<?php
// src/Scheduler/AddMesuresTask.php

namespace App\Scheduler;

use Symfony\Component\Console\Scheduling\ScheduledTaskInterface;
use Symfony\Component\Console\Scheduling\Schedule;

class AddMesuresTask implements ScheduledTaskInterface
{
    public function getSchedule(): string
    {
        // Schedule the task to run every 10 minutes
        return '*/10 * * * *';
    }

    public function getCommand(): string
    {
        // Command to execute
        return 'app:ajout-mesures';
    }


    public function onError(): string
    {
        // What to do on error, you can handle it as needed
        return ScheduledTaskInterface::ON_ERROR_CONTINUE;
    }

    public function getPriority(): int
    {
        // Priority of the task, default is 0
        return 0;
    }
}
