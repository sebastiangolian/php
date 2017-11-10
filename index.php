<?php
require_once 'autoload.php';

use sebastiangolian\php\helpers\Math;
use sebastiangolian\php\soap\GeoIPService;

$soap = new GeoIPService();
var_dump($getGeoIPResponse = $soap->GetGeolocationByIp("188.127.30.36"));