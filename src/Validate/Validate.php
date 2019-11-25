<?php

namespace Aiur\Validate;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

/**
 * To ease rendering a page consisting of several views.
 */
class Validate implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;


    /**
     * Set the view to be used for the layout.
     *
     * @param array $view configuration to create up the view.
     *
     * @return $this
     */
    public function validateIp($ip)
    {
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            $ipval = "$ip is a valid IPv6 address";
            return $ipval;
        } elseif (filter_var($ip, FILTER_VALIDATE_IP)) {
            $ipval = "$ip is a valid IPv4 address";
            return $ipval;
        } else {
            $ipval = "$ip is not a valid IP address";
            return $ipval;
        }
    }



    /**
     * Set the view to be used for the layout.
     *
     * @param array $view configuration to create up the view.
     *
     * @return $this
     */
    public function getDomain($ip)
    {
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            $host = gethostbyaddr("$ip");
            return $host;
        } elseif (filter_var($ip, FILTER_VALIDATE_IP)) {
            $host = gethostbyaddr("$ip");
            return $host;
        } else {
            $host = "No valid domain";
            return $host;
        }
    }


    /**
     * Set the view to be used for the layout.
     *
     * @param array $view configuration to create up the view.
     *
     * @return $this
     */
    public function getCurl($ip)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "http://api.ipstack.com/{$ip}?access_key=5743a124d24d6c68f6dc20dccab02eac");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curl);
        $decoded_result = json_decode($result);
        return $decoded_result;
    }





}
