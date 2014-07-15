<?php
/**
 * Created by PhpStorm.
 * User: Dora
 * Date: 14/07/03
 * Time: 20:44
 */
    require_once('db.php');

    $validateMail = $_REQUEST['fieldValue'];
    $validateId = $_REQUEST['fieldId'];

    $mail = $_REQUEST['user_mail'];
    $validateError = "このメールアドレスは登録されています";
    $validateSuccess = "OK";

    $arrayToJs = array();
    $arrayToJs[0] = $validateId;

    $query = "select mmail from member where mmail = '$validateMail'";
    $result = mysqli_query($dbc, $query);
    mysqli_close($dbc);

    $row = $result->fetch_row();

        if(isset($row[0])){

        if($row[0] == $mail) {
            $arrayToJs[1] = true;
            echo json_encode($arrayToJs);
        } else {
            $arrayToJs[1] = false;
            echo json_encode($arrayToJs);
        }
        }else{
            $arrayToJs[1] = true;
            echo json_encode($arrayToJs);
        }