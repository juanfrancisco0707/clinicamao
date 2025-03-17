<?php
    $dbhost ='localhost'; //$_SERVER['SERVER_NAME'];
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'bdclinica';
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    $backupAlert = '';
    $tables = array();
    $result = mysqli_query($connection, "SHOW TABLES");
    if (!$result) {
        $backupAlert = 'Error found.<br/>ERROR : ' . mysqli_error($connection) . 'ERROR NO :' . mysqli_errno($connection);
    } else {
        while ($row = mysqli_fetch_row($result)) {
            $tables[] = $row[0];
        }
        mysqli_free_result($result);

        $return = '';
        foreach ($tables as $table) {

            $result = mysqli_query($connection, "SELECT * FROM " . $table);
            if (!$result) {
                $backupAlert = 'Error found.<br/>ERROR : ' . mysqli_error($connection) . 'ERROR NO :' . mysqli_errno($connection);
            } else {
                $num_fields = mysqli_num_fields($result);
                if (!$num_fields) {
                    $backupAlert = 'Error found.<br/>ERROR : ' . mysqli_error($connection) . 'ERROR NO :' . mysqli_errno($connection);
                } else {
                    $return .= 'DROP TABLE ' . $table . ';';
                    $row2 = mysqli_fetch_row(mysqli_query($connection, 'SHOW CREATE TABLE ' . $table));
                    if (!$row2) {
                        $backupAlert = 'Error found.<br/>ERROR : ' . mysqli_error($connection) . 'ERROR NO :' . mysqli_errno($connection);
                    } else {
                        $return .= "\n\n" . $row2[1] . ";\n\n";
                        for ($i = 0; $i < $num_fields; $i++) {
                            while ($row = mysqli_fetch_row($result)) {
                                $return .= 'INSERT INTO ' . $table . ' VALUES(';
                                for ($j = 0; $j < $num_fields; $j++) {
                                    $row[$j] = addslashes($row[$j]);
                                    if (isset($row[$j])) {
                                        $return .= '"' . $row[$j] . '"';
                                    } else {
                                        $return .= '""';
                                    }
                                    if ($j < $num_fields - 1) {
                                        $return .= ',';
                                    }
                                }
                                $return .= ");\n";
                            }
                        }
                        $return .= "\n\n\n";
                    }
                  
                    $backup_file = 'D:/xampp/respaldos/' . $dbname . date("Y-m-d-H-i-s") . '.sql';
                    
                    $handle = fopen("{$backup_file}", 'w+');
                    fwrite($handle, $return);
                    fclose($handle);
                    $backupAlert = 'Respaldo Correcto!';
                    
                }
            }
        }
    }


    
   // $sentMailResult =   mail("clinica2022@gmail.com","Asunto","Prueba","From: jfug0707@gmail.com");
    //mail($recipient_email, $subject, $body, $headers);
    echo $backupAlert;
   // if($sentMailResult )
   // {
   //    echo "Respaldo enviado satisfactoriamente";
   //    unlink($name); // delete the file after attachment sent.
   // }
   // else
    //{
    //   die("Sorry but the email could not be sent.
    //                Please go back and try again!");
   // }
 /*  function mail_attachment($filename, $path, $mailto, $from_mail, $from_name, $replyto, $subject, $message) {
    $file = $path.$filename;
    $file_size = filesize($file);
    $handle = fopen($file, "r");
    $content = fread($handle, $file_size);
    fclose($handle);
    $content = chunk_split(base64_encode($content));
    $uid = md5(uniqid(time()));
    $header = "From: ".$from_name." <".$from_mail.">\r\n";
    $header .= "Reply-To: ".$replyto."\r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
    $header .= "This is a multi-part message in MIME format.\r\n";
    $header .= "--".$uid."\r\n";
    $header .= "Content-type:text/plain; charset=iso-8859-1\r\n";
    $header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $header .= $message."\r\n\r\n";
    $header .= "--".$uid."\r\n";
    $header .= "Content-Type: application/octet-stream; name=\"".$filename."\"\r\n"; // use different content types here
    $header .= "Content-Transfer-Encoding: base64\r\n";
    $header .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
    $header .= $content."\r\n\r\n";
    $header .= "--".$uid."--";
    if (mail($from_mail,$subject,"", $mailto, $header)) {
    echo "mail send ... OK"; // or use booleans here
    } else {
    echo "mail send ... ERROR!";
    }
   }
   $my_file = "respaldo.rar";
   $my_path = "D:/xampp/htdocs/vistas/";//"/your_path/to_the_attachment/";
   $my_name = "jf";
   $my_mail = "clinicaced2022@gmail.com";
   $my_replyto = "clinicaced2022@gmail.com";
   $my_subject = "This is a mail with attachment.";
   $my_message = "Hallo, you like this script? I hope it will help Jf";
   mail_attachment($my_file, $my_path, "jfug0707@gmail.com", $my_mail, $my_name, $my_replyto, $my_subject, $my_message);
*/
     
?>