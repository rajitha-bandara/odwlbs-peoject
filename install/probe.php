<?php

  define('STATUS_OK', 'ok');
  define('STATUS_WARNING', 'warning');
  define('STATUS_ERROR', 'error');
  define('APP_NAME', '123biz Directory');
  
  class TestResult {
    
    var $message;
    var $status;
    
    function TestResult($message, $status = STATUS_OK) {
      $this->message = $message;
      $this->status = $status;
    }
    
  } 
?>
<html>
  <head>
    
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <style type="text/css">
      * {
        margin: 0; padding: 0;
      }
      
      body {
        font: 1em "Lucida Grande", verdana, arial, helvetica, sans-serif;
        text-align: center;
        background: white;
        color: #333;
      }
      
      h1, h2 {
        margin: 16px 0;
      }
      
      h1 {
        text-align: center;
      }
      
      a {
        color: #333;
        border-bottom: 1px solid #ccc;
        text-decoration: none;
      }
      
      a:hover {
        color: black;
        border-color: black;
      }
      
      p {
        margin: 8px 0;
      }
      
      ul {
        margin: 8px 0;
        padding: 0 0 0 33px;
        list-style: square;
		font-size:12px;
      }
      
      dl {
        margin: 8px 0;
        color: #999;
        font-size: 80%;
      }
      
      dt, dd {
        padding: 3px;
      }
      
      dt {
        float: left;
        width: 100px;
      }
      
      dd {
        padding-left: 100px;
        border-bottom: 1px solid #e8e8e8;
      }
      
      #wrapper {              
        width: 300px;
        text-align: left;
      }
      
      .ok span, .warning span, .error span {
        font-weight: bolder;
		font-size:12px;
      }
      
      .ok span {
        color: green;
      }
      
      .warning span {
        color: orange;
      }
      
      .error span {
        color: red;
      }
      
      span.details {
        font-weight: normal;
        font-size: 12px;
        color: #999;
        display: block;
        padding: 5px;
      }
      
      #verdict {
        margin: 20px 0;
        padding: 20px;
        text-align: center;
        font-size: 160%;
        color: white;
        border-radius: 15px;
      }
      
      #verdict.all_ok {
        background: green;
      }
      
      #verdict.not_ok {
        background: #BC0000;
      }
    </style>
  </head>
  <body>
    <div id="wrapper">
      
      <ul>
<?php
  
  // ---------------------------------------------------
  //  Validators
  // ---------------------------------------------------
  
  /**
   * Validate PHP platform
   *
   * @param array $result
   */
  function validate_php(&$results) {
    if(version_compare(PHP_VERSION, '5.0') == -1) {
      $results[] = new TestResult('Minimum PHP version required in order to run '.APP_NAME.' is PHP 5.0. Your PHP version: ' . PHP_VERSION, STATUS_ERROR);
      return false;
    } else {
      $results[] = new TestResult('Your PHP version is ' . PHP_VERSION, STATUS_OK);
      return true;
    } // if
  } // validate_php

  /**
   * Validate memory limit
   *
   * @param array $result
   */
  function validate_memory_limit(&$results) {
    $memory_limit = php_config_value_to_bytes(ini_get('memory_limit'));

    $formatted_memory_limit = $memory_limit === -1 ? 'unlimited' : format_file_size($memory_limit);

    if($memory_limit === -1 || $memory_limit >= 67108864) {
      $results[] = new TestResult('Your memory limit is: ' . $formatted_memory_limit, STATUS_OK);
      return true;
    } else {
      $results[] = new TestResult('Your memory is too low to complete the installation. Minimal value is 64MB, and you have it set to ' . $formatted_memory_limit, STATUS_ERROR);
      return false;
    } // if
  } // validate_memory_limit
  
  /**
   * Validate PHP extensions
   *
   * @param array $results
   */
  function validate_extensions(&$results) {
    $ok = true;
    
    $required_extensions = array('mysql', 'session', 'json', 'xml', 'dom');
    
    foreach($required_extensions as $required_extension) {
      if(extension_loaded($required_extension)) {
        $results[] = new TestResult("Required extension '$required_extension' found", STATUS_OK);
      } else {
        $results[] = new TestResult("Extension '$required_extension' is required in order to run ".APP_NAME, STATUS_ERROR);
        $ok = false;
      } // if
    } // foreach

    
    $recommended_extensions = array(
      'gd' => 'GD is used for image manipulation. Without it, system is not able to create thumbnails for files or manage avatars, logos and project icons',    
      'imap' => 'IMAP is used to connect to POP3 and IMAP servers. Without it, Incoming Mail module will not work',
    );

    foreach($recommended_extensions as $recommended_extension => $recommended_extension_desc) {
      if(extension_loaded($recommended_extension)) {
        $results[] = new TestResult("Recommended extension '$recommended_extension' found", STATUS_OK);
      } else {
        $results[] = new TestResult("Extension '$recommended_extension' was not found. <span class=\"details\">$recommended_extension_desc</span>", STATUS_WARNING);
      } // if
    } // foreach
    
    return $ok;
  } // validate_extensions

  /**
   * Convert filesize value from php.ini to bytes
   *
   * Convert PHP config value (2M, 8M, 200K...) to bytes. This function was taken from PHP documentation. $val is string
   * value that need to be converted
   *
   * @param string $val
   * @return integer
   */
  function php_config_value_to_bytes($val) {
    $val = trim($val);
    $last = strtolower($val{strlen($val)-1});
    switch($last) {
      // The 'G' modifier is available since PHP 5.1.0
      case 'g':
        $val *= 1024;
      case 'm':
        $val *= 1024;
      case 'k':
        $val *= 1024;
    } // if

    return (integer) $val;
  } // php_config_value_to_bytes

  /**
   * Format filesize
   *
   * @param string $value
   * @return string
   */
  function format_file_size($value) {
    $data = array(
      'TB' => 1099511627776,
      'GB' => 1073741824,
      'MB' => 1048576,
      'kb' => 1024,
    );

    $value = (integer) $value;
    foreach($data as $unit => $bytes) {
      $in_unit = $value / $bytes;
      if($in_unit > 0.9) {
        return trim(trim(number_format($in_unit, 2), '0'), '.') . $unit;
      } // if
    } // foreach

    return $value . 'b';
  } // format_file_size
  
  // ---------------------------------------------------
  //  Do the magic
  // ---------------------------------------------------

  $results = array();
  
  $php_ok = validate_php($results);
  $memory_ok = validate_memory_limit($results);
  $extensions_ok = validate_extensions($results);
  
  
  foreach($results as $result) {
    print '<li class="' . $result->status . '"><span>' . $result->status . '</span> &mdash; ' . $result->message . '</li>';
  } // foreach

?>
      </ul>
      
      
  </body>
</html>