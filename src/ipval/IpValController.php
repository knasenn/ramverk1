<?php

namespace Anax\IpVal;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $di if implementing the interface
 * ContainerInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class IpValController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;




    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function indexActionGet() : object
    {
        $page = $this->di->get("page");
        // $adress = $_SERVER["REMOTE_ADDR"] ?? "";
        $adress = $_SERVER["HTTP_X_FORWARDED_FOR"] ?? "";

        $data = [
            "test" => "testing",
            "adress" => $adress,
        ];

        $page->add("ipval/index", $data);

        return $page->render();
    }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function indexActionPost() : object
    {
        //gets pagestuff?
        $page = $this->di->get("page");
        //get ip
        $ip = $this->di->request->getPOST("ip");

        $validate = new \Aiur\Validate\Validate();
        //Validates ip
        $resValidateIp = $validate->validateIp($ip);
        //Gets hostname
        $resDomain = $validate->getDomain($ip);
        //Gets curl
        $resCurl = $validate->getCurl($ip);

        $data = [
            "ipval" => $resValidateIp,
            "host" => $resDomain,
            "latitude" => $resCurl->latitude,
            "longitude" => $resCurl->longitude,
            "country_name" => $resCurl->country_name,
            "region_name" => $resCurl->region_name,
        ];


        $page->add("ipval/validator", $data);


        return $page->render();
    }
}
