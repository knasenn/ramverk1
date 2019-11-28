<?php

namespace Anax\IpJson;

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
class IpJsonController implements ContainerInjectableInterface
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
        $adress = $_SERVER["HTTP_X_FORWARDED_FOR"] ?? "";

        $data = [
            "test" => "testing",
            "adress" => $adress,
        ];

        $page->add("ipjson/index", $data);

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
    public function indexActionPost() : array
    {
        //gets pagestuff?
        $page = $this->di->get("page");
        //get ip
        $ip = $this->di->request->getPOST("ip");

        //Creates validate-class object
        $validate = $this->di->get("validator");
        //Validates ip
        $resValidateIp = $validate->validateIp($ip);
        //Gets hostname
        $resDomain = $validate->getDomain($ip);
        //Gets curl
        $resCurl = $validate->getCurl($ip);

        $data = [
            "ip" => $ip,
            "valid" => $resValidateIp,
            "domain" => $resDomain,
            "latitude" => $resCurl->latitude,
            "longitude" => $resCurl->longitude,
            "country_name" => $resCurl->country_name,
            "region_name" => $resCurl->region_name,
        ];

        // $page->add("ipjson/validator", $data);

        return [$data];
    }
}
