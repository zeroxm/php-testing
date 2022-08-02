<?php
namespace Twig;

use Twig\Loader\FilesystemLoader;

/**
 * Twig Adapter
 * @package Twig
 * @author andre
 */
class Adapter implements \Yaf_View_Interface
{
    /** @var FilesystemLoader */
    protected $loader;
    /** @var Environment */
    protected $twig;

    protected $variables = array();

    /**
     * @param string $templateDir
     * @param array  $options
     */
    public function __construct($templateDir, array $options = array())
    {
        $this->loader = new FilesystemLoader($templateDir);
        $this->twig   = new Environment($this->loader, $options);
    }

    /**
     * @param string $name
     * @return bool
     */
    public function __isset($name)
    {
        return isset($this->variables[$name]);
    }

    /**
     * @param string $name
     * @param mixed  $value
     */
    public function __set($name, $value)
    {
        $this->variables[$name] = $value;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->variables[$name];
    }

    /**
     * @param string $name
     */
    public function __unset($name)
    {
        unset($this->variables[$name]);
    }

    /**
     * Return twig instance
     * @return \Twig_Environment
     */
    public function getTwig()
    {
        return $this->twig;
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return bool
     */
    public function assign($name, $value = null)
    {
        $this->variables[$name] = $value;
    }

    /**
     * @param string $template
     * @param array  $variables
     * @return bool
     */
    public function display($template, $variables = null)
    {
        echo $this->render($template, $variables);
    }

    /**
     * @return string
     */
    public function getScriptPath()
    {
        return $this->loader->getPaths();
    }

    /**
     * @param string $template
     * @param array  $variables
     * @return string
     */
    public function render($template, $variables = null)
    {
        if ( is_array($variables) ) {
            $this->variables = array_merge($this->variables, $variables);
        }

        return $this->twig->load($template)->render($this->variables);
    }

    /**
     * @param string $templateDir
     * @return void
     */
    public function setScriptPath($templateDir)
    {
        $this->loader->setPaths($templateDir);
    }
}