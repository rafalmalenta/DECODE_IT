<?php
class Network
{
    //private $connection =[];
    private $connections = [[]];
    public function __construct($connection){
        $this->connections[0][0] = $connection[0];
        $this->connections[0][1] = $connection[1];
    }
    public function addConnection($connection){
        $this->connections[count($this->connections)] = $connection;

    }
    public function checkIfIPExist($IP){
        foreach ($this->connections as $connection){
            if($connection[0] == $IP or $connection[1] == $IP)
                return true;
        }
        return false;
    }
    public function getConnections(){
        return $this->connections;
    }
    public function joinConnections($array){
        $this->connections = array_merge($this->connections, $array);
        unset($network);
    }
    public function checkIfConnectionExist($ip1, $ip2){
        $firstIP = false;
        $secondIP = false;
        foreach ($this->connections as $connection){
            if($ip1 == $connection[0] or $ip1 == $connection[1])
                $firstIP = true;
            if($ip2 == $connection[0] or $ip2 == $connection[1])
                $secondIP = true;
        }
        if ($firstIP and $secondIP)
            return true;
        else return false;
    }
}

$stdin = fopen('php://stdin', 'r');
$networksArray = [];
$output = [];

while(!feof($stdin)) {
    $line = explode(" ", trim(fgets($stdin)));
    $action = $line[0];
    $addresses = [];
    $addresses[] = $line[1];
    $addresses[] = $line[2];

    if ($action == "B") {
        $networksToJoin = [];
        $id = [];
        foreach ($networksArray as $index => $network) {
            if ($network->checkIfIPExist($line[1])) {
                $networksToJoin[] = $network;
                $id[] = $index;
            }
            if ($network->checkIfIPExist($line[2])) {
                $id[] = $index;
                $networksToJoin[] = $network;
            }
        }
        if (count($networksToJoin) == 0)
            $networksArray[] = new Network($addresses);
        if (count($networksToJoin) == 1) {
            $networksArray[0]->addConnection($addresses);
        }
        if (count($networksToJoin) == 2) {
            $array = $networksToJoin[1]->getConnections();
            $array[] = $addresses;
            unset($networksArray[$id[1]]);
            $networksToJoin[0]->joinConnections($array);
        }
    }
    if ($action == "T") {
        $control = false;
        foreach ($networksArray as $index => $network) {
            if ($network->checkIfConnectionExist($line[1], $line[2])) {
                $control = true;
            }
        }
        if ($control)
            $output[] = "T";
        else
            $output[] = "N";
    }

}
//var_dump($networksArray);
foreach ($output as $out)
    echo "$out\n";
fclose($stdin);
//Działa ale dostaje 0 punktów wystarczy odpalic php Quest4.php < x.txt
