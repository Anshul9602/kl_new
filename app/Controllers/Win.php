<?php

namespace App\Controllers;

use App\Models\ResultModel;
use App\Models\SResultModel;
use App\Models\PostModel;
use App\Models\SPostModel;
use App\Models\BidModel;
use App\Models\WinModel;
use App\Models\UserModel;
use App\Models\TransactionModel;
use App\Models\ActiviteModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
use \DateTime;

use ReflectionException;

class Win extends BaseController
{
    public function index()
    {
        $model = new WinModel();
        $post = $model->getwinData();
        return $this->getResponse(
            [
                'message' => 'result  get successfully',
                'game' => $post

            ]
        );
    }
    public function win_user($id)
    {
        $model = new WinModel();
        $post = $model->getwinuData($id);
        return $this->getResponse(
            [
                'message' => 'by user id win get successfully',
                'game' => $post

            ]
        );
    }
    public function swin_user($id)
    {
        $model = new WinModel();
        $post = $model->sgetwinuData($id);
        return $this->getResponse(
            [
                'message' => 'by user id win get successfully',
                'game' => $post

            ]
        );
    }

    public function bid_today()
    {
        $model2 = new BidModel();
        $bid = $model2->findAll();
        $date = new DateTime();
        $date = date_default_timezone_set('Asia/Kolkata');
        $date1 = date("m-d-Y");
        $post = array();
        foreach ($bid as $b1) {
            $dateTime = \DateTime::createFromFormat('m-d-Y h:i A', $b1['date']);
            $dateOnly = $dateTime->format('m-d-Y');
            if ($date1 == $dateOnly) {
                $data['post'][] = array(
                    'bid_date' => $b1['$dateOnly']

                );
            }
        }



        return $this->getResponse(
            [
                'message' => 'result  get successfully',
                'game' => $data['post']

            ]
        );
    }
    public function bid_win()
    {
        $input = $this->getRequestInput($this->request);
        $model2 = new BidModel();
        $b = $model2->getbdData();
        
        $bid = json_decode(json_encode($b), true);

        $date1 = $input['date'];
        $post = array();
        foreach ($bid as $b1) {
            // echo "<pre>";
            // print_r($b1);
            // echo "</pre>";
            $dateTime = \DateTime::createFromFormat('m-d-Y h:i A', $b1['date']);
            $dateOnly = $dateTime->format('m-d-Y');

            if ($date1 == $dateOnly && $b1['g_id'] == $input['g_id']) {
                $model2 = new WinModel();
                $win = $model2->findBByIdAd($b1['b_id']);
                if ($win == null) {
                    $win_amount = '';
                } else {
                    $win_amount = $win['win_amount'];
                }
                $data['post'][] = array(
                    'g_id' => $b1['g_id'],
                    'g_title' => $b1['g_title'],
                    'gt_id' => $b1['gt_id'],
                    'gt_name' => $b1['gt_name'],
                    'user_id' => $b1['user_id'],
                    'user_name' => $b1['user_name'],
                    'b_id' => $b1['b_id'],
                    'session' => $b1['session'],
                    'date' => $b1['date'],
                    'Close_Digits' => $b1['Close_Digits'],
                    'Open_Digits' => $b1['Open_Digits'],
                    'Jodi' => $b1['Jodi'],
                    'Open_Panna' => $b1['Open_Panna'],
                    'Close_Panna' => $b1['Close_Panna'],
                    'total_amount' => $b1['total_amount'],
                    'win_amount' => $win_amount

                );
            }
        }



        return $this->getResponse(
            [
                'message' => 'win and bid  get successfully',
                'post' => $data

            ]
        );
    }

    public function sindex()
    {
        $model = new SPostModel();
        $model1 = new SResultModel();


        $date = new DateTime();
        $date = date_default_timezone_set('Asia/Kolkata');
        $date1 = date("m-d-Y");

        $data['post'] = array();
        $post = $model->findAll();
        //  echo "<pre>";
        //  print_r($post );
        //  echo "</pre>";
        foreach ($post as $game) {
            $post1 = $model1->findGById1($game['g_id']);
            if ($post1 == null) {
                $open = '***';
                $start = "*";
            } else {

                if ($date1 == $post1['result_date']) {
                    $open = $post1['Open_Panna'];
                    $start = 0;
                    for ($i = 0; $i < strlen($open); $i++) {
                        $start += intval($open[$i]);
                    }
                } else {
                    $open = '***';
                    $start = "*";
                }
            }

            $sumDigits1 = str_split($start);
            // Split the sum into individual digits
            if (count($sumDigits1) > 1) {
                $start1 = intval($sumDigits1[1]); // Take the second digit of the sum
                // Output will be the second digit of the sum
            } else {
                $start1 = $start;
            }

            //   echo "<pre>";
            //   print_r($game['g_title']);
            //   echo "</pre>";
            $data['post'][] = array(
                'g_id' => $game['g_id'],
                'status' => $game['status'],
                'g_title' => $game['g_title'],
                'open_t' => $game['open_t'],
                'open_num' => $open,
                'start' => $start1,
            );
        }

        // echo "<pre>";
        // print_r($data['post']);
        // echo "</pre>";

        return $this->getResponse(
            [
                'message' => 'result  get successfully',
                'game' => $data['post']

            ]
        );
    }
}
