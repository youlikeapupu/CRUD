<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter Calendar Class
 *
 * This class enables the creation of calendars
 *
 * @package     CodeIgniter
 * @subpackage  Libraries
 * @category    Libraries
 * @author      EllisLab Dev Team
 * @link        https://codeigniter.com/user_guide/libraries/calendar.html
 */
class My_function {

    public function __construct()
    {

    }

    public function white_ips()
    {
        $white_Arr = array('192.168.0.100',
            '192.168.2.223',
            );
        return $white_Arr;


    }

    //偵測並記錄有惡意攻擊($_GET)之IP
    public function sql_get_chk($arr)
    {
        //由陣列宣告變數
        //key
        $k= $arr['k'];
        //value
        $v= $arr['v'];
        //使用者ip
        $guest_ip= $arr['guest_ip'];
        $chk_date = date("Y-m-d H:i:s");
        //log資料夾之檔案名稱
        $logfileName='log/log_'.date("Y-m-d").'.txt';
        if (file_exists($logfileName)) {
            // 檢查長度
            $chk_len = 10;
            $r_str = substr(strip_tags(addslashes(trim($v))),0,$chk_len);
            //打開檔案
            $logfile = fopen($logfileName, "a") or die("Unable to open file!");
            $txt = "IP:".$guest_ip."\n".$chk_date."\n".$k."=".$v." => ".$r_str."\r\n";
            fwrite($logfile, $txt);
            //關閉檔案
            fclose($logfile);
        }else{
            //echo $logfileName;
            //如果資料夾沒有檔案則自動新增
            $fp=fopen($logfileName,"w");
        }
    }

    //比對使用者IP與白名單允許之IP 2018/07/04
    public function white_ip_chk($guest_ip)
    {
        //引入白名單
        $whiteArray = $this->white_ips();
        if (in_array($guest_ip,$whiteArray)) {
            return true;
        }else{
            return false;
        }

    }

    public function test()
    {
        return 'test';
    }

    //加密密碼
    function pw_encrypt($pw) {
        // Remove the base64 encoding from our key
        $encryption_key = base64_decode(EN_KEY);
        // Generate an initialization vector
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        // Encrypt the data using AES 256 encryption in CBC mode using our encryption key and initialization vector.
        $encrypted = openssl_encrypt($pw, 'aes-256-cbc', $encryption_key, 0, $iv);
        // The $iv is just as important as the key for decrypting, so save it with our encrypted data using a unique separator (::)
        return base64_encode($encrypted . '::' . $iv);
    }

}
