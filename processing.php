<?php //Start logical processing
error_reporting(-1);
if(isset($_POST['action'])){
  if(isset($_COOKIE['world'])){
    doAction();
  } else {
    generateWorld();
  }

}

function doAction(){
  $rand = rand(1,2);
  switch ($rand) {
    case 1: childBorn(); break;
    case 2: death(); break;
  }
  exit;
}

function generateWorld(){
  //Initialize values
  setcookie("world-population", 1, 0);
  setcookie("world", "generated", 0);
  setcookie("world-cancer", 0, 0);
  setcookie("world-accident", 0, 0);
  setcookie("world-old", 0, 0);
  createLog("World generated");
  exit;
}

function childBorn(){

  if(isset($_COOKIE['world-influenza'])){
    $childBirthPercentage = rand(0,100);
    if($childBirthPercentage < 40){
      createLog('A child was killed by viruses during birth');
      exit;
    }
  }
  createLog('A child was born');
  increasePopulation();
}

function death(){
  //If world population is less than 2, no death can occur.
  //2 people is needed for reproduction
  if(!isset($_COOKIE['world-influenza'])){
    if($_COOKIE['world-population'] <= 2){
      doAction();
      exit;
    }
  }
  if($_COOKIE['world-population'] <= 0){
  //No more citizen to die
  createLog('All your citizens are dead');
  exit;
  }

  //If influenza is detected, death will occur
  if(isset($_COOKIE['world-influenza'])){
    $deathMethod = rand(1,4);
    $influenzaType = $_COOKIE['world-influenza'];
  } else {
    $deathMethod = rand(1,3);
    $influenzaType = "";
  }

  switch ($deathMethod){
    case 1: deathMethod("cancer"); break;
    case 2: deathMethod("accident"); break;
    case 3: deathMethod("old age"); break;
    case 4: deathMethod($influenzaType); break;
  }
}

function deathMethod($deathMethod){
  $accidentValue = $_COOKIE['world-' . $deathMethod];
  $accidentValue++;
  setcookie("world-". $deathMethod , $accidentValue, 0);
  setcookie("world-population", 1, 0);
  createLog("A citizen died of $deathMethod");
  if($deathMethod == "ebola"){
    echo "updateLog('** If ebola is not stopped, more citizens will die!!');";
  }
  decreasePopulation();
}

function increasePopulation(){
  $totalWorldPopulation = $_COOKIE['world-population'];
  $totalWorldPopulation++;
  setcookie("world-population", $totalWorldPopulation, 0);
  updateWorldPopulation($totalWorldPopulation);
  createLog("Total world population increased to $totalWorldPopulation");
  exit;
}

function decreasePopulation(){
  $totalWorldPopulation = $_COOKIE['world-population'];
  $totalWorldPopulation--;
  setcookie("world-population", $totalWorldPopulation, 0);
  updateWorldPopulation($totalWorldPopulation);
  createLog("Total world population decreased to $totalWorldPopulation");
  exit;
}

function updateWorldPopulation($totalWorldPopulation){
  $worldAccidents = $_COOKIE['world-accident'];
  $worldCancer = $_COOKIE['world-cancer'];
  echo "updateWorldPopulation($totalWorldPopulation, $worldAccidents, $worldCancer);";
}

function createLog($createLog){
  $current = date('H:i:s');
  $logMsg = $createLog;
  echo "updateLog('$current | $logMsg');";
}

?>
