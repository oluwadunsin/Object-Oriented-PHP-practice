<?php
  if (!defined("_AXES_ALLOWED")) die('Direct access to this location is not allowed.');
  
  /**
   * redirect_to()
   * 
   * @param mixed $location
   * @return
   */
  function redirect_to($location){
    if (!headers_sent()) {
          header('Location: ' . $location);
		  exit;
	  } else{
          echo '<script type="text/javascript">';
          echo 'window.location.href="' . $location . '";';
          echo '</script>';
          echo '<noscript>';
          echo '<meta http-equiv="refresh" content="0;url=' . $location . '" />';
          echo '</noscript>';
      }
  }

  function to_date($stamp, $format){
    return date($format,$stamp);
  }

  function read_template($template,$core,$user,$special=false){
    $variables = array();

    $variables['site_title'] = $core->title;
    $variables['username'] = (($special) ? $user->username : $_SESSION['user']['username']);
    $variables['year'] = date('Y');
    $variables['site_name'] = $core->name;
    $variables['site_url'] = $core->site_url;
    $variables['facebook'] = $core->contact_facebook;
    $variables['twitter'] = $core->contact_twitter;
    $variables['instagram'] = $core->contact_instagram;
    $variables['whatsapp'] = $core->contact_whatsapp;
    $variables['time'] = to_date($user->last_login,"d-m-Y");
    $variables['ip'] = $user->ip;
    $variables['browser'] = $user->browser;
    $variables['location'] = $user->location;
    $variables['activate'] = $user->activate_link;

    $template = file_get_contents($template);

    foreach($variables as $key => $value){
        $template = str_replace('{{'.$key.'}}', $value, $template);
    }
    return $template;

  }

  function check_path($path){
    $url_path = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
    if(stripos($url_path,$path) !== false) return true;
    return false;
  }

  function send_mail($tmail,$tname,$subject,$message,$core){
        Registry::set('Mail',new PHPMailer\PHPMailer\PHPMailer());
        $mail = Registry::get("Mail");
        try {
          $mail->setFrom($core->sender_email, $core->sender_name);
          $mail->addAddress($tmail, $tname);
          $mail->addReplyTo($core->support_mail, $core->sender_name);
          
          $mail->isHTML(true);
          $mail->Subject = $subject;

          $mail->Body = $message;
          $mail->send();  
        } catch (Exception $e) {
          if(DEBUG)array_push($debug_error, 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo,'<br>');
        }
  }

  function start_form(){
    if (strlen(session_id()) < 1) session_start();

    if(!isset($_SESSION['form'])) $_SESSION['form'] =  array();
    else if (!is_array($_SESSION['form']))  $_SESSION['form'] = array();

    if(!isset($_SESSION['form_error'])) $_SESSION['form_error'] = array();
    else if (!is_array($_SESSION['form_error']))  $_SESSION['form_error'] = array();
    
    if(empty($_SESSION['form'])) init_form();
  }

  function set_form($key, $value){
    $_SESSION['form'][$key] = $value;
    $_SESSION['form']['key'] = '$value';
  }

  function interprete_form(){
    global $form;
    global $form_error;
    foreach($_SESSION['form'] as $key=>$value){
      $form[$key] = $value;
    }
    foreach($_SESSION['form_error'] as $key=>$value){
      $form_error[$key] = $value;
    }
  }

  function set_form_error($key, $value){
    $_SESSION['form_error'][$key] = $value;
  }

  function clean_form(){
    unset($_SESSION['form']);
    unset($_SESSION['form_error']);
    start_form();
  }

  function init_form(){
    $_SESSION['form']['sub_email'] = null;
    $_SESSION['form']['username'] = null;
    $_SESSION['form']['password'] = null;
    $_SESSION['form']['conf_password'] = null;
    $_SESSION['form']['name'] = null;
    $_SESSION['form']['email'] = null;
    $_SESSION['form']['subject'] = null;
    $_SESSION['form']['message'] = null;
    $_SESSION['form']['firstname'] = null;
    $_SESSION['form']['lastname'] = null;
    $_SESSION['form']['success'] = null;

    $_SESSION['form_error']['sub_email_error'] = null;
    $_SESSION['form_error']['name_error'] = null;
    $_SESSION['form_error']['username_error'] = null;
    $_SESSION['form_error']['password_error'] = null;
    $_SESSION['form_error']['login_error'] = null;
    $_SESSION['form_error']['email_error'] = null;
    $_SESSION['form_error']['subject_error'] = null;
    $_SESSION['form_error']['message_error'] = null;
    $_SESSION['form_error']['forgot_error'] = null;
    $_SESSION['form_error']['activate_error'] = null;
    $_SESSION['form_error']['reset_error'] = null;
    $_SESSION['form_error']['password_error'] = null;
    $_SESSION['form_error']['register_error'] = null;
    $_SESSION['form_error']['register_success'] = null;
    $_SESSION['form_error']['firstname_error'] = null;
    $_SESSION['form_error']['lastname_error'] = null;
    $_SESSION['form_error']['terms_error'] = null;
    $_SESSION['form_error']['contact_error'] = null;
    $_SESSION['form_error']['profile_error'] = null;
    $_SESSION['form_error']['img_error'] = null;
    $_SESSION['form_error']['withdraw_error'] = null;
  }
  
  function next_hour($timed){
    $offset = $timed - ($timed % 3600);
    return $offset+3600;
  }

  function plan_name($name){
      if($name == 1) return "Hour";
      if($name == 2) return "Day";
      if($name == 3) return "Week";
      if($name == 4) return "Month";
      else return "Year";
  }

  function check_image($img){

    $path = $img['name'];
    $path_tmp = $img['tmp_name'];

    if($path != '') {
      return true;
    }else return false;

  }

  function image_upload($img,$format,$name,$upload_path){
    clean_form();

    $path = $img['name'];
    $path_tmp = $img['tmp_name'];

    if($path != '') {
        $ext = pathinfo( $path, PATHINFO_EXTENSION );
        $file_name = basename( $path, '.' . $ext );
        if( $ext!=$format && $format != NULL) {
            set_form_error('img_error','You must have to upload '. $format .' file');
            return false;
        }
        // removing the existing photo
        clearstatcache();
        if(file_exists($upload_path.$name)){
          unlink($upload_path.$name);
        }

        // updating the data
        $final_name = $name.'.'.$ext;
        move_uploaded_file( $path_tmp, $upload_path.$final_name );

        return true;
    }else return 'Choose a file to upload';
  }

  /**
   * countEntries()
   * 
   * @param mixed $table
   * @param string $where
   * @param string $what
   * @return
   */
  function countEntries($table, $where = '', $what = ''){
      if (!empty($where) && isset($what)) {
          $q = "SELECT COUNT(*) FROM " . $table . "  WHERE " . $where . " = '" . $what . "' LIMIT 1";
      } else
          $q = "SELECT COUNT(*) FROM " . $table . " LIMIT 1";
      
      $record = Registry::get("Database")->query($q);
      $total = Registry::get("Database")->fetchrow($record);
      return $total[0];
  }
  
  /**
   * getChecked()
   * 
   * @param mixed $row
   * @param mixed $status
   * @return
   */
  function getChecked($row, $status){
      if ($row == $status) {
          echo "checked=\"checked\"";
      }
  }
  
  /**
   * post()
   * 
   * @param mixed $var
   * @return
   */
  function post($var){
      if (isset($_POST[$var])) return $_POST[$var];
  }
  
  /**
   * get()
   * 
   * @param mixed $var
   * @return
   */
  function get($var){
      if (isset($_GET[$var])) return $_GET[$var];
  }
  
  /**
   * sanitize()
   * 
   * @param mixed $string
   * @param bool $trim
   * @return
   */
  function sanitize($string, $trim = false, $int = false, $str = false){
      $string = filter_var($string, FILTER_SANITIZE_STRING);
      $string = trim($string);
      $string = stripslashes($string);
      $string = strip_tags($string);
      $string = str_replace(array('‘', '’', '“', '”'), array("'", "'", '"', '"'), $string);
      
	  if ($trim)
          $string = substr($string, 0, $trim);
      if ($int)
		  $string = preg_replace("/[^0-9\s]/", "", $string);
      if ($str)
		  $string = preg_replace("/[^a-zA-Z\s]/", "", $string);
		  
      return $string;
  }

  /**
   * cleanSanitize()
   * `
   * @param mixed $string
   * @param bool $trim
   * @return
   */
  function cleanSanitize($string, $trim = false,  $end_char = '&#8230;'){
	  $string = cleanOut($string);
      $string = filter_var($string, FILTER_SANITIZE_STRING);
      $string = trim($string);
      $string = stripslashes($string);
      $string = strip_tags($string);
      $string = str_replace(array('‘', '’', '“', '”'), array("'", "'", '"', '"'), $string);
      
	  if ($trim) {
        if (strlen($string) < $trim)
        {
            return $string;
        }

        $string = preg_replace("/\s+/", ' ', str_replace(array("\r\n", "\r", "\n"), ' ', $string));

        if (strlen($string) <= $trim)
        {
            return $string;
        }

        $out = "";
        foreach (explode(' ', trim($string)) as $val)
        {
            $out .= $val.' ';

            if (strlen($out) >= $trim)
            {
                $out = trim($out);
                return (strlen($out) == strlen($string)) ? $out : $out.$end_char;
            }       
        }
	  }
      return $string;
  }

  /**
   * truncate()
   * 
   * @param mixed $string
   * @param mixed $length
   * @param bool $ellipsis
   * @return
   */
  function truncate($string, $length, $ellipsis = true){
      $wide = strlen(preg_replace('/[^A-Z0-9_@#%$&]/', '', $string));
      $length = round($length - $wide * 0.2);
      $clean_string = preg_replace('/&[^;]+;/', '-', $string);
      if (strlen($clean_string) <= $length)
          return $string;
      $difference = $length - strlen($clean_string);
      $result = substr($string, 0, $difference);
      if ($result != $string and $ellipsis) {
          $result = add_ellipsis($result);
      }
      return $result;
  }
  
  /**
   * getValue()
   * 
   * @param mixed $stwhatring
   * @param mixed $table
   * @param mixed $where
   * @return
   */
  function getValue($what, $table, $where, $special=false, $that=null){
      $sql = "SELECT $what FROM $table WHERE $where";
      $row = Registry::get("Database")->first($sql);
      if(!$special) return ($row) ? $row->$what : '';
      else return ($row) ? $row->$that : '';
  }  

  /**
   * getValueById()
   * 
   * @param mixed $what
   * @param mixed $table
   * @param mixed $id
   * @return
   */
  function getValueById($what, $table, $id){
      $sql = "SELECT $what FROM $table WHERE id = $id";
      $row = Registry::get("Database")->first($sql);
      return ($row) ? $row->$what : '';
  } 
  
  /**
   * tooltip()
   * 
   * @param mixed $tip
   * @return
   */
  function tooltip($tip){
      return '<img src="'.SITEURL.'/images/tooltip.png" alt="Tip" class="tooltip" title="' . $tip . '" />';
  }
  
  /**
   * required()
   * 
   * @return
   */
  function required(){
      return '<img src="' . SITEURL . '/images/required.png" alt="Required Field" class="tooltip" title="Required Field" />';
  }

  /**
   * cleanOut()
   * 
   * @param mixed $text
   * @return
   */
  function cleanOut($text) {
	 $text =  strtr($text, array('\r\n' => "", '\r' => "", '\n' => ""));
	 $text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');
	 $text = str_replace('<br>', '<br />', $text);
	 return stripslashes($text);
  }

  /**
   * getSize()
   * 
   * @param mixed $size
   * @param integer $precision
   * @param bool $long_name
   * @param bool $real_size
   * @return
   */
  function getSize($size, $precision = 2, $long_name = false, $real_size = true){
      if ($size == 0) {
          return '-/-';
      } else {
          $base = $real_size ? 1024 : 1000;
          $pos = 0;
          while ($size > $base) {
              $size /= $base;
              $pos++;
          }
          $prefix = _getSizePrefix($pos);
          $size_name = $long_name ? $prefix . "bytes" : $prefix[0] . 'B';
          return round($size, $precision) . ' ' . ucfirst($size_name);


      }
  }

  /**
   * _getSizePrefix()
   * 
   * @param mixed $pos
   * @return
   */  
  function _getSizePrefix($pos){
      switch ($pos) {
          case 00:
              return "";
          case 01:
              return "kilo";

          case 02:
              return "mega";
          case 03:
              return "giga";
          default:
              return "?-";
      }
  }
    
  /**
   * Users::getUniqueCode()
   */
  function getUniqueCode($length = ""){
    $code = md5(uniqid(rand(), true));
    if ($length != "") {
      return substr($code, 0, $length);
    } else
      return $code;
  }
  
  
  /**
   * randName()
   * 
   * @return
   */ 
  function randName() {
	  $code = '';
	  for($x = 0; $x<6; $x++) {
		  $code .= '-'.substr(strtoupper(sha1(rand(0,999999999999999))),2,6);
	  }
	  $code = substr($code,1);
	  return $code;
  }
  
  function randNames() {
	  $code = '';
	  $pattern = '1234567890';
	  $max = strlen($pattern)-1;
	  for($x = 0; $x<6; $x++) {
		  $code .= '-'.substr(strtoupper(sha1(rand(0,$max))),2,6);
	  }
	  $code = substr($code,1);
	  return $code;
  }
  
  function formato($valor){
	return number_format($valor,2,'.',',');
}

function round_out($valor) { 
   $float_redondeado=round($valor * 100) / 100;  
   return $float_redondeado; 
}

function limpiar($tags){
	$tags = strip_tags($tags);
	$tags = stripslashes($tags);
	$tags = trim($tags);
	return $tags;
}
	

?>