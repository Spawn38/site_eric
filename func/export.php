<?php
session_start();
header("Content-Type: text/json; charset=utf8");
include('checkLogin.php');
if(!isSet($_SESSION['login']) || !isSet($_SESSION['password']) || !checkLogin($_SESSION['login'], $_SESSION['password'])) {
	echo json_encode(array(
		'success' => false,
		'reason' => 'acces interdit'
		));
	return;
}

try {
	ob_start();
    include(__DIR__.'/../admin/config.php');

		mysqli_query("SET NAMES 'utf8'");
    $queryTables = mysqli_query($dbC,'SHOW TABLES');

    while ($row = mysqli_fetch_row($queryTables))
    {
			$target_tables[] = $row[0];
    }

    $content = "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\r\nSET time_zone = \"+00:00\";\r\n\r\n\r\n/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;\r\n/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;\r\n/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;\r\n/*!40101 SET NAMES utf8 */;\r\n";
		foreach ($target_tables as $table)
		{
  		$result = mysqli_query($dbC,'SELECT * FROM ' . $table);
		  $fields_amount = $result->field_count;
		  $rows_num      = mysqli_affected_rows($dbC);
		  $res = mysqli_query($dbC,'SHOW CREATE TABLE ' . $table);
			$TableMLine = mysqli_fetch_row($res);

			$content .= "\n\n" . $TableMLine[1] . ";\n\n";

      for ($i = 0, $st_counter = 0; $i < $fields_amount; $i++, $st_counter = 0)
      {
        while ($row = mysqli_fetch_row($result))
		    { //when started (and every after 100 command cycle):
		    	if ($st_counter % 100 == 0 || $st_counter == 0)
		      {
		      	$content .= "\nINSERT INTO " . $table . " VALUES";
		      }
		      $content .= "\n(";
		      for ($j = 0; $j < $fields_amount; $j++)
		      {
		      	$row[$j] = str_replace("\n", "\\n", addslashes($row[$j]));
		        if (isset($row[$j]))
		        {
		        	$content .= '"' . $row[$j] . '"';
		        }
		        else
		        {
		          $content .= '""';
		        }
						if ($j < ($fields_amount - 1))
		        {
		          $content.= ',';
		        }
		      }
		      $content .=")";
		      //every after 100 command cycle [or at last line] ....p.s. but should be inserted 1 cycle eariler
		      if ((($st_counter + 1) % 100 == 0 && $st_counter != 0) || $st_counter + 1 == $rows_num)
		      {
		      	$content .= ";";
		      }
		      else
		      {
		      	$content .= ",";
		      }
					$st_counter = $st_counter + 1;
		    }
		  }
			$content .="\n\n\n";
		}
		$content .= "\r\n\r\n/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;\r\n/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;\r\n/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;";

    ob_end_flush();

		$zip = new ZipArchive;
		$backup_name =  "export___(" . date('H-i-s') . "_" . date('d-m-Y') . ")__rand" . rand(1, 11111111);
		$res = $zip->open(__DIR__.'/../upload/'.$backup_name.".zip", ZipArchive::CREATE);
		if ($res === TRUE) {
    	$zip->addFromString($backup_name.".sql", $content);
    	$zip->close();

			$file = __DIR__.'/../upload/'.$backup_name.".zip";
			$file_size = filesize($file);
			$handle = fopen($file, "r");
			$contentFile = fread($handle, $file_size);
			fclose($handle);
			$contentFile = chunk_split(base64_encode($contentFile));
			$uid = md5(uniqid(time()));
			$filename = basename($file);

			$to = "eric.silvestrini@spra-france.fr";			
			$subject = "Export de configuration";
			$mail = "eric.silvestrini@spra-france.fr";
			$headers = "From: eric.silvestrini@spra-france.fr\r\n";
			$headers .= "Reply-To: eric.silvestrini@spra-france.fr\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";

			// message & attachment
			$message = "fichier de sauvegarde : ".$backup_name.".zip";


			$nmessage = "--".$uid."\r\n";
			$nmessage .= "Content-type:text/plain; charset=iso-8859-1\r\n";
			$nmessage .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
			$nmessage .= $message."\r\n\r\n";
			$nmessage .= "--".$uid."\r\n";
			$nmessage .= "Content-Type: application/octet-stream; name=\"".$filename."\"\r\n";
			$nmessage .= "Content-Transfer-Encoding: base64\r\n";
			$nmessage .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
			$nmessage .= $contentFile."\r\n\r\n";
			$nmessage .= "--".$uid."--";

			$response = mail($to, $subject, $nmessage, $headers);

			if($res) {
			echo json_encode(array(
						'success' => true
				));
			} else {
				echo json_encode(array(
						'success' => false,
						'reason' => 'erreur lors de la création du mail'
				));
			}
		} else {
			echo json_encode(array(
					'success' => false,
					'reason' => 'impossible de créer le fichier'
			));
		}
} catch(Exception $ex){
    echo json_encode(array(
        'success' => false,
        'reason'  => $ex->getMessage(),
    ));
}

?>
