<?php
    /* 
     * App Core Class
     * Creates URL & loads core controller
     * URL FORMAT - /controller/method/params
     */

     class Core {
        protected $currentController = 'Pages';
        protected $currentMethod = 'index';
        protected $params = [];

        public function __construct() {
            $url = $this->getUrl();
            // Look in controllers for first value
            // Define path as from public/index.php
            // Capitalize first letter of $url to fit capital lette of controller file
            if($url != null && file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
                // If controller file exists, set as controller
                $this->currentController = ucwords($url[0]);
                
                // Unset 0 index
                unset($url[0]);
            }

            // Require the controller
            require_once '../app/controllers/' . $this->currentController . '.php';

            // Instantiate controller class
            $this->currentController = new $this->currentController;

            // Check for second part of url
            if(isset($url[1])) {
                // Check to see if method exists in controller
                if(method_exists($this->currentController, $url[1])) {
                    $this->currentMethod = $url[1];
                    // Unset index 1
                    unset($url[1]);
                }
            }

            // Get params
            $this->params = $url ? array_values($url) : [];

            // print_r($this->params);
            // Callback with array of params
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
        }

        public function getUrl() {
            // Check if url suffix is in url
            if (isset($_GET['url'])) {
                // Remove trailing slash
                $url = rtrim($_GET['url'], '/');
                // Remove any characters unrelated to urls
                $url = filter_var($url, FILTER_SANITIZE_URL);
                // Generate array of url suffix
                $url = explode('/', $url);
                return $url;
            } 
        }
     }

     


