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
class Crud {

    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
    }

    //新增單筆資料
    public function create($data, $table){
        $k_arr = array();
        $v_arr = array();
        foreach ($data as $dt => $dv) {
            array_push($k_arr,$dt);
            array_push($v_arr,$dv);
        }

        $k_str = '`'.implode("`,`",$k_arr).'`';
        $v_str = "'".implode("','",$v_arr)."'";

        $sql = "INSERT INTO"." `".$table."` ".
                "(".$k_str.")
                VALUES
                (".$v_str.")";
        $query = $this->CI->db->query($sql);
        //return $v_str;

    }

    //新增多筆資料
    public function creates($data, $table, $data_k_arr){
        $v_arr = array();
        $date = date("Y-m-d H:i:s");

        foreach ($data as $dt => $dv) {
            array_push($v_arr,$dv);
        }
        $count_v = count($v_arr[0]);
        $count_k = count($data_k_arr);


        $k_str = '`'.implode("`,`",$data_k_arr).'`';
        $data_v_arr = array();
        for ($i=0; $i <$count_v ; $i++) {
            $str = '';
            foreach ($v_arr as $k => $v) {
                $str .="'".$v[$i]."',";
            }
            $str = $str."'".$date."'";
            array_push($data_v_arr,$str);
        }

        for ($j=0; $j < $count_v; $j++) {
            $sql = "INSERT INTO"." `".$table."` ".
                    "(".$k_str.")
                    VALUES
                    (".$data_v_arr[$j].")";
            $query = $this->CI->db->query($sql);
        }

        //return $this->arr_to_str($data_k_arr);

    }

    //讀取特定表單中特定欄位($info)自訂($num)的資料筆數
    public function read($table, $info, $num, $where){
        $v_str = implode(",",$info);

        $sql = "SELECT ".$v_str." FROM "."`".$table."` ".$where." LIMIT ".$num;
        $query = $this->CI->db->query($sql);
        //加狀態碼&訊息 (status:1(int),message:success(str))
        return $query;
    }

    //讀取特定表單中特定欄位($info)所有資料
    public function reads($table, $info, $where){
        $v_str = implode(",",$info);

        $sql = "SELECT ".$v_str." FROM "."`".$table."` ".$where;
        $query = $this->CI->db->query($sql);
        return $query;
    }

    //更新單筆資料
    public function update($data, $table, $id){
        $id = (int)$id;
        $len = count($data);
        $k_arr = array();
        $v_arr = array();
        foreach ($data as $dt => $dv) {
            array_push($k_arr,$dt);
            array_push($v_arr,$dv);
        }

        for ($i=0; $i < $len; $i++) {
            $update_str .= "`".$k_arr[$i]."` = '".$v_arr[$i]."',";
        }
        $update_str = substr($update_str,0,-1);

        $sql = "UPDATE ".$table." SET ".$update_str." WHERE (`id` = ".$id.")";
        $query = $this->CI->db->query($sql);

    }

    //刪除單筆資料
    public function delete($table, $id){
        $id = (int)$id;
        $sql = "DELETE FROM ".$table." WHERE id=".$id;
        $query = $this->CI->db->query($sql);

    }

    //刪除多筆資料
    public function deletes($table, $ids){
        $ids_str = implode(",", $ids);
        $status = 0;
        if (count($ids) > 0) {
            $sql = "DELETE FROM ".$table." WHERE id IN (".$ids_str.")";
            $query = $this->CI->db->query($sql);
            $status = 1;
        }
        return $status;
    }

    public function test(){
        return 'test';
    }

    //array to str
    public function arr_to_str($fields)
    {
        $str_comma = ',';
        $str_fields = '';
        $fields_len = count($fields) -1;
        $i = 0;
        foreach ($fields as $k => $v)
        {
          // 比對索引值長度，當索引值?最後時清除逗號，
          if ($k === $fields_len || $fields_len === $i)
          {
            $str_comma = '';
          }
          $str_fields.= "'".$v."'".$str_comma;
          $i++;
        }
        return $str_fields;
    }

}
