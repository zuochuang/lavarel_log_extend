<?php

namespace LogExtend\LaravelLogExtend;

use Monolog\Processor\GitProcessor;
use Monolog\Processor\MemoryUsageProcessor;
use Monolog\Processor\WebProcessor;

class LogExtend
{
    /**
     *
     * @param  \Illuminate\Log\Logger  $logger
     * @return void
     * 自定义实例
     */
    public function __invoke($logger)
    {
        foreach ($logger->getHandlers() as $handler) {
            if (config('laravel_log_extend.log_request_details')) {
                $handler->pushProcessor(new WebProcessor);
            }

            $handler->pushProcessor(new RequestDataProcessor);

            if (config('laravel_log_extend.log_memory_usage')) {
                $handler->pushProcessor(new MemoryUsageProcessor);
            }

            if (config('laravel_log_extend.log_git_data')) {
              $handler->pushProcessor(new GitProcessor);
            }
        }
    }


}
