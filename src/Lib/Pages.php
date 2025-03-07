<?php
namespace Lib;
class Pages{
    public static function  render(string $pageName,array $params = null): void
    {
        if($params != null)
        {
            foreach($params as $name => $value)
            {
                $$name = $value;
            }
        }
        $arriba = dirname(__DIR__,1);
        require_once $arriba. "/Views/layout/header.php";
        require_once $arriba. "/Views/$pageName.php";
        require_once $arriba. "/Views/layout/footer.php";
    }
}