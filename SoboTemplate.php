<?php
namespace Soboutils;

require_once "SoboSingleton.php";
require_once "Exceptions.php";


interface ISoboTemplate
{
    public function render($tpl_path, $params);
}

class SoboTemplate extends SoboSingleton implements ISoboTemplate
{
    public function render($tpl_path, $params)
    {
        if (! file_exists($tpl_path)) {
            throw new FileNotFoundException("Template $tpl_path doesn't exist. Quitting.");
        }

        extract($params);
        ob_start();
        include $tpl_path;
        $res = ob_get_contents();
        ob_end_clean();

        return $res;
    }

}
