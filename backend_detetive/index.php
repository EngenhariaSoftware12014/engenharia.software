<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<title>Eng. III - Fatec Project Manager</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">

<Script >	
		
	 var http_request
	 var cObjAjax
	function MakeRequest(cpagina,cObj)

		{  
		cObjAjax = cObj
		http_request = false; 

        if (window.XMLHttpRequest) { // Mozilla, Safari,...
            http_request = new XMLHttpRequest();
            if (http_request.overrideMimeType) {
                http_request.overrideMimeType('text/xml');
                // See note below about this line 
            }
        } else if (window.ActiveXObject) { // IE
            try {
                http_request = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
                try {
                    http_request = new ActiveXObject("Microsoft.XMLHTTP");
                } catch (e) {}
            }
        }

        if (!http_request) {
            alert('Giving up :( Cannot create an XMLHTTP instance');
            return false;
        }                           

        url = cpagina;
		http_request.open("GET", url, true);
		http_request.onreadystatechange = alertContents;
        
        http_request.send(null);        
        
//return url;  
    			   
    }
    function alertContents() {
	var result = document.getElementById(cObjAjax);
        if (http_request.readyState == 4) {
            if (http_request.status == 200) {  
				result.innerHTML = http_request.responseText;  
				
	         } else {
                alert('There was a problem with the request.');
				result.innerHTML = "erro:" + http_request.statusText;
            		}
        										}

											}
	MakeRequest("central.php","body");			
	</script>
</head>
<body>
	<div id="background">
		<div id="header" align="center">
			<div >
				<div >
					<a href="central.php" class="logo"><img src="images/logo.png" alt=""></a>
					<ul>
						<li>
							<a href="javascript:MakeRequest('central.php','body');" id="menu1">Principal</a>
						</li>
						<li>
							<a href="javascript:MakeRequest('games.php','body');" id="menu2">O Jogo</a>
						</li>
						<li>
							<a href="javascript:MakeRequest('about.php','body');" id="menu3">Sobre</a>
						</li>
						<li>
							<a href="login.php" id="menu4">Acesse</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div name="body" id="body">
			
		</div>
		<div id="footer">
			<div>
				<p>
					@ copyright 2012. all rights reserved. Template of <a href="http://freewebsitetemplates.com/go/googleplus/">Free Web Site Templates</a>
				</p>
			</div>
		</div>
	</div>
</body>
</html>
