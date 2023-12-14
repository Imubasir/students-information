<?php
require("../../../../../../Db/connection.php");
set_time_limit(0);

ob_start();
try {
    if (
        !isset($_FILES['file']['error']) ||
        is_array($_FILES['file']['error'])
    ) {
        throw new RuntimeException('Invalid parameters.');
    }

    switch ($_FILES['file']['error']) {
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_NO_FILE:
            throw new RuntimeException('No file sent.');
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            throw new RuntimeException('Exceeded filesize limit.');
        default:
            throw new RuntimeException('Unknown errors.');
    }

    $filepath = sprintf('files/%s_%s', uniqid(), $_FILES['file']['name']);

    if (!is_uploaded_file($_FILES['file']['tmp_name'])) {
        throw new RuntimeException('Failed to move uploaded file.');
    } else {
                $has_title_row = true;
                $not_done = array();
        $filename = basename($_FILES['file']['name']);
            if(substr($filename, -3) == 'csv'){
            $tmpfile = $_FILES['file']['tmp_name'];
            if (($fh = fopen($tmpfile, "r")) !== FALSE) {
                $i = 0;
                while (($items = fgetcsv($fh, 10000, ",")) !== FALSE) {
					
					// $uin=str_replace("'","",strtoupper($items[0]));
					// $indexno=str_replace("'","",strtoupper($items[1]));
					// $month=strtoupper($items[2]);
					// $year=strtoupper($items[3]);
					// $dob=strtoupper($items[4]);
					// $cname=strtoupper($items[5]);
					// $sub1=strtoupper($items[6]);
					// $gd1=strtoupper($items[7]);
					// $sub2=strtoupper($items[8]);
					// $gd2=strtoupper($items[9]);
					// $sub3=strtoupper($items[10]);
					// $gd3=strtoupper($items[11]);
					// $sub4=strtoupper($items[12]);
					// $gd4=strtoupper($items[13]);
					// $sub7=strtoupper($items[14]);
					// $gd7=strtoupper($items[15]);
					// $sub8=strtoupper($items[16]);
					// $gd8=strtoupper($items[17]);
					// $sub9=strtoupper($items[18]);
					// $gd9=strtoupper($items[19]);
					// $sub10=strtoupper($items[20]);
					// $gd10=strtoupper($items[21]);
					
									
					// $sqlcheck="select * from tbl_verified where indexno='$indexno' and uin='$uin'";
					// $checkresult=mysqli_query($conn, $sqlcheck) or die(mysqli_error());
					// if (mysqli_num_rows($checkresult)<=0){
                    
							
					// $sql = "";
							
     //                $result = mysqli_query($conn, $sql);
     //                    if($result) {
                            
     //                    } else {
     //                        $not_done[] = $items;
     //                    }
					
					// }
					
					// mysqli_free_result($checkresult);
     //                $i++;
                }
            }
            // if there are any not done records found:
            if(!empty($not_done)){
                echo "<strong>Some records could not be inserted</strong><br />";
                print_r($not_done);
            	}
            flush();
    		ob_flush();
			exit;
		} else {
		    die('Invalid file format uploaded. Please upload CSV.');
		}
        }
    

    // All good, send the response
    echo json_encode([
        'status' => 'ok',
        'path' => $filepath
    ]);

} catch (RuntimeException $e) {
	// Something went wrong, send the err message as JSON
	http_response_code(400);

	echo json_encode([
		'status' => 'error',
		'message' => $e->getMessage()
	]);
}