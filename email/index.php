<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
$dbhost ='localhost'; //$_SERVER['SERVER_NAME'];
    $dbuser = 'root';
    $dbpass = 'clave';
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
                    $backupAlert = 'El Respaldo se realizó Correctamente!';
                    
                }
            }
        }
    }
    echo $backupAlert;

$mail = new PHPMailer(true);
try {
    
    $mail->SMTPDebug = 0;//SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'clinicaced2022@gmail.com';
    $mail->Password = 'Clinica2022';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('jfug0707@gmail.com', 'Administrador');
    $mail->addAddress('clinicaced2022@gmail.com', 'Receptor');
    $mail->addAttachment('D:/xampp/respaldos/' . $dbname . date("Y-m-d-H-i-s") . '.sql');
    $mail->isHTML(true);
    $mail->Subject = 'Respaldo de Datos';
    $mail->Body = ', <br/>Este correo no requiere ser contestado <b>Gmail</b>.';
    $mail->send();

    echo '...';
} catch (Exception $e) {
    echo 'Mensaje ' . $mail->ErrorInfo;
}
