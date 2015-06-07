<html>
	
	<!--******************************************************************
	**********************************************************************
	 
	  Conor Walsh 2015
	     Website: http://www.conorwalsh.net
	     GitHub:  https://github.com/conorwalsh
	  
	  Version 0.5
	  
	  First created: 7th June 2015
	  Last modified: 7th June 2015
	  
	 **************************** LICENCE *******************************
	 
	 Copyright (c) 2015 Conor Walsh
	
	 Permission is hereby granted, free of charge, to any person obtaining
	 a copy of this software and associated documentation files (the
	 "Software"), to deal in the Software without restriction, including
	 without limitation the rights to use, copy, modify, merge, publish,
	 distribute, sublicense, and/or sell copies of the Software, and to
	 permit persons to whom the Software is furnished to do so, subject to
	 the following conditions:
	
	 The above copyright notice and this permission notice shall be included
	 in all copies or substantial portions of the Software.
	
	 THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
	 OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
	 MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
	 IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
	 CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
	 TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
	 SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
	  
	**********************************************************************
	*******************************************************************-->
	
	<head>
		<title>Humidex</title>
	</head>
	
	<body>
		
		<h1>Calculate Humidex</h1>
		
		<form method="get"action="">
			<label for="t">Temperature (&#176;C): </label>
			<input type="number" min="-100" max="800" step="any" value="<?php echo $_GET["t"]; ?>" name="t" id="t"/>
			<label for="h">Humidity (%): </label>
			<input type="number" min="0" max="100" value="<?php echo $_GET["h"]; ?>" name="h" id="h"/>
			<button type="submit">Calculate</button>
		</form>
		
		<?php
			
			//Get the temp and humidity using the GET command
			$temp = $_GET['t'];
			$hum = $_GET['h'];
			//Constant used to convert Degrees Celsius to Kelvin 
			$Kconst = 273.15;
		
			echo "Temperature: " . $temp . "&#176;C<br/><br/>";
		
			echo "Humidity: " . $hum . "%<br/><br/>";
			
			//Calculate the dewpoint which is needed in the equeation
			$dewpoint = pow(($hum/100),(1/8))*(112+(0.9*$temp))+(0.1*$temp)-112;
		
			echo "Dewpoint: " . round($dewpoint,2) . "&#176;C<br/><br/>";
		
			//Convert the dewpoint from C to K
			$dewpointK = $dewpoint + $Kconst;
		
			echo "Dewpoint Kelvin: " . round($dewpointK, 2) . "K<br/><br/>";
		
			//Calculate the Humidex
			$humidex = $temp + 0.5555*(6.11*pow(exp(1),(5417.7530*((1/273.16)-(1/$dewpointK))))-10);
			
			$comfort = "";
			$humidexcolor = "";
			
			if(round($humidex)<20){
				$comfort = "Below Scale Start Point";
				$humidexcolor = "#000000";
			}
			else if(round($humidex)>=20 && round($humidex)<30){
				$comfort = "Comfortable";
				$humidexcolor = "#4CD900";
			}
			else if(round($humidex)>=30 && round($humidex)<40){
				$comfort = "Some Discomfort";
				$humidexcolor = "#FFD800";
			}
			else if(round($humidex)>=40 && round($humidex)<=45){
				$comfort = "Great Discomfort";
				$humidexcolor = "#FF6A00";
			}
			else if(round($humidex)>45){
				$comfort = "Dangerous";
				$humidexcolor = "#FF0000";
			}
		
			echo "<div style='text-decoration:underline; color: " . $humidexcolor . "'>Humidex: <strong>" . round($humidex,1) . "</strong></div><br/>";
			
			echo "<div style='color: " . $humidexcolor . "'>Comfort Level: <strong>" . $comfort . "</strong></div><br/>";
		
		?>
		
		<table border="1">
			<tr><td><strong>Humidex Range</strong></td><td><strong>Degree of Comfort</strong></td></tr>
			<tr><td>20-29</td><td style="color: #4CD900;">Comfortable</td></tr>
			<tr><td>30-39</td><td style="color: #FFD800;">Some Discomfort</td></tr>
			<tr><td>40-45</td><td style="color: #FF6A00;">Great Discomfort</td></tr>
			<tr><td>>45</td><td style="color: #FF0000;">Dangerous</td></tr>
		</table>
		
	</body>
	
</html>
