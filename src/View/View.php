<?php

namespace Illuminate\View;





class View
{
    protected static function getBaseContent()
    {
        ob_start();
        include view_path().'layouts/main.php';

        return ob_get_clean();
    }
    public static function makeError()
    {
        
        self::getViewContent($error, true);
        
    }
    
    public static function make($view, $params = [])
    {
        $baseContent = self::getBaseContent();
        $viewContent = self::getViewContent($view, params:$params);

        return str_replace('{{content}}',$viewContent,$baseContent);
    }

    protected static function getViewContent($view, $isError=false, $params = [])
    {
        $path = $isError ? view_path(). 'errors/404':view_path();
        
       
        if (str_contains($view, '.')) {
            $views = explode('.', $view);


            foreach ($views as $view) {
                if (is_dir($path .$view)) {
                    $path = $path . $view.DIRECTORY_SEPARATOR;
                }
            }
            $view = $path . end($views) . '.php';

            
        } else {
            $view = $path .$view . '.php';

            
        }

        extract($params);

        if ($isError) {
            include $view;
            
        }else{
            ob_start();
            include $view;
            return ob_get_clean();
        }
    }
}
