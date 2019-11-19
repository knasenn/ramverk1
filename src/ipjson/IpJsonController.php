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
     * @var string $db a sample member variable that gets initialised
     */
    private $db = "not active";



    /**
     * The initialize method is optional and will always be called before the
     * target method/action. This is a convienient method where you could
     * setup internal properties that are commonly used by several methods.
     *
     * @return void
     */
    public function initialize() : void
    {
        // Use to initialise member variables.
        $this->db = "active";
    }



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


        $data = [
            "test" => "testingXYO",
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
        $page = $this->di->get("page");
        // var_dump($_POST["ip"]);
        $ip = $_POST["ip"];


        // Validate ip
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            // $ipval = "$ip is a valid IPv6 address";
            $valid = true;
            $host = gethostbyaddr("$ip");
        } elseif (filter_var($ip, FILTER_VALIDATE_IP)) {
            // $ipval = "$ip is a valid IPv4 address";
            $valid = true;
            $host = gethostbyaddr("$ip");
        } else {
            // $ipval = "$ip is not a valid IP address";
            $valid = false;
            $host = "";
        }



        $data = [
            "ip" => $ip,
            "valid" => $valid,
            "domain" => $host,
        ];

        // $page->add("ipjson/validator", $data);

        return [$data];
    }
}
