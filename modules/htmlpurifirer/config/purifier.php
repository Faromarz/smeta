<?php defined('SYSPATH') or die('No direct script access.');

return array(
	'finalize' => TRUE,
	'preload'  => FALSE,
	'settings' => array(
        'HTML.SafeIframe' => true,
        'URI.SafeIframeRegexp' => '%^(http:|https:)?//(www.)?(youtube.com/embed/|slideshare.net/slideshow/)%'
		/**
		 * Use the application cache for HTML Purifier
		 */
		// 'Cache.SerializerPath' => APPPATH.'cache',
	),
);
