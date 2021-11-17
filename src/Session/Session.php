<?php
namespace App\Session;
class Session
{
    /**
     * @var bool
     */
    private $sessionStarted = false;
    private array $flashMessages;
    public function __construct(){

    }
    public function start(){
        $this->sessionStarted = true;
        session_start();
    }
    public function close(){
        if(!$this->sessionStarted){
            $this->start();
        }
        session_write_close();
    }
    public function destroy(){
        if(!$this->sessionStarted){
            $this->start();
        }
        session_destroy();
    }
    public function has($name): bool{
        return isset($_SESSION[$name]);
    }
    public function get(string $name, $default = null){
        if(!$this->sessionStarted){
            $this->start();
        }
        return $_SESSION[$name] ?? $default;
    }
    public function set($name, $value){
        if(!$this->sessionStarted){
            $this->start();
        }
        $_SESSION[$name] = $value;
    }
    public function remove(string $name){
        unset($_SESSION[$name]);
    }
//    public function regenerate(){
//        if(!$this->sessionStarted){
//            $this->start();
//        }
//        $currentVars = [];
//        $globals = json_decode($_SESSION['globals'] ?? '[]', true);
//        foreach (array_keys($globals) as $key){
//            $currentVars[$key] = $this->get($key);
//        }
//        $this->destroy();
//        session_id(session_create_id());
//        $this->start();
//        foreach ($currentVars as $key => $value){
//            $this->set($key, $value, true);
//        }
//        $_SESSION['globals'] = $globals;
//    }
}