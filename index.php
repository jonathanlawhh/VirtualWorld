<head>
	<title>Virtual World</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#1a237e">
	<link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
	<script type="text/javascript" src="js/materialize.min.js"></script>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<style>
  body { display: flex; min-height: 100vh; flex-direction: column; }
  main { flex: 1 0 auto; }
  .infoCard { position: sticky; top: 20; float:right; } @media only screen and (max-width:720px){ .infoCard { float:left; width:100%;}}
</style>
<script>
function updateWorldPopulation(totalWorldPopulation, accident, cancer){
  document.getElementById('totalWorldPopulation').innerHTML = 'Current World Population : ' + totalWorldPopulation;
  document.getElementById('totalWorldAccident').innerHTML = 'Total World Accidents : ' + accident;
  document.getElementById('totalWorldCancer').innerHTML = 'Total World Cancer : ' + cancer;
  var logMsg = "Total world population is " + totalWorldPopulation;
  //var clean_uri = location.protocol + "//" + location.host + location.pathname;
  //window.history.replaceState({}, document.title, clean_uri);
}

function updateLog(logMsg){
  var node = document.createElement("p");
  var textnode = document.createTextNode(logMsg);
  node.appendChild(textnode);
  document.getElementById("loggingID").appendChild(node);
}

function deleteCookie(){
  document.cookie = "world=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
  document.cookie = "world-population=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
  document.cookie = "world-accident=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
  document.cookie = "world-cancer=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
  document.cookie = "world-influenza=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
  location.reload();
}

function setInfluenza(){
  document.cookie = "world-influenza=ebola; expires=0; path=/;";
  Materialize.toast('Ebola will take effect', 3000, 'rounded');
}

function removeInfluenza(){
  document.cookie = "world-influenza=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
  Materialize.toast('Removed ebola from world', 3000, 'rounded')
}

function sendEarthquake(){
  document.cookie = "world-earthquake=sent; expires=0; path=/;";
  Materialize.toast('Earthquake sent', 3000, 'rounded');
	$('#triggerInfluenza').modal('close');
}

setInterval("my_function();",2000);
function my_function(){
  var name="doAction";
  if(name){
   $.ajax({
   type: 'post',
   url: 'processing.php',
   dataType: 'text',
   data: {
    action:name,
   },
   success: function (response) {
    eval(response);
    window.scrollTo(0, document.body.scrollHeight);
   }
   });
  }
}

$(document).ready(function(){
    // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
    $('.modal').modal();
  });
</script>
<body>
  <main>
    <nav id="virtualworldhead">
      <div class="nav-wrapper indigo darken-3">
        <a href="index.php" class="brand-logo center">Virtual World</a>
      </div>
    </nav>

    <div class="container">
      <div class="row" style="margin-top:30px;">
        <div class="col s12 m6">
          <div class="card hoverable">
            <div class="card-content">
              <span class="card-title">Introduction</span>
              <p>A mini virtual world growing itself</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col s12 m6" id="loggingID">
          <p>Logging starts here</p>
          <div class="divider"></div>
        </div>

        <div class="infoCard">
          <div class="card hoverable">
            <div class="card-content">
              <span class="card-title">General report</span>
              <p id="totalWorldPopulation">World not generated</p>
              <p id="totalWorldAccident">No accidents yet</p>
              <p id="totalWorldCancer">No cancer yet</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="fixed-action-btn horizontal click-to-toggle">
      <a class="btn-floating btn-large red">
        <i class="material-icons">menu</i>
      </a>
      <ul>
        <li><a class="btn-floating yellow darken-1" href="#virtualworldhead"><i class="material-icons">arrow_upward</i></a></li>
        <li><a class="btn-floating orange darken-1 modal-trigger" href="#triggerInfluenza"><i class="material-icons">access_time</i></a></li>
        <li><a class="btn-floating green" onclick="deleteCookie()"><i class="material-icons">refresh</i></a></li>
      </ul>
    </div>

    <div id="triggerInfluenza" class="modal">
    <div class="modal-content">
      <h4>Disaster trigger</h4>
      <p>This panel gives the option increase/decrease the chance of death</p>
      <div class="row">
        <div class="col s12">
          Virus of the day : Ebola
        </div>
      </div>
      <div class="row">
        <a class="waves-effect waves-light btn col s6 m3" style="margin:5px;" onclick="setInfluenza();">Spread</a>
        <a class="waves-effect waves-light btn col s6 m3" style="margin:5px;" onclick="removeInfluenza();">Remove</a>
      </div>

			<p>Earthquake</p>
			<div class="row">
          <a class="waves-effect waves-light btn col s6 m3" style="margin:5px;" onclick="sendEarthquake();">Send</a>
      </div>
    </div>
  </div>



  </main>
</body>
