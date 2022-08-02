<?php
/**
 * @name Bootstrap
 * @author andre
 * @see http://www.php.net/manual/en/class.yaf-bootstrap-abstract.php
 */
class Bootstrap extends Yaf_Bootstrap_Abstract {

	protected $config = [];

	public function _initErrors()
    {
		error_reporting(E_ALL ^ E_WARNING);
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
    }

	public function _initLoader()
	{
		Yaf_Loader::import(APPLICATION_PATH . '/vendor/autoload.php');
	}

    public function _initConfig() {
		$this->config = Yaf_Application::app()->getConfig();
		Yaf_Registry::set('config', $this->config);
	}

	public function _initPlugin(Yaf_Dispatcher $dispatcher) {
		$objSamplePlugin = new SamplePlugin();
		$dispatcher->registerPlugin($objSamplePlugin);
	}

	public function _initDefaultDbAdapter()
    {
        $capsule = new \Illuminate\Database\Capsule\Manager();
        $capsule->addConnection($this->config->database->toArray());
        $capsule->setEventDispatcher(new \Illuminate\Events\Dispatcher(new \Illuminate\Container\Container));
        $capsule->setAsGlobal();

		$capsule->bootEloquent();

        class_alias('\Illuminate\Database\Capsule\Manager', 'DB');
    }

	public function _initRoute(Yaf_Dispatcher $dispatcher) {
	}
	
	public function _initView(Yaf_Dispatcher $dispatcher) {
		$view_engine = $this->config->application->view->engine;
        if ($view_engine == 'twig') {
            $twig = new \Twig\Adapter(APPLICATION_PATH . "/application/views/", $this->config->get("twig")->toArray());
            $dispatcher->setView($twig);
        }
	}

	public function _initFunction()
    {
        Yaf_Loader::import('Common/functions.php');
    }
}
