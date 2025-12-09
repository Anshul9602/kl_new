<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PostModel;
use App\Models\ResultModel;
use App\Models\BasicModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
use \Datetime;

use ReflectionException;
class Home extends BaseController
{
    public function index()
    {
        $model = new PostModel();
        $model1 = new ResultModel();
        $basicModel = new BasicModel();
        
        // Fetch game rates
        try {
            $rates = $basicModel->rate();
            $data['rates'] = !empty($rates) ? $rates[0] : null;
        } catch (Exception $e) {
            $data['rates'] = null;
        }
        

        $date = new DateTime();
        $date = date_default_timezone_set('Asia/Kolkata');
       $date1 = date("m-d-Y");

       $data['post'] = array();
       $post = $model->findAll();
        foreach ($post as $game) {
           
            $post1 = $model1->findGById1($game['g_id']);
          
      if($post1 == null) { 
    $open = '***';
    $close = '***';
    $start = "*";
         $end = "*";
     }else{
    if($date1 == $post1['result_date']){
        if($post1['Open_Panna']){
            $open =$post1['Open_Panna'];
            $start = 0;
           
            for ($i = 0; $i < strlen($open); $i++) {
                $start += intval($open[$i]);
            }
            $end = "*";
            $close = '***';
        }elseif($post1['Close_Panna']){
            $open = "***";
            $start ="*";
            $end = 0;
            $close =$post1['Close_Panna'];
            for ($i = 0; $i < strlen($close); $i++) {
                $end += intval($close[$i]);
            }
            }else{
                $open = '***';
                $close = '***';
                $start = "*";
                $end = "*";
            }
      }else{
        
        $open = '***';
         $close = '***';
         $start = "*";
         $end = "*";
      }
      }
      $sumDigits = str_split($end);
       // Split the sum into individual digits
      if (count($sumDigits) > 1) {
        $end1 = intval($sumDigits[1]); // Take the second digit of the sum
        // Output will be the second digit of the sum
    } else {
        $end1 = $end;
    }
      $sumDigits1 = str_split($start);
       // Split the sum into individual digits
      if (count($sumDigits1) > 1) {
        $start1 = intval($sumDigits1[1]); // Take the second digit of the sum
        // Output will be the second digit of the sum
    } else {
        $start1 = $start;
    }
                $data['post'][] = array(
                    'g_id' => $game['g_id'],
                    'g_title' => $game['g_title'],
                    'g_name_hindi' => $game['g_name_hindi'],
                    'open_t' => $game['open_t'],
                    'close_t' => $game['close_t'],
                    'open_num' => $open,
                    'close_num' => $close,
                    'start' => $start1,
                    'end' => $end1,
                    'date' => date("d-m-Y")
                );
                
        }
        return view('welcome_message',$data);
    }
    
   
    public function get()
    {
        
       return ('welcome_message');
    }
}
