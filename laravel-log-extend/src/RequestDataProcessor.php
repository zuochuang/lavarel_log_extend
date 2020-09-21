<?php

namespace LogExtend\LaravelLogExtend;

class RequestDataProcessor
{
    /**
     * 向日志消息添加其他请求数据.
     */
    public function __invoke($record)
    {
        if (config('laravel_log_extend.log_input_data')) {
            $record['extra']['inputs'] = request()->except(config('laravel_log_extend.ignore_input_fields'));
        }

        if (config('laravel_log_extend.log_request_headers')) {
            $record['extra']['headers'] = request()->header();
        }

        if (config('laravel_log_extend.log_session_data')) {
            $record['extra']['session'] = session()->all();
        }

        //对日志文件进行切割 如果大于2M就切割
        $destination = storage_path('logs/laravel.log');//
        if(is_file($destination) && floor(2097152) <= filesize($destination) )
            rename($destination,dirname($destination).'/'.basename($destination,'.log').'-'.date('H_i_s').'.log');
       // print_r(request()->all());
        $record['extra']=[];
        $record['extra']['test'] =['test_content'=>'3333333333333333333'];
        print_r($record);
        return $record;
    }
}
