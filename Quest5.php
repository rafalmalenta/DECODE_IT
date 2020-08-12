<?php

class User{
    public $name;
    public $cost;
    public $friends;
    public function __construct($name, $cost)
    {
        $this->name=$name;
        $this->cost=$cost;
    }
    public function addFriend($friendName){
        $this->friends[]=$friendName;
}
}
$network=[];
$stdin = fopen('php://stdin', 'r');
$testCount = trim(fgets($stdin));
for($i=0;$i<$testCount;$i++){
    $line = explode(" ", trim(fgets($stdin)));
    $network[] = new user($line[0],$line[1]);
}
$relationCount = trim(fgets($stdin));
for($i=0;$i<$relationCount;$i++){
    $line = explode(" ", trim(fgets($stdin)));
    /**
    *@var $user User
    */
    foreach ($network as $user){
        if($user->name == $line[0]){
            $user->addFriend($line[1]);
        }
        if($user->name == $line[1]){
            $user->addFriend($line[0]);
        }
    }
}
$attackArray = [];
function captureUserAndFriends($user, $userID, $network,$cost,$userArray)
{
    $networkAfter = $network;
    foreach ((array)$user->friends as $friend) {
        foreach ($network as $index => $key) {
            if ($friend == $key->name) {
                echo $friend, " ", $key->name;
                unset($networkAfter[$index]);
            }
        }
    }
    unset($networkAfter[$userID]);
    $attackData = (object)[];
    $userArray[] = $user->name;
    $attackData->userArray = $userArray;
    $attackData->cost = $cost + $user->cost;
    $attackData->networkToCapture = $networkAfter;
    return $attackData;
}
function simulateAttack($network,$cost,$userArray){

    $totalcost = 0;
    /**
     * @var $user User
     * @var $a object[]
     */
    $cheapest="";
    $a =[];
    $result=[];
    foreach ($network as $id => $user) {
        $a = captureUserAndFriends($user, $id, $network,$cost,$userArray);
        if($a->networkToCapture) {
           $s[] = simulateAttack($a->networkToCapture, $a->cost, $a->userArray);
        }
        else{
            return $a;
            array_push($result,$a);
            var_dump($result);

        }
    }
    return $s;
}
$currMinCost=99999999;
$cheapestWay=[];
$attackData = simulateAttack($network,0,[]);
foreach ($attackData as $data){
    if($data->cost<$currMinCost){
        $cheapestWay = $data;
        $currMinCost = $data->cost;
    }
}
//var_dump($cheapestWay);
echo count($cheapestWay->userArray),"\n";
foreach ($cheapestWay->userArray as $user)
    echo "$user\n";
echo "$cheapestWay->cost\n";