<?php
$connect = mysqli_connect('localhost', 'root', 'Password', 'Clinicpatients' , 3306);
if(!$connect){die('no connection'. mysql_error());}

function queryMysql($query)
{
    global $connect;
    $result = $connect->query($query);
    if(!$result) die("Fatal Error");
    return $result;
}

function destroySession()
{
    $_SESSION = array();
    if(session_id() != "" || isset($_COOKIE[session_name()])) setcookie (session_name(), '', time()-2592000, '/');
    session_destroy();
}

function sanitizeString($var)
{
    global $connect;
    $var = strip_tags($var);
    $var = htmlentities($var);
    if(get_magic_quotes_gpc())
        $var = stripslashes($var);
    return $connect-> real_escape_string($var);
}

function showPatient($patient)
{
    if ($patient)
       
        $result = queryMysql("SELECT * FROM tblPatients WHERE PatientName = $patient");
    
if ($result -> num_rows) 
    {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        echo stripslashes($row ['text']);
        
    }   
    else echo "<p>Nothing to see here, yet</P>";    
}

function my_sql_fatal_error()
{
    echo <<<_END
    
    <div>  We are sorry, but it was not possible to complete the requested task. 
            The error message we got was: <p class = 'error'> Fatal Error </p>
            Please click the back navigating button on your browser and try again.
    </div>
    
    
_END;
}    
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
