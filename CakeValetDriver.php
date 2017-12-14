<?php

class CakeValetDriver extends ValetDriver {

		/**
		 * Determine if the driver serves the request.
		 *
		 * @param  string  $sitePath
		 * @param  string  $siteName
		 * @param  string  $uri
		 * @return bool
		 */
		public function serves($sitePath, $siteName, $uri) {
			if (file_exists($sitePath . $this->www($sitePath) . '/app/Config/bootstrap.php')) {
				return true;
			}
			return false;
		}

		/**
		 * Determine if the incoming request is for a static file.
		 *
		 * @param  string  $sitePath
		 * @param  string  $siteName
		 * @param  string  $uri
		 * @return string|false
		 */
		public function isStaticFile($sitePath, $siteName, $uri) {
			if (file_exists($staticFilePath = $sitePath . $this->www($sitePath) . '/app/webroot/' . $uri)) {
				return $staticFilePath;
			}
			return false;
		}

		/**
		 * Get the fully resolved path to the application's front controller.
		 *
		 * @param  string  $sitePath
		 * @param  string  $siteName
		 * @param  string  $uri
		 * @return string
		 */
		public function frontControllerPath($sitePath, $siteName, $uri) {
			return $sitePath . $this->www($sitePath) . '/app/webroot/index.php';
		}

		public function www($sitePath) {
			if (file_exists($sitePath . '/app/Config/bootstrap.php')) {
				return '';
			} elseif (file_exists($sitePath . '/www/app/Config/bootstrap.php')) {
				$hasWww = '/www';
				return '/www';
			}
		}
}
