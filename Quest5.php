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
    array_values($network);
    foreach ((array)$user->friends as $friend) {
        foreach ($network as $index => $key) {
            if ($friend == $key->name) {
                echo $friend, " ", $key->name;
                unset($network[$index]);
            }
        }
    }
    unset($network[$userID]);
    array_values($network);
    $attackData = (object)[];
    $userArray[] = $user->name;
    $attackData->userArray = $userArray;
    $attackData->cost = $cost + $user->cost;
    $attackData->networkToCapture = $network;
    return $attackData;
}
function simulateAttack($network,$cost,$userArray){

    $curmin = 999999;
    /**
     * @var $user User
     */
    //array_values($network);
    for($id=0;$id<=count($network)/2;$id++){
        $a = captureUserAndFriends($network[$id], $id, $network,$cost,$userArray);
        if($a->networkToCapture) {
            $tem = simulateAttack(array_values($a->networkToCapture), $a->cost, $a->userArray);
            //var_dump($tem);
            if($tem->cost<$curmin) {
                $s = $tem;
                //var_dump($s);
                $curmin = $tem->cost;
            }

        }
        else{
            return $a;
        }
    }
    return $s;
}
$currMinCost=99999999;
$cheapestWay=[];
$attackData = simulateAttack($network,0,[]);

//var_dump($attackData);

echo count($attackData->userArray),"\n";
foreach ($attackData->userArray as $user)
    echo "$user\n";
echo "$attackData->cost\n";