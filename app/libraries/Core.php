<?php
class Core
{
    protected $currentController = 'Home';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->getUrl();
        // get controller in controllers folder 
        // ucwords for capilatize string
        if (isset($url[0])) {
            if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
                $this->currentController = ucwords($url[0]);
                unset($url[0]);
            }
        }

        require_once '../app/controllers/' . $this->currentController . '.php';
        $this->currentController = new $this->currentController;

        // check the second part of url
        if (isset($url[1])) {
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }

        // get the parameters
        $this->params = $url ? array_values($url) : [];

        // call a callback with array of params
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl()
    {
        if (isset($_GET['url'])) {
            // remove slash in the right of string
            $url = rtrim($_GET['url'], '/');
            // filter url from illegal character
            $url = filter_var($url, FILTER_SANITIZE_URL);
            // split string into array
            $url = explode('/', $url);

            return $url;
        }
    }
}
