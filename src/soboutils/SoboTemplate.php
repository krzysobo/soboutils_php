<?php
namespace Soboutils;

require_once "SoboSingletonTrait.php";
require_once "Exceptions.php";


interface ISoboTemplate
{
    public function render($tpl_path, $params);
}


class SoboTemplate implements ISoboTemplate
{

    use SoboSingletonTrait;

    /**
     * Summary of render
     * @param mixed $tpl_path
     * @param mixed $params
     * @throws \Soboutils\FileNotFoundException
     * @return bool|string
     */
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
