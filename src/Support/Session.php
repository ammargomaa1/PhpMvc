<?php

namespace Illuminate\Support;

class Session
{
    protected const FLASH_KEY = 'flash_messages';

    

    public function __construct()
    {
        $flashMessages = $_SESSION[self::FLASH_KEY]??[];

        foreach( $flashMessages as $key => &$flashMessage){
            $flashMessage['removed'] = true;
        }

        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }

    public function setFlash($key, $message)
    {
        $_SESSION[self::FLASH_KEY][$key] = [
            'removed' => false,
            'value' => $message
        ];
    }

    public function getFlash($key)
    {
        return $_SESSION[self::FLASH_KEY][$key]['value']?:false;
    }

    public function hasFlash($key)
    {
        return isset($_SESSION[self::FLASH_KEY][$key]);
    }

  public function removeFlashMessages()
    {
        $flashMessages = $_SESSION[self::FLASH_KEY]??[];

        foreach ($flashMessages as $key => &$flashMessage) {
            
            if ($flashMessage['removed']) {
                
                unset($flashMessages[$key]);
            }
        }
        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }
    public function __destruct()
    {
        $this->removeFlashMessages();
    }


}
