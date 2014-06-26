<?php defined('SYSPATH') or die('No direct script access.');

 class Date extends Kohana_Date
 	{
	public static function fuzzy_span($timestamp, $local_timestamp = NULL)
	{
		$local_timestamp = ($local_timestamp === NULL) ? time() : (int) $local_timestamp;

		// Determine the difference in seconds
		$offset = abs($local_timestamp - $timestamp);
                    if(floor($offset/31104000) > 0){
                        $span = 'больше года';
                    }else if(floor($offset/2592000) > 0){
                        $span = floor($offset/2592000);
                        $span .= libs::getWord($offset/2592000, array(' месяц', ' месяца', ' месяцев'));
                    }else if(floor($offset/86400) > 0){
                        $span = floor($offset/86400);
                        $span .= libs::getWord($offset/86400, array(' день', ' дня', ' дней'));
                    }else if(floor($offset/3600) > 0){
                        $span = floor($offset/3600);
                        $span .= libs::getWord($offset/3600, array(' час ', ' часа ', ' часов '));
                         $span .= floor(($offset-(floor($offset/3600)*3600))/60);
                        $span .= libs::getWord($offset/3600, array(' минуты', ' минут', ' минута'));
                    }else if(floor($offset/60) > 0){
                         $span = floor($offset/60);
                        $span .= libs::getWord($offset/60, array(' минуты', ' минут', ' минут'));
                    }else{
                        $span = 'минуту';
                    }

                    // This in the future
                    return $span;

	}
}
