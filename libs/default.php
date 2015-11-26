<?php 
$link = mysqli_connect(Core::$DB_LOCAL, Core::$DB_LOGIN, Core::$DB_PASS, Core::$DB_NAME);
mysqli_set_charset($link, 'uft-8');

function wtf($array, $stop = false) {
  echo '<pre>'.print_r($array,1).'</pre>';
  if(!$stop) {
    exit();
  }
}

function query($query) { //mysqli_query
    global $link;
    $res = mysqli_query($link,$query);
    if($res === false) {
        $info = debug_backtrace();
        // echo '<pre>'; print_r($info); echo '</pre>';
        $error = 'Query: '.$query.'<br>'.mysqli_error($link)."<br>\n".
        "file: ".$info[0]['file']."<br>\n".
        "line: ".$info[0]['line']."<br>\n".
        "date: ".date('Y-m-d H:i:s')."<br>\n";

        //ошибки в логи
        file_put_contents('./logs/mysql.log',strip_tags($error)."\n\n",FILE_APPEND);
        echo $error;
        exit();
    } else {
        return $res;
    }
}

$array = array(' text d   ', '   2    ', '2   2', array('x' => '   5  ', 'y' => '  10  '));

function trim_all($elem) {
    if(!is_array($elem)) {
        $elem = trim($elem);
    } else {
        $elem = array_map('trim_all', $elem);
    }
    return $elem;
}
function int_all($elem) {
    if(!is_array($elem)) {
        $elem = (int)($elem);
    } else {
        $elem = array_map('int_all', $elem);
    }
    return $elem;
}
function floatAll($elem) {
    if(!is_array($elem)) {
        $elem = (float)($elem);
    } else {
        $elem = array_map('floatAll', $elem);
    }
    return $elem;
}
function mysqli_real_escape_string_All($elem) {
    global $link;
    if(!is_array($elem)) {
        $elem = mysqli_real_escape_string($link,$elem);
    } else {
        $elem = array_map('mysqli_real_escape_string_All', $elem);
    }
    return $elem;
}
function htmlspecialcharsAll($elem) {
    if(!is_array($elem)) {
        $elem = htmlspecialchars($elem);
    } else {
        $elem = array_map('htmlspecialcharsAll', $elem);
    }
    return $elem;
}
function myHash($var) {
    $salt = '3jd';
    $salt2 = 'yhz';
    $var = crypt(md5($var.$salt),$salt2);

    return $var;
}

// echo '<pre>';
// print_r(array_map('trim_all',$array));
// echo '</pre>';

function __autoload($class) {
    include './libs/class_'.$class.'.php';
}

?>