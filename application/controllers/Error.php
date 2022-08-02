<?php
/**
 * @name ErrorController
 * @see http://www.php.net/manual/en/yaf-dispatcher.catchexception.php
 * @author andre
 */
class ErrorController extends Yaf_Controller_Abstract {

	public function errorAction($exception) {
		//1. assign to view engine
		$this->getView()->assign("exception", $exception);
		//5. render by Yaf 
	}
}
