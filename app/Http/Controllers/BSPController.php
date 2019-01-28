<?php
namespace App\Http\Controllers;

use App\BizDetails;
use App\User;
use App\UsersOtp;
use App\Registration;
use App\BspFunction;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Response;

class BSPController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth');
        //parent::login_user_details();
    }

    function BSP_random_string($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function BSP_random_string_with_chars($length = 10, $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
    {
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function short_url_generate()
    {
        $data = array(array(), array());
        $i = 0;
        $BspFunction = new BspFunction();

        if (isset($_POST['url_for_shorten']) && !empty($_POST['url_for_shorten'])) {
            $original_link = trim($_POST['url_for_shorten']);
            $bsp_data = '{
            "user_unique_id":"' . Config::get('constant.SHORT_URL_USER_UNIQUE_ID') . '",
            "sort_url_is_varified":"0",
            "sort_url_expiry_date":"12-31-2999",
            "sort_url_prefix":"",
            "sort_url_password":"",
            "original_url":"' . $original_link . '",
            "user_api_key":"' . Config::get('constant.SHORT_URL_USER_API_KEY') . '",
            "sort_url_visit_limit":"0"
            }';
            $data[$i]['url'] = Config::get('constant.SHORT_URL_API_URL');
            $data[$i]['post'] = array();
            $data[$i]['post']['bsp_data'] = $bsp_data;
            $i++;
        }

        $r = $BspFunction->multiRequest($data);

        if (isset($r[0]) && !empty($r[0])) {
            $single_result = trim($r[0], '"');
            $json_arr = json_decode($single_result, true);
            $this->param['success'] = $json_arr['success'];
            $this->param['short_url'] = $json_arr['data']['short_url'];
        } else {
            $this->param['success'] = 'FALSE';
        }
        echo json_encode($this->param, 1);
    }

    public function short_url_generate_return_to_function($original_link)
    {
        $data = array(array(), array());
        $i = 0;
        $BspFunction = new BspFunction();

        if (isset($original_link) && !empty($original_link)) {
            $bsp_data = '{
            "user_unique_id":"' . Config::get('constant.SHORT_URL_USER_UNIQUE_ID') . '",
            "sort_url_is_varified":"0",
            "sort_url_expiry_date":"12-31-2999",
            "sort_url_prefix":"",
            "sort_url_password":"",
            "original_url":"' . $original_link . '",
            "user_api_key":"' . Config::get('constant.SHORT_URL_USER_API_KEY') . '",
            "sort_url_visit_limit":"0"
            }';
            $data[$i]['url'] = Config::get('constant.SHORT_URL_API_URL');
            $data[$i]['post'] = array();
            $data[$i]['post']['bsp_data'] = $bsp_data;
            $i++;
        }
//echo "<pre>";print_r($data);die;
        $r = $BspFunction->multiRequest($data);
//echo "<pre>";print_r($r);die;

        if (isset($r[0]) && !empty($r[0])) {
            $single_result = trim($r[0], '"');
            $json_arr = json_decode($single_result, true);
            $this->param['success'] = $json_arr['success'];
            $this->param['short_url'] = $json_arr['data']['short_url'];
        } else {
            $this->param['success'] = 'FALSE';
        }
        return json_encode($this->param, 1);
    }

    function multiRequest($data, $options = array())
    {

        // array of curl handles
        $curly = array();
        // data to be returned
        $result = array();

        // multi handle
        $mh = curl_multi_init();

        // loop through $data and create curl handles
        // then add them to the multi-handle
        /*echo "<pre>";
        print_r($data);
        exit;*/
        foreach ($data as $id => $d) {

            if (isset($d) && !empty($d)) {
                $curly[$id] = curl_init();

                $url = (is_array($d) && !empty($d['url'])) ? $d['url'] : $d;

                curl_setopt($curly[$id], CURLOPT_URL, $url);
                curl_setopt($curly[$id], CURLOPT_HEADER, 0);
                curl_setopt($curly[$id], CURLOPT_RETURNTRANSFER, 1);

                // post?
                if (is_array($d)) {
                    if (!empty($d['post'])) {
                        curl_setopt($curly[$id], CURLOPT_POST, 1);
                        curl_setopt($curly[$id], CURLOPT_POSTFIELDS, $d['post']);
                    }
                }

                // extra options?
                if (!empty($options)) {
                    curl_setopt_array($curly[$id], $options);
                }

                curl_multi_add_handle($mh, $curly[$id]);
            }
        }

        // execute the handles
        $running = null;
        do {
            curl_multi_exec($mh, $running);
        } while ($running > 0);


        // get content and remove handles
        foreach ($curly as $id => $c) {
            $result[$id] = curl_multi_getcontent($c);
            curl_multi_remove_handle($mh, $c);
        }

        // all done
        curl_multi_close($mh);

        return $result;
    }

    public function create_route_for_jquery()
    {
        echo "<pre>";
        print_r($_REQUEST);
        echo "</pre>";
        exit;
    }


    function allow_special_character_in_keyword($keyword)
    {
        $new_keyword = str_replace("'", "\'", $keyword);
        return $new_keyword;
    }

    function remove_special_character_in_keyword($keyword)
    {
        $new_keyword = str_replace("\'", "'", $keyword);
        return $new_keyword;
    }

    function remove_special_character_from_string($string)
    {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
        $string = preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one
        return trim($string, '-'); // remove hyphens at start and end
    }

    function set_menubar_session_by_ajax()
    {
        if (Session::has('collapse_menu') && Session::get('collapse_menu') == 'CLOSE') {
            Session::put('collapse_menu', 'OPEN');
        } else {
            Session::put('collapse_menu', 'CLOSE');
        }
    }


    function display_substring_of_given_length($str, $len)
    {
        if ((isset($str)) && (!empty($str)) &&
            (isset($len)) && (!empty($len))
        ) {
            $str_len = strlen($str);
            if ($str_len > $len) {
                $str = substr($str, 0, $len) . '...';
            }
            return $str;
        } else {
            return '';
        }
    }

    /* mask_text : Used for mask text
        Parameter :
                    1) Str = Given string
                    2) $first_chrs = First unchanged character length
                    2) $last_chrs = Last unchanged character length
                    3) $mask_for = mask type

    */
    public function mask_text($str = "", $first_chrs = 0, $last_chrs = 0, $mask_for = "common")
    {
        $result = "";

        if (!empty($str)) {
            $str_length = strlen($str);
            if ($mask_for == "email") {
                //Explode the string with @ sign
                $exploded_str = explode("@", $str);
                //Get String length of exploded string's 0th
                $str_length = strlen($exploded_str[0]);
                $result = substr($exploded_str[0], 0, $first_chrs);
                $str_repeat_length = $str_length - $first_chrs;

                if ($str_repeat_length > 0) {
                    //Repeat string
                    $result .= str_repeat("*", $str_repeat_length);
                }
                //Concat value after @ sign
                $result .= "@" . $exploded_str[1];
            } else {
                //Front mask string
                $front_mask_str = str_repeat("*", $first_chrs);
                // Get substring without front char
                $str_without_front_char = substr($str, $first_chrs);
                //New string with front mask
                $new_str_after_front_mask = $front_mask_str . $str_without_front_char;

                $new_str_with_mask = $new_str_after_front_mask;
                /*  $str_without_back_char = */
                if (strlen($new_str_after_front_mask) > 0) {
                    $back_mask_str = str_repeat("*", $last_chrs);
                    $str_without_back_char = substr($new_str_after_front_mask, 0, $str_length - $last_chrs);
                    $new_str_with_mask = $str_without_back_char . $back_mask_str;
                }
                $result = $new_str_with_mask;
            }
        }
        return $result;
    }
    function readNumber($num, $depth=0)
    {
        $number = $num;
        $no = round($number);
        $point = round($number - $no, 2) * 100;
        $hundred = null;
        $digits_1 = strlen($no);
        $i = 0;
        $str = array();
        $words = array('0' => '', '1' => 'one', '2' => 'two',
            '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
            '7' => 'seven', '8' => 'eight', '9' => 'nine',
            '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
            '13' => 'thirteen', '14' => 'fourteen',
            '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
            '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
            '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
            '60' => 'sixty', '70' => 'seventy',
            '80' => 'eighty', '90' => 'ninety');
        $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
        while ($i < $digits_1) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += ($divider == 10) ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str [] = ($number < 21) ? $words[$number] .
                    " " . $digits[$counter] . $plural . " " . $hundred
                    :
                    $words[floor($number / 10) * 10]
                    . " " . $words[$number % 10] . " "
                    . $digits[$counter] . $plural . " " . $hundred;
            } else $str[] = null;
        }
        $str = array_reverse($str);
        $result = implode('', $str);
        $points = ($point) ?
            "." . $words[$point / 10] . " " .
            $words[$point = $point % 10] : '';
        return $result;
    }
//        $num = (int)$num;
//        $retval ="";
//        if ($num < 0) // if it's any other negative, just flip it and call again
//            return "negative " + readNumber(-$num, 0);
//        if ($num > 99) // 100 and above
//        {
//            if ($num > 999) // 1000 and higher
//                $retval .= $this->readNumber($num/1000, $depth+3);
//
//            $num %= 1000; // now we just need the last three digits
//            if ($num > 99) // as long as the first digit is not zero
//                $retval .= $this->readNumber($num/100, 2)." hundred\n";
//            $retval .=$this->readNumber($num%100, 1); // our last two digits
//        }
//        else // from 0 to 99
//        {
//            $mod = floor($num / 10);
//            if ($mod == 0) // ones place
//            {
//                if ($num == 1) $retval.="one";
//                else if ($num == 2) $retval.="two";
//                else if ($num == 3) $retval.="three";
//                else if ($num == 4) $retval.="four";
//                else if ($num == 5) $retval.="five";
//                else if ($num == 6) $retval.="six";
//                else if ($num == 7) $retval.="seven";
//                else if ($num == 8) $retval.="eight";
//                else if ($num == 9) $retval.="nine";
//            }
//            else if ($mod == 1) // if there's a one in the ten's place
//            {
//                if ($num == 10) $retval.="ten";
//                else if ($num == 11) $retval.="eleven";
//                else if ($num == 12) $retval.="twelve";
//                else if ($num == 13) $retval.="thirteen";
//                else if ($num == 14) $retval.="fourteen";
//                else if ($num == 15) $retval.="fifteen";
//                else if ($num == 16) $retval.="sixteen";
//                else if ($num == 17) $retval.="seventeen";
//                else if ($num == 18) $retval.="eighteen";
//                else if ($num == 19) $retval.="nineteen";
//            }
//            else // if there's a different number in the ten's place
//            {
//                if ($mod == 2) $retval.="twenty ";
//                else if ($mod == 3) $retval.="thirty ";
//                else if ($mod == 4) $retval.="forty ";
//                else if ($mod == 5) $retval.="fifty ";
//                else if ($mod == 6) $retval.="sixty ";
//                else if ($mod == 7) $retval.="seventy ";
//                else if ($mod == 8) $retval.="eighty ";
//                else if ($mod == 9) $retval.="ninety ";
//                if (($num % 10) != 0)
//                {
//                    $retval = rtrim($retval); //get rid of space at end
//                    $retval .= " ";
//                }
//                $retval.=$this->readNumber($num % 10, 0);
//            }
//        }
//
//        if ($num != 0)
//        {
//            if ($depth == 3)
//                $retval.=" thousand\n";
//            else if ($depth == 6)
//                $retval.=" million\n";
//            if ($depth == 9)
//                $retval.=" billion\n";
//        }
//        return $retval;
//    }

    public function document_errors($code)
    {
        if ($code != 404 && $code != 403 && $code != 400 && $code != 500 && $code != 405) {
            $code = 500;
        }

        return response()
            ->view('error', ['code' => $code]);

    }

    function number_format_short($n)
    {
        if ($n > 0 && $n < 1000) {
            // 1 - 999
            $n_format = floor($n);
            $suffix = '';
        } else if ($n >= 1000 && $n < 1000000) {
            // 1k-999k
            $n_format = floor($n / 1000);
            $suffix = 'K+';
        } else if ($n >= 1000000 && $n < 1000000000) {
            // 1m-999m
            $n_format = floor($n / 1000000);
            $suffix = 'M+';
        } else if ($n >= 1000000000 && $n < 1000000000000) {
            // 1b-999b
            $n_format = floor($n / 1000000000);
            $suffix = 'B+';
        } else if ($n >= 1000000000000) {
            // 1t+
            $n_format = floor($n / 1000000000000);
            $suffix = 'T+';
        } else {
            $n_format = '0';
            $suffix = '';
        }
        return $n_format . $suffix;
    }

}
