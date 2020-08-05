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
        //array_push($this->connections[count($this->connections)+1],$connection);
        $this->connections[count($this->connections)] = $connection;
        //$this->connections[count($this->connections)][1] = $connection[1];
    }
    public function checkIfIPExist($IP){
        foreach ($this->connections as $connection){
//            echo "hej";
//            var_dump($connection);
//            echo "eshej";
//            var_dump($IP);
            if($connection[0] == $IP or $connection[1] == $IP)
                return true;
        }
        return false;
    }
    public function getConnections(){
        return $this->connections;
    }
    public function joinConnections($array){
        //var_dump($network->getConnections());
        $this->connections = array_merge($this->connections, $array);
        unset($network);
    }

}

$stdin = fopen('php://stdin', 'r');
$networksArray = [];
while(!feof($stdin)){
    $line = explode(" ", trim(fgets($stdin)));
    $action = $line[0];
    $addresses = [];
    $addresses[] = $line[1];
    $addresses[] = $line[2];

    if ($action == "B") {
       $networksToJoin = [];
       $id =[];
       foreach ($networksArray as $index=>$network ){
           if($network->checkIfIPExist($line[1])){
               $networksToJoin[] = $network;
               $id[] = $index;
           }
           if($network->checkIfIPExist($line[2])){
               $id[] = $index;
               $networksToJoin[] = $network;
           }
       }
       if(count($networksToJoin) == 0)
           $networksArray[] = new Network($addresses);
       if(count($networksToJoin) == 1){
           $networksArray[0]->addConnection($addresses);
       }
       if(count($networksToJoin) == 2) {
           var_dump("aex",$id[1]);
           $array = $networksToJoin[1]->getConnections();
           unset($networksArray[$id[1]]);
           $networksToJoin[0]->joinConnections($array);
       }

    }
    echo "final";
    var_dump($networksArray);
}