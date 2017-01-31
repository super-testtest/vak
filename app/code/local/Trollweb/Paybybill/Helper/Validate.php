<?php

class Trollweb_Paybybill_Helper_Validate
{

  public function ss_number($data)
  {
    return false;
  }

  public function birthday($data)
  {
//    if (preg_match("/^([0-3]?[0-9]\.[0-9]{1,2}\.[0-9]{4})|([0-9]{8})$/",$data,$match)) {
    if (preg_match("/^([0-3]?[0-9]\.[0-1][0-9]\.[0-9]{4})|([0-9]{8})$/",$data,$match)) {

      if (!empty($match[1])) {
        $parts = explode('.',$match[1]);
        $date = "";
        foreach ($parts as $part)
        {
          if ((int)$part < 10) {
            $date .= '0'.(int)$part;
          }
          else {
            $date .= $part;
          }
        }
        return $date;
      }

      return $data;
    }

    return false;
  }

  public function dob($dob)
  {
    if (preg_match("/^([0-9]{4})-([0,1][0-9])-([0-3][0-9])/",$dob,$match))
    {
      return $match[3].'.'.$match[2].'.'.$match[1];
    }
    return false;
  }

}
