
<?php
header('Content-Type: application/json');

$smallestDistance=40192000;//circumference of the earth i.e. largest distance
$radius=6371000;//radius of the earth in meters
$result=array();


//check if the values have been set
if( !isset($_GET['lat']) ) { 
	$result['status'] = 'No function arguments!'; 
	echo json_encode($result);
}
else {
	//get the require longitude and latitude
	$lat1=floatval($_GET['lat']);
	$long1=floatval($_GET['long']);

	//open the csv file
	if (($handle = fopen("pharmacies.csv", "r")) !== FALSE) 
	{
		//read the file row by row until it reaches end of file
		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
		   {
		    	
		    	//ignore the first column which contains only table header not the values
		    	if($data[5]=="latitude")
		    	{
		    		continue;
		    	}

		    	// calculate distance between two points using "Haversine" formula
		    	$lat2=$data[5]; $long2=$data[6];
				$phiOne=deg2rad($lat1);
				$phiTwo=deg2rad($lat2);
				$deltaPhi=deg2rad($lat2-$lat1);
				$deltaLamda=deg2rad($long2-$long1);

				$a=sin($deltaPhi/2)*sin($deltaPhi/2)+cos($phiOne)*cos($phiTwo)*sin($deltaLamda/2)*sin($deltaLamda/2);
				$c=2*atan2(sqrt($a), sqrt(1-$a));
				$distance=$radius*$c; // required distance

				//check if the distance is the smallest one
		    	if($distance < $smallestDistance)
		    	{
		    		$smallestDistance=$distance;//change current value to smallest 
		    		$output=$data;//change output to values of current data
		    	}

		    }
		    //close the file
		    fclose($handle);
		}
	}


//change distance to miles and store it in result variable
$result['smallestDistance']=$smallestDistance/1600;

//store required data to result variable
$result['name']=$output[0];
$result['location']=$output[1];

//return json data
echo json_encode($result);



?>


