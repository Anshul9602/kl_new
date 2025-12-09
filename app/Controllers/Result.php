<?php

namespace App\Controllers;

use App\Models\ResultModel;
use App\Models\BasicModel;
use App\Models\SResultModel;
use App\Models\PostModel;
use App\Models\SPostModel;
use App\Models\BidModel;
use App\Models\SBidModel;
use App\Models\WinModel;
use App\Models\CartModel;
use App\Models\UserModel;
use App\Models\TransactionModel;
use App\Models\ActiviteModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
use \DateTime;

use ReflectionException;

class Result extends BaseController
{
    public function index1()
    {

        $model = new ResultModel();
        $model1 = new PostModel();
        $date = new DateTime();
        $date = date_default_timezone_set('Asia/Kolkata');
        $date1 = date("m-d-Y");

        $data['post'] = array();
        $game = $model->findAll();

        foreach ($game as $post) {

            if ($post['Open_Panna'] && $post['Close_Panna']) {
                $open = $post['Open_Panna'];
                $start = 0;
                for ($i = 0; $i < strlen($open); $i++) {
                    $start += intval($open[$i]);
                }
                $end = 0;
                $close = $post['Close_Panna'];
                for ($i = 0; $i < strlen($close); $i++) {
                    $end += intval($close[$i]);
                }
            } elseif ($post['Open_Panna']) {

                $open = $post['Open_Panna'];
                $start = 0;
                for ($i = 0; $i < strlen($open); $i++) {
                    $start += intval($open[$i]);
                }
                $close = "***";
                $end = "*";
            } elseif ($post['Close_Panna']) {
                $open = "***";
                $start = "*";
                $end = 0;
                $close = $post['Close_Panna'];
                for ($i = 0; $i < strlen($close); $i++) {
                    $end += intval($close[$i]);
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
            $game1 = $model1->findPostById($post['g_id']);

            $data['post'][] = array(
                're_id' => $post['re_id'],
                'g_id' => $post['g_id'],
                'g_title' => $game1['g_title'],
                'open_num' => $open,
                'close_num' => $close,
                'start' => $start1,
                'end' => $end1,
                'open_date' => $post['open_date'],
                'close_date' => $post['close_date'],
                'result_date' => $post['result_date']

            );
        }
        return $this->getResponse(
            [
                'message' => 'result  get successfully',
                'game' => $data['post']

            ]
        );
    }
    public function sindex2()
    {
        $model = new SResultModel();
        $model1 = new SPostModel();
        $date = new DateTime();
        $date = date_default_timezone_set('Asia/Kolkata');
        $date1 = date("m-d-Y");

        $data['post'] = array();
        $game = $model->findAll();

        foreach ($game as $post) {
            if ($post['Open_Panna']) {
                $open = $post['Open_Panna'];
                $start = 0;
                for ($i = 0; $i < strlen($open); $i++) {
                    $start += intval($open[$i]);
                }
            } else {
                $start = '';
            }

            $sumDigits1 = str_split($start);
            // Split the sum into individual digits
            if (count($sumDigits1) > 1) {
                $start1 = intval($sumDigits1[1]); // Take the second digit of the sum
                // Output will be the second digit of the sum
            } else {
                $start1 = $start;
            }
            $game1 = $model1->findPostById($post['g_id']);

            $data['post'][] = array(
                're_id' => $post['re_id'],
                'g_id' => $post['g_id'],
                'g_title' => $game1['g_title'],
                'open_num' => $open,
                'start' => $start1,
                'open_date' => $post['open_date'],
                'result_date' => $post['result_date']

            );
        }
        return $this->getResponse(
            [
                'message' => 'result  get successfully',
                'game' => $data['post']

            ]
        );
    }
    public function index()
    {
        $model = new PostModel();
        $model1 = new ResultModel();
        $date = new DateTime();
        $date = date_default_timezone_set('Asia/Kolkata');
        $date1 = date("m-d-Y");
        $data['post'] = array();
        $post = $model->findAll();

        foreach ($post as $game) {
            $post1 = $model1->findGById1($game['g_id']);


            if ($post1 == null) {
                $open = '***';
                $close = '***';
                $start = "*";
                $end = "*";
                $open_date = '';
                $close_date = '';
            } else {

                if ($date1 == $post1['result_date']) {

                    if ($post1['Open_Panna'] && $post1['Close_Panna']) {
                        $open = $post1['Open_Panna'];
                        $start = 0;
                        for ($i = 0; $i < strlen($open); $i++) {
                            $start += intval($open[$i]);
                        }
                        $end = 0;
                        $close = $post1['Close_Panna'];
                        for ($i = 0; $i < strlen($close); $i++) {
                            $end += intval($close[$i]);
                        }
                        $open_date =  $post1['open_date'];
                        $close_date = $post1['close_date'];
                    } else {
                        if ($post1['Open_Panna']) {
                            $open = $post1['Open_Panna'];
                            $start = 0;
                            for ($i = 0; $i < strlen($open); $i++) {
                                $start += intval($open[$i]);
                            }
                            $end = "*";
                            $close = '***';
                            $open_date =  $post1['open_date'];
                            $close_date = '';
                        } elseif ($post1['Close_Panna']) {
                            $open = "***";
                            $start = "*";
                            $end = 0;
                            $close = $post1['Close_Panna'];
                            for ($i = 0; $i < strlen($close); $i++) {
                                $end += intval($close[$i]);
                            }
                            $open_date = '';
                            $close_date = $post1['close_date'];
                        } else {
                            $open = '***';
                            $close = '***';
                            $start = "*";
                            $end = "*";
                            $open_date = '';
                            $close_date = '';
                        }
                    }
                } else {

                    $open = '***';
                    $close = '***';
                    $start = "*";
                    $end = "*";
                    $open_date = '';
                    $close_date = '';
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
                'status' => $game['status'],
                'maket_status' => $game['maket_status'],
                'g_title' => $game['g_title'],
                'g_name_hindi' => $game['g_name_hindi'],
                'open_t' => $game['open_t'],
                'close_t' => $game['close_t'],
                'open_num' => $open,
                'close_num' => $close,
                'start' => $start1,
                'end' => $end1,
                'open_date' => $open_date,
                'close_date' => $close_date

            );
        }
        return $this->getResponse(
            [
                'message' => 'result  get successfully',
                'game' => $data['post']

            ]
        );
    }

    public function by_g_id($id)
    {
        $model1 = new PostModel();
        $model = new ResultModel();
        $post = $model->findGByIdA($id);
        // echo "<pre>";
        // print_r($post);
        // echo "</pre>";
        //     die();
        $data['post'] = array();
        if ($post) {


            foreach ($post as $post1) {

                $game = $model1->findPostById($post1['g_id']);
                if ($post1['Open_Panna'] && $post1['Close_Panna']) {
                    $open = $post1['Open_Panna'];
                    $start = 0;
                    for ($i = 0; $i < strlen($open); $i++) {
                        $start += intval($open[$i]);
                    }
                    $end = 0;
                    $close = $post1['Close_Panna'];
                    for ($i = 0; $i < strlen($close); $i++) {
                        $end += intval($close[$i]);
                    }
                } else {

                    if ($post1['Open_Panna']) {
                        $open = $post1['Open_Panna'];
                        $start = 0;

                        for ($i = 0; $i < strlen($open); $i++) {
                            $start += intval($open[$i]);
                        }
                        $end = "*";
                        $close = '***';
                    } elseif ($post1['Close_Panna']) {
                        $open = "***";
                        $start = "*";
                        $end = 0;
                        $close = $post1['Close_Panna'];
                        for ($i = 0; $i < strlen($close); $i++) {
                            $end += intval($close[$i]);
                        }
                    } else {
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
                    'status' => $game['status'],
                    'g_title' => $game['g_title'],
                    'g_name_hindi' => $game['g_name_hindi'],
                    'result_date' => $post1['result_date'],
                    'open_num' => $open,
                    'close_num' => $close,
                    'start' => $start1,
                    'end' => $end1
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

    public function result_all()
    {

        $model = new SResultModel();
        $post = $model->findAll();
        // echo "<pre>";
        // print_r($post1['Open_Panna']);
        // echo "</pre>";
        //     die();
        $data['post'] = array();
        foreach ($post as $post1) {
            if ($post1['Open_Panna'] !== null) {

                $open = $post1['Open_Panna'];
                $start = 0;

                for ($i = 0; $i < strlen($open); $i++) {
                    $start += intval($open[$i]);
                }
            } else {
                $open = '***';

                $start = "*";
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
                'g_id' => $post1['g_id'],
                'open_num' => $open,
                'start' => $start1,
                'result_date' => $post1['result_date'],

            );
        }
        return $this->getResponse(
            [
                'message' => 'result  get successfully',
                'game' => $data['post']

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
    public function sindex1()
    {
        $model = new SPostModel();
        $model1 = new SResultModel();


        $date = new DateTime();
        $date = date_default_timezone_set('Asia/Kolkata');
        $date1 = date("m-d-Y");


        $post = $model->findAll();
        //  echo "<pre>";
        //  print_r($post );
        //  echo "</pre>";


        // echo "<pre>";
        // print_r($data['post']);
        // echo "</pre>";

        return $this->getResponse(
            [
                'message' => 'result  get successfully',
                'game' => $post

            ]
        );
    }

    public function store()
    {
        $input = $this->getRequestInput($this->request);

        $model = new ResultModel();
        $g_id = $input['g_id'];

        $date = $input['date']; // Your original date in MM/DD/YYYY format
        $date1 = date("m-d-Y", strtotime($date));



        $post = $model->where('g_id', $g_id)
            ->where('result_date', $date1) // Add this line to filter by date
            ->first();

        //  echo "<pre>"; print_r($post);
        //         echo "</pre>";
        //         die();
        if ($post) {
            $id = $post['re_id'];
            if ($input['Session'] == "close") {
                // echo "<pre>"; print_r($post);
                // echo "cl";
                // echo "</pre>";
                // die();
                $input['Open_Panna'] = $post['Open_Panna'];

                $model->update_close($id, $input);

                $this->winall_save($id, $input);
            }
        } else {


            $model->save($input);
            $data['date1'] = $date1;
            $data['g_id'] = $input['g_id'];
            $res = $model->findlast($data);
            // echo json_encode($res);
            // die();
            $re_id = $res['re_id'];
            $this->win_save($re_id, $input);
        }
      

        $post = $model->where('g_id', $g_id)->first();
        return $this->getResponse(
            [
                'message' => 'result  added successfully',
                'game' => $post

            ]
        );
    }
   
    public function win_save($re_id, $result)
    {

        $model2 = new BidModel();
        $model1 = new ResultModel();
        $model3 = new WinModel();
        $date = new DateTime();
        $date = date_default_timezone_set('Asia/Kolkata');
        $date1 = date("m-d-Y");

        $bid = $model2->findAll();

        $data['post'] = array();
        foreach ($bid as $b1) {
            $dateTime = \DateTime::createFromFormat('m-d-Y h:i A', $b1['date']);
            $dateOnly = $dateTime->format('m-d-Y');
            if ($date1 == $dateOnly) {
                $data['post'][] = array(
                    'g_id' => $b1['g_id'],
                    'gt_id' => $b1['gt_id'],
                    'user_id' => $b1['user_id'],
                    'b_id' => $b1['b_id'],
                    'session' => $b1['session'],
                    'Close_Digits' => $b1['Close_Digits'],
                    'Open_Digits' => $b1['Open_Digits'],
                    'Jodi' => $b1['Jodi'],
                    'Open_Panna' => $b1['Open_Panna'],
                    'Close_Panna' => $b1['Close_Panna'],
                    'total_amount' => $b1['total_amount'],
                    'date' => $date1

                );
            }
        }

        $dig1 = 0;
        $close = $result['Panna'];
        for ($i = 0; $i < strlen($close); $i++) {
            $dig1 += intval($close[$i]);
        }
        if ($dig1 < 10) {
            $dig = $dig1;
        } else {
            $sumDigits = str_split($dig1);

            // Split the sum into individual digits
            if (count($sumDigits) > 1) {
                $dig = intval($sumDigits[1]); // Take the second digit of the sum
                // Output will be the second digit of the sum
            }
        }

        $model = new BasicModel();
        $rate1 = $model->rate();
        $rate = (array)$rate1[0];

        $bid1 = $data['post'];

        foreach ($bid1 as $b2) {
           
            if ($b2['g_id'] == $result['g_id']) {
                if ($b2['session'] == $result['Session']) {
                    if ($b2['gt_id'] == '1') {
                        // echo 1;
                        $rr =  $rate['Single_Digit_Amount'] / $rate['Single_Digit_Point'];
                        if ($b2['Open_Digits'] == $dig) {
                            $datan['session'] = 'open';
                            $datan['re_id'] = $re_id;
                            $datan['b_id'] = $b2['b_id'];
                            $datan['user_id'] = $b2['user_id'];
                            $datan['total_amount'] = $b2['total_amount'];
                            $datan['win_amount'] = $b2['total_amount'] * $rr;
                            $post = $model3->save($datan);
                            $model4 = new CartModel();
                            $total_am1 = $model4->where('user_id', $b2['user_id'])->first();
                            $total_am = $total_am1['total_amount'] + $datan['win_amount'];
                            $model4->update1($b2['user_id'], $total_am);
                            $post1 = $model4->findUById($b2['user_id']);
                            $input['t_for'] = 'win amount';
                            $input['w_id'] = $total_am1['wallet_id'];
                            $input['t_type'] = 1;
                            $input['total_am'] = $datan['win_amount'];
                            $model4->activity($input);
                        }
                    } elseif ($b2['gt_id'] == '3') {
                        // echo 1;
                        // echo "<pre>"; print_r("3");
                        // echo "</pre>";
                        $rr =  $rate['Single_Panna_Amount'] / $rate['Single_Panna_Point'];
                        if ($b2['Open_Panna'] == $result['Panna']) {
                            $datan['session'] = 'open';
                            $datan['re_id'] = $re_id;
                            $datan['b_id'] = $b2['b_id'];
                            $datan['user_id'] = $b2['user_id'];
                            $datan['total_amount'] = $b2['total_amount'];
                            $datan['win_amount'] = $b2['total_amount'] * $rr;
                            $post = $model3->save($datan);
                            $model4 = new CartModel();
                            $total_am1 = $model4->where('user_id', $b2['user_id'])->first();
                            $total_am = $total_am1['total_amount'] + $datan['win_amount'];
                            $model4->update1($b2['user_id'], $total_am);
                            $post1 = $model4->findUById($b2['user_id']);
                            $input['t_for'] = 'win amount';
                            $input['w_id'] = $total_am1['wallet_id'];
                            $input['t_type'] = 1;
                            $input['total_am'] = $datan['win_amount'];
                            $model4->activity($input);
                        }
                    } elseif ($b2['gt_id'] == '4') {
                        // echo "4";
                        $rr =  $rate['Double_Panna_Amount'] / $rate['Double_Panna_Point'];
                        if ($b2['Open_Panna'] == $result['Panna']) {
                            $datan['session'] = 'open';
                            $datan['re_id'] = $re_id;
                            $datan['b_id'] = $b2['b_id'];
                            $datan['user_id'] = $b2['user_id'];
                            $datan['total_amount'] = $b2['total_amount'];
                            $datan['win_amount'] = $b2['total_amount'] * $rr;

                            $post = $model3->save($datan);
                            $model4 = new CartModel();
                            $total_am1 = $model4->where('user_id', $b2['user_id'])->first();
                            $total_am = $total_am1['total_amount'] + $datan['win_amount'];
                            $model4->update1($b2['user_id'], $total_am);
                            $post1 = $model4->findUById($b2['user_id']);
                            $input['t_for'] = 'win amount';
                            $input['w_id'] = $total_am1['wallet_id'];
                            $input['t_type'] = 1;
                            $input['total_am'] = $datan['win_amount'];
                            $model4->activity($input);
                        }
                    } elseif ($b2['gt_id'] == '5') {
                        // echo 1;
                        $rr =  $rate['Tripple_Panna_Amount'] / $rate['Tripple_Panna_Point'];
                        if ($b2['Open_Panna'] == $result['Panna']) {
                            $datan['session'] = 'open';
                            $datan['re_id'] = $re_id;
                            $datan['b_id'] = $b2['b_id'];
                            $datan['user_id'] = $b2['user_id'];
                            $datan['total_amount'] = $b2['total_amount'];
                            $datan['win_amount'] = $b2['total_amount'] * $rr;
                            $post = $model3->save($datan);
                            $model4 = new CartModel();
                            $total_am1 = $model4->where('user_id', $b2['user_id'])->first();
                            $total_am = $total_am1['total_amount'] + $datan['win_amount'];
                            $model4->update1($b2['user_id'], $total_am);
                            $post1 = $model4->findUById($b2['user_id']);
                            $input['t_for'] = 'win amount';
                            $input['w_id'] = $total_am1['wallet_id'];
                            $input['t_type'] = 1;
                            $input['total_am'] = $datan['win_amount'];
                            $model4->activity($input);
                        }
                    }
                }
            }
        }
       
        return $bid1;
    }
    public function winall_save($re_id, $result)
    {

        $model2 = new BidModel();
        $model1 = new ResultModel();
        $model3 = new WinModel();
        $date = new DateTime();
        $date = date_default_timezone_set('Asia/Kolkata');
        $date1 = date("m-d-Y");

        $bid = $model2->findAll();

        $data['post'] = array();
        foreach ($bid as $b1) {
            $dateTime = \DateTime::createFromFormat('m-d-Y h:i A', $b1['date']);
            $dateOnly = $dateTime->format('m-d-Y');
            if ($date1 == $dateOnly) {
                $data['post'][] = array(
                    'g_id' => $b1['g_id'],
                    'gt_id' => $b1['gt_id'],
                    'user_id' => $b1['user_id'],
                    'b_id' => $b1['b_id'],
                    'session' => $b1['session'],
                    'Close_Digits' => $b1['Close_Digits'],
                    'Open_Digits' => $b1['Open_Digits'],
                    'Jodi' => $b1['Jodi'],
                    'Open_Panna' => $b1['Open_Panna'],
                    'Close_Panna' => $b1['Close_Panna'],
                    'total_amount' => $b1['total_amount'],
                    'date' => $date1

                );
            }
        }

        $dig = 0;
        $close = $result['Panna'];
        for ($i = 0; $i < strlen($close); $i++) {
            $dig += intval($close[$i]);
        }
        if ($dig < 10) {
            $dig = $dig;
        } else {
            $sumDigits = str_split($dig);

            // Split the sum into individual digits
            if (count($sumDigits) > 1) {
                $dig = intval($sumDigits[1]); // Take the second digit of the sum
                // Output will be the second digit of the sum
            }
        }
        $dig2 = 0;
        $open = $result['Open_Panna'];
        for ($i = 0; $i < strlen($open); $i++) {
            $dig2 += intval($open[$i]);
        }
        if ($dig2 < 10) {
            $start = $dig2;
        } else {
            $sumDigits = str_split($dig2);

            // Split the sum into individual digits
            if (count($sumDigits) > 1) {
                $start = intval($sumDigits[1]); // Take the second digit of the sum
                // Output will be the second digit of the sum
            }
        }

        $model = new BasicModel();
        $rate1 = $model->rate();
        $rate = (array)$rate1[0];

        $bid1 = $data['post'];

        foreach ($bid1 as $b2) {

            if ($b2['g_id'] == $result['g_id']) {

                if ($b2['session'] == $result['Session']) {
                    if ($b2['gt_id'] == '1') {
                        $rr =  $rate['Single_Digit_Amount'] / $rate['Single_Digit_Point'];
                        if ($b2['Close_Digits'] == $dig) {
                            $datan['session'] = 'close';
                            $datan['re_id'] = $re_id;
                            $datan['b_id'] = $b2['b_id'];
                            $datan['user_id'] = $b2['user_id'];
                            $datan['total_amount'] = $b2['total_amount'];
                            $datan['win_amount'] = $b2['total_amount'] * $rr;
                            $post = $model3->save($datan);
                            $model4 = new CartModel();
                            $total_am1 = $model4->where('user_id', $b2['user_id'])->first();
                            $total_am = $total_am1['total_amount'] + $datan['win_amount'];
                            $model4->update1($b2['user_id'], $total_am);
                            $post1 = $model4->findUById($b2['user_id']);
                            $input['t_for'] = 'win amount';
                            $input['w_id'] = $total_am1['wallet_id'];
                            $input['t_type'] = 1;
                            $input['total_am'] = $datan['win_amount'];
                            $model4->activity($input);
                        }
                    }
                    if ($b2['gt_id'] == '3') {
                        // echo "<pre>"; print_r("3");
                        // echo "</pre>";
                        $rr =  $rate['Single_Panna_Amount'] / $rate['Single_Panna_Point'];
                        if ($b2['Close_Panna'] == $result['Panna']) {
                            $datan['session'] = 'close';
                            $datan['re_id'] = $re_id;
                            $datan['b_id'] = $b2['b_id'];
                            $datan['user_id'] = $b2['user_id'];
                            $datan['total_amount'] = $b2['total_amount'];
                            $datan['win_amount'] = $b2['total_amount'] * $rr;
                            $post = $model3->save($datan);
                            $model4 = new CartModel();
                            $total_am1 = $model4->where('user_id', $b2['user_id'])->first();
                            $total_am = $total_am1['total_amount'] + $datan['win_amount'];
                            $model4->update1($b2['user_id'], $total_am);
                            $post1 = $model4->findUById($b2['user_id']);
                            $input['t_for'] = 'win amount';
                            $input['w_id'] = $total_am1['wallet_id'];
                            $input['t_type'] = 1;
                            $input['total_am'] = $datan['win_amount'];
                            $model4->activity($input);
                        }
                    }
                    if ($b2['gt_id'] == '4') {
                        $rr =  $rate['Double_Panna_Amount'] / $rate['Double_Panna_Point'];
                        if ($b2['Close_Panna'] == $result['Panna']) {
                            $datan['session'] = 'close';
                            $datan['re_id'] = $re_id;
                            $datan['b_id'] = $b2['b_id'];
                            $datan['user_id'] = $b2['user_id'];
                            $datan['total_amount'] = $b2['total_amount'];
                            $datan['win_amount'] = $b2['total_amount'] * $rr;

                            $post = $model3->save($datan);
                            $model4 = new CartModel();
                            $total_am1 = $model4->where('user_id', $b2['user_id'])->first();
                            $total_am = $total_am1['total_amount'] + $datan['win_amount'];
                            $model4->update1($b2['user_id'], $total_am);
                            $post1 = $model4->findUById($b2['user_id']);
                            $input['t_for'] = 'win amount';
                            $input['w_id'] = $total_am1['wallet_id'];
                            $input['t_type'] = 1;
                            $input['total_am'] = $datan['win_amount'];
                            $model4->activity($input);
                        }
                    }
                    if ($b2['gt_id'] == '5') {
                        $rr =  $rate['Tripple_Panna_Amount'] / $rate['Tripple_Panna_Point'];
                        if ($b2['Close_Panna'] == $result['Panna']) {
                            $datan['session'] = 'close';
                            $datan['re_id'] = $re_id;
                            $datan['b_id'] = $b2['b_id'];
                            $datan['user_id'] = $b2['user_id'];
                            $datan['total_amount'] = $b2['total_amount'];
                            $datan['win_amount'] = $b2['total_amount'] * $rr;
                            $post = $model3->save($datan);
                            $model4 = new CartModel();
                            $total_am1 = $model4->where('user_id', $b2['user_id'])->first();
                            $total_am = $total_am1['total_amount'] + $datan['win_amount'];
                            $model4->update1($b2['user_id'], $total_am);
                            $post1 = $model4->findUById($b2['user_id']);
                            $input['t_for'] = 'win amount';
                            $input['w_id'] = $total_am1['wallet_id'];
                            $input['t_type'] = 1;
                            $input['total_am'] = $datan['win_amount'];
                            $model4->activity($input);
                        }
                    }
                    if ($b2['gt_id'] == '6') {
                        $rr =  $rate['Half_Sangam_Amount'] / $rate['Half_Sangam_Point'];
                        if ($b2['Open_Panna'] == $result['Open_Panna'] || $b2['Close_Digits'] == $dig) {
                            $datan['session'] = 'close';
                            $datan['re_id'] = $re_id;
                            $datan['b_id'] = $b2['b_id'];
                            $datan['user_id'] = $b2['user_id'];
                            $datan['total_amount'] = $b2['total_amount'];
                            $datan['win_amount'] = $b2['total_amount'] * $rr;
                            $post = $model3->save($datan);
                            $model4 = new CartModel();
                            $total_am1 = $model4->where('user_id', $b2['user_id'])->first();
                            $total_am = $total_am1['total_amount'] + $datan['win_amount'];
                            $model4->update1($b2['user_id'], $total_am);
                            $post1 = $model4->findUById($b2['user_id']);
                            $input['t_for'] = 'win amount';
                            $input['w_id'] = $total_am1['wallet_id'];
                            $input['t_type'] = 1;
                            $input['total_am'] = $datan['win_amount'];
                            $model4->activity($input);
                        }
                    }
                    if ($b2['gt_id'] == '7') {
                        $rr =  $rate['Full_Sangam_Amount'] / $rate['Full_Sangam_Point'];
                        if ($b2['Open_Panna'] == $result['Open_Panna'] || $b2['Close_Panna'] == $result['Panna']) {
                            $datan['session'] = 'close';
                            $datan['re_id'] = $re_id;
                            $datan['b_id'] = $b2['b_id'];
                            $datan['user_id'] = $b2['user_id'];
                            $datan['total_amount'] = $b2['total_amount'];
                            $datan['win_amount'] = $b2['total_amount'] * $rr;
                            $post = $model3->save($datan);
                            $model4 = new CartModel();
                            $total_am1 = $model4->where('user_id', $b2['user_id'])->first();
                            $total_am = $total_am1['total_amount'] + $datan['win_amount'];
                            $model4->update1($b2['user_id'], $total_am);
                            $post1 = $model4->findUById($b2['user_id']);
                            $input['t_for'] = 'win amount';
                            $input['w_id'] = $total_am1['wallet_id'];
                            $input['t_type'] = 1;
                            $input['total_am'] = $datan['win_amount'];
                            $model4->activity($input);
                        }
                    }
                } elseif ($b2['session'] == "open") {
                    if ($b2['gt_id'] == '6') {
                        $rr =  $rate['Half_Sangam_Amount'] / $rate['Half_Sangam_Point'];
                        if ($b2['Close_Panna'] == $result['Panna'] && $b2['Open_Digits'] == $start) {

                            $datan['b_id'] = $b2['b_id'];
                            $datan['user_id'] = $b2['user_id'];
                            $datan['total_amount'] = $b2['total_amount'];
                            $datan['win_amount'] = $b2['total_amount'] * $rr;
                            $post = $model3->save($datan);
                            $model4 = new CartModel();
                            $total_am1 = $model4->where('user_id', $b2['user_id'])->first();
                            $total_am = $total_am1['total_amount'] + $datan['win_amount'];
                            $model4->update1($b2['user_id'], $total_am);
                            $post1 = $model4->findUById($b2['user_id']);
                            $input['t_for'] = 'win amount';
                            $input['w_id'] = $total_am1['wallet_id'];
                            $input['t_type'] = 1;
                            $input['total_am'] = $datan['win_amount'];
                            $model4->activity($input);
                        }
                    }
                    if ($b2['gt_id'] == '7') {
                        $rr =  $rate['Full_Sangam_Amount'] / $rate['Full_Sangam_Point'];
                        if ($b2['Open_Panna'] == $result['Open_Panna'] && $b2['Close_Panna'] == $result['Panna']) {
                            $datan['b_id'] = $b2['b_id'];
                            $datan['user_id'] = $b2['user_id'];
                            $datan['total_amount'] = $b2['total_amount'];
                            $datan['win_amount'] = $b2['total_amount'] * $rr;
                            $post = $model3->save($datan);
                            $model4 = new CartModel();
                            $total_am1 = $model4->where('user_id', $b2['user_id'])->first();
                            $total_am = $total_am1['total_amount'] + $datan['win_amount'];
                            $model4->update1($b2['user_id'], $total_am);
                            $post1 = $model4->findUById($b2['user_id']);
                            $input['t_for'] = 'win amount';
                            $input['w_id'] = $total_am1['wallet_id'];
                            $input['t_type'] = 1;
                            $input['total_am'] = $datan['win_amount'];
                            $model4->activity($input);
                        }
                    }
                } else {
                    if ($b2['gt_id'] == '2') {

                        $result['digt'] = $dig . $start;
                        // echo $result['digt'];
                        // die();

                        $rr =  $rate['Jodi_Digit_Amount'] / $rate['Jodi_Digit_Point'];
                        if ($b2['Jodi'] ==  $result['digt']) {
                            $datan['session'] = '';
                            $datan['re_id'] = $re_id;
                            $datan['b_id'] = $b2['b_id'];
                            $datan['user_id'] = $b2['user_id'];
                            $datan['total_amount'] = $b2['total_amount'];
                            $datan['win_amount'] = $b2['total_amount'] * $rr;
                            $post = $model3->save($datan);
                            $model4 = new CartModel();
                            $total_am1 = $model4->where('user_id', $b2['user_id'])->first();
                            $total_am = $total_am1['total_amount'] + $datan['win_amount'];
                            $model4->update1($b2['user_id'], $total_am);
                            $post1 = $model4->findUById($b2['user_id']);
                            $input['t_for'] = 'win amount';
                            $input['w_id'] = $total_am1['wallet_id'];
                            $input['t_type'] = 1;
                            $input['total_am'] = $datan['win_amount'];
                            $model4->activity($input);
                        }
                    }
                }
                // echo "yes";
                // die();

            }
        }
       
        return $bid1;
    }
    public function sstore()
    {
        $input = $this->getRequestInput($this->request);

        $model = new SResultModel();
        $g_id = $input['g_id'];
        $date = $input['date']; // Your original date in MM/DD/YYYY format
        $date1 = date("m-d-Y", strtotime($date));
        $model->save($input);
        $post = $model->where('g_id', $g_id)
        ->where('result_date', $date1) // Add this line to filter by date
        ->first();
        $input['re_id'] = $post['re_id'];
        $this->swin_save($input);
       
        return $this->getResponse(
            [
                'message' => 'star line result  added successfully',
                'game' => $post

            ]
        );
    }
    public function swin_save($result)
    {

        $model2 = new SBidModel();
        $model1 = new SResultModel();
        $model3 = new WinModel();
        $date = new DateTime();
        $date = date_default_timezone_set('Asia/Kolkata');
        $date1 = date("m-d-Y");

        $bid = $model2->findAll();

        $data['post'] = array();
        foreach ($bid as $b1) {
            $dateTime = \DateTime::createFromFormat('m-d-Y h:i A', $b1['date']);
            $dateOnly = $dateTime->format('m-d-Y');
            if ($date1 == $dateOnly) {
                $data['post'][] = array(
                    'g_id' => $b1['g_id'],
                    'gt_id' => $b1['gt_id'],
                    'user_id' => $b1['user_id'],
                    'b_id' => $b1['b_id'],
                    'Digits' => $b1['Digits'],
                    'Panna' => $b1['Panna'],
                    'total_amount' => $b1['total_amount'],
                    'date' => $date1

                );
            }
        }

        $dig1 = 0;
        $close = $result['Panna'];
        for ($i = 0; $i < strlen($close); $i++) {
            $dig1 += intval($close[$i]);
        }
        if ($dig1 < 10) {
            $dig = $dig1;
        } else {
            $sumDigits = str_split($dig1);

            // Split the sum into individual digits
            if (count($sumDigits) > 1) {
                $dig = intval($sumDigits[1]); // Take the second digit of the sum
                // Output will be the second digit of the sum
            }
        }


        $model = new BasicModel();
        $rate1 = $model->rates();
        $rate = (array)$rate1[0];

        $bid1 = $data['post'];
        // echo "<pre>";
        //         print_r($result['g_id']);
        //         echo "</pre>";
        //         die();
        foreach ($bid1 as $b2) {

            if ($b2['g_id'] == $result['g_id']) {
                if ($b2['gt_id'] == '1') {
                    $rr =  $rate['Single_Digit_Amount'] / $rate['Single_Digit_Point'];
                    if ($b2['Digits'] == $dig) {
                        $datan['re_id'] = $result['re_id'];
                        $datan['b_id'] = $b2['b_id'];
                        $datan['user_id'] = $b2['user_id'];
                        $datan['total_amount'] = $b2['total_amount'];
                        $datan['win_amount'] = $b2['total_amount'] * $rr;
                        $post = $model3->ssave($datan);
                        $model4 = new CartModel();
                        $total_am1 = $model4->where('user_id', $b2['user_id'])->first();
                        $total_am = $total_am1['total_amount'] + $datan['win_amount'];
                        $model4->update1($b2['user_id'], $total_am);
                        $post1 = $model4->findUById($b2['user_id']);
                        $input['t_for'] = 'star line win amount';
                        $input['w_id'] = $total_am1['wallet_id'];
                        $input['t_type'] = 1;
                        $input['total_am'] = $datan['win_amount'];
                        $model4->activity($input);
                    
                    }
                }
                if ($b2['gt_id'] == '3') {
                    // echo "<pre>"; print_r("3");
                    // echo "</pre>";
                    $rr =  $rate['Single_Panna_Amount'] / $rate['Single_Panna_Point'];
                    if ($b2['Panna'] == $result['Panna']) {
                        $datan['re_id'] = $result['re_id'];
                        $datan['b_id'] = $b2['b_id'];
                        $datan['user_id'] = $b2['user_id'];
                        $datan['total_amount'] = $b2['total_amount'];
                        $datan['win_amount'] = $b2['total_amount'] * $rr;
                        $post = $model3->ssave($datan);
                        $model4 = new CartModel();
                        $total_am1 = $model4->where('user_id', $b2['user_id'])->first();
                        $total_am = $total_am1['total_amount'] + $datan['win_amount'];
                        $model4->update1($b2['user_id'], $total_am);
                        $post1 = $model4->findUById($b2['user_id']);
                        $input['t_for'] = 'star line win amount';
                        $input['w_id'] = $total_am1['wallet_id'];
                        $input['t_type'] = 1;
                        $input['total_am'] = $datan['win_amount'];
                        $model4->activity($input);
                    }
                }
                if ($b2['gt_id'] == '4') {
                    $rr =  $rate['Double_Panna_Amount'] / $rate['Double_Panna_Point'];
                    if ($b2['Panna'] == $result['Panna']) {
                        $datan['re_id'] = $result['re_id'];
                        $datan['b_id'] = $b2['b_id'];
                        $datan['user_id'] = $b2['user_id'];
                        $datan['total_amount'] = $b2['total_amount'];
                        $datan['win_amount'] = $b2['total_amount'] * $rr;
                        $post = $model3->ssave($datan);
                        $model4 = new CartModel();
                        $total_am1 = $model4->where('user_id', $b2['user_id'])->first();
                        $total_am = $total_am1['total_amount'] + $datan['win_amount'];
                        $model4->update1($b2['user_id'], $total_am);
                        $post1 = $model4->findUById($b2['user_id']);
                        $input['t_for'] = 'star line win amount';
                        $input['w_id'] = $total_am1['wallet_id'];
                        $input['t_type'] = 1;
                        $input['total_am'] = $datan['win_amount'];
                        $model4->activity($input);
                    }
                }
                if ($b2['gt_id'] == '5') {
                    $rr =  $rate['Tripple_Panna_Amount'] / $rate['Tripple_Panna_Point'];
                    if ($b2['Panna'] == $result['Panna']) {
                        $datan['re_id'] = $result['re_id'];
                        $datan['b_id'] = $b2['b_id'];
                        $datan['user_id'] = $b2['user_id'];
                        $datan['total_amount'] = $b2['total_amount'];
                        $datan['win_amount'] = $b2['total_amount'] * $rr;
                        $post = $model3->ssave($datan);
                        $model4 = new CartModel();
                        $total_am1 = $model4->where('user_id', $b2['user_id'])->first();
                        $total_am = $total_am1['total_amount'] + $datan['win_amount'];
                        $model4->update1($b2['user_id'], $total_am);
                        $post1 = $model4->findUById($b2['user_id']);
                        $input['t_for'] = 'star line win amount';
                        $input['w_id'] = $total_am1['wallet_id'];
                        $input['t_type'] = 1;
                        $input['total_am'] = $datan['win_amount'];
                        $model4->activity($input);
                    }
                }

            }
        }
        // echo "<pre>";
        // print_r($bid1);
        // echo "</pre>";
        // die();
        return $bid1;
    }
    public function sshow($id)
    {
        // user_id pass
        try {

            $model = new SResultModel();
            $post = $model->findWById($id);
            return $this->getResponse(
                [
                    'message' => 'Post retrieved successfully',
                    'client' => $post
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find client for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }
    public function show_byg($id)
    {
        // user_id pass
        try {

            $model = new ResultModel();
            $post = $model->findGById($id);
            return $this->getResponse(
                [
                    'message' => 'Post retrieved successfully',
                    'client' => $post
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find client for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }
    public function sshow_byg($id)
    {
        // user_id pass
        try {

            $model = new SResultModel();
            $post = $model->findGById($id);
            return $this->getResponse(
                [
                    'message' => 'Post retrieved successfully',
                    'client' => $post
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find client for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }
    public function destroy($id)
    {
        try {
            $input = $this->getRequestInput($this->request);

            $model = new ResultModel();
           

            // Check the value of $input['Panna']
            if ($input['Panna'] == 'open') {
                    $model->deletedata($id);
                    $this->win_de($id);
            } else {
                // echo $input; die();
                    $model->deletedata1($id);
                    $this->win_decl($id);
            }
            // echo $data; die();
            // Update the row based on the re_id
            $post = $model->where('re_id', $id);
            return $this
                ->getResponse(
                    [
                        'message' => 'Result deleted successfully',
                        'post'  => $post
                    ]
                );
        } catch (Exception $exception) {
            return $this->getResponse(
                [
                    'message' => $exception->getMessage()
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }
    public function win_de($re_id)
    {
        
        $model3 = new WinModel();
        $date = new DateTime();
        $date = date_default_timezone_set('Asia/Kolkata');
        $date1 = date("m-d-Y");

        $win = $model3->findReById($re_id);
         if($win){
            foreach ($win as $wi) {
            
                $model4 = new CartModel();
                $total_am1 = $model4->where('user_id', $wi['user_id'])->first();
                $total_am = $total_am1['total_amount'] - $wi['win_amount'];
                $model4->update1($wi['user_id'], $total_am);
                $input['t_for'] = 'Incorrect result amount debited';
                $input['w_id'] = $total_am1['wallet_id'];
                $input['t_type'] = 0;
                $input['total_am'] = $wi['win_amount'];
                $model4->activity($input);
                $model3->deletedata($wi['win_id']);
            }
         }
       
        

        
       
    }
    public function win_decl($re_id)
    {
        $model3 = new WinModel();
        $date = new DateTime();
        $date = date_default_timezone_set('Asia/Kolkata');
        $date1 = date("m-d-Y");
        $win = $model3->findReById($re_id); 
        // echo "<pre>"; print_r($win);
        // echo "</pre>";
        // die();
        if($win){
            foreach ($win as $wi) {
     
                if($wi['session'] == 'close'){
           
                $model4 = new CartModel();
                $total_am1 = $model4->where('user_id', $wi['user_id'])->first();
           
                $total_am = $total_am1['total_amount'] - $wi['win_amount'];
                $model4->update1($wi['user_id'], $total_am);
                }elseif($wi['session'] == ''){
          
                    $model4 = new CartModel();
                    $total_am1 = $model4->where('user_id', $wi['user_id'])->first();
                    $total_am = $total_am1['total_amount'] - $wi['win_amount'];
                    $model4->update1($wi['user_id'], $total_am);
                }
                $input['t_for'] = 'Incorrect result amount debited';
                $input['w_id'] = $total_am1['wallet_id'];
                $input['t_type'] = 0;
                $input['total_am'] = $wi['win_amount'];
                $model4->activity($input);
                $model3->deletedata($wi['win_id']);
            }
        }
        

        
       
    }

    public function sdestroy($id)
    {
        try {
            $model = new SResultModel();

            $model->deletedata($id);

            return $this
                ->getResponse(
                    [
                        'message' => 'Result deleted successfully',
                    ]
                );
        } catch (Exception $exception) {
            return $this->getResponse(
                [
                    'message' => $exception->getMessage()
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }



    public function win_pre()
    {
        $input = $this->getRequestInput($this->request);

        $model = new ResultModel();
        $g_id = $input['g_id'];

        $date = $input['date']; // Your original date in MM/DD/YYYY format
        $date1 = date("m-d-Y", strtotime($date));

            if ($input['Session'] == "close") {
                $post = $this->winall_pr($input);
            }
         else {
           
            $data['date1'] = $date1;
            $data['g_id'] = $input['g_id'];
            $post = $this->win_pr($input);
        }
        // echo "<pre>"; print_r("yes");
        // echo "</pre>";
        // die();
        return $this->getResponse(
            [
                'message' => 'get Win user successfully',
                'game' => $post

            ]
        );
    }
    public function win_pr($result)
    {

        $model2 = new BidModel();
        $model1 = new ResultModel();
        $model3 = new WinModel();
        $date = new DateTime();
        $date = date_default_timezone_set('Asia/Kolkata');
        $date1 = date("m-d-Y");

        $bid = $model2->findAll();

        $data['post'] = array();
        foreach ($bid as $b1) {
            $dateTime = \DateTime::createFromFormat('m-d-Y h:i A', $b1['date']);
            $dateOnly = $dateTime->format('m-d-Y');
            if ($date1 == $dateOnly) {
                $data['post'][] = array(
                    'g_id' => $b1['g_id'],
                    'gt_id' => $b1['gt_id'],
                    'user_id' => $b1['user_id'],
                    'b_id' => $b1['b_id'],
                    'session' => $b1['session'],
                    'Close_Digits' => $b1['Close_Digits'],
                    'Open_Digits' => $b1['Open_Digits'],
                    'Jodi' => $b1['Jodi'],
                    'Open_Panna' => $b1['Open_Panna'],
                    'Close_Panna' => $b1['Close_Panna'],
                    'total_amount' => $b1['total_amount'],
                    'date' => $date1

                );
            }
        }

        $dig1 = 0;
        $close = $result['Panna'];
        for ($i = 0; $i < strlen($close); $i++) {
            $dig1 += intval($close[$i]);
        }
        if ($dig1 < 10) {
            $dig = $dig1;
        } else {
            $sumDigits = str_split($dig1);

            // Split the sum into individual digits
            if (count($sumDigits) > 1) {
                $dig = intval($sumDigits[1]); // Take the second digit of the sum
                // Output will be the second digit of the sum
            }
        }

        $model = new BasicModel();
        $rate1 = $model->rate();
        $rate = (array)$rate1[0];

        $bid1 = $data['post'];

        foreach ($bid1 as $b2) {
           
            if ($b2['g_id'] == $result['g_id']) {
                if ($b2['session'] == $result['Session']) {
                    if ($b2['gt_id'] == '1') {
                        // echo 1;
                        $rr =  $rate['Single_Digit_Amount'] / $rate['Single_Digit_Point'];
                        if ($b2['Open_Digits'] == $dig) {
                            $datan['session'] = 'open';
                            $datan['b_id'] = $b2['b_id'];
                            $datan['user_id'] = $b2['user_id'];
                            $datan['total_amount'] = $b2['total_amount'];
                            $datan['win_amount'] = $b2['total_amount'] * $rr;
                            $post = $model3->save($datan);
                            $model4 = new CartModel();
                            $total_am1 = $model4->where('user_id', $b2['user_id'])->first();
                            $total_am = $total_am1['total_amount'] + $datan['win_amount'];
                            $model4->update1($b2['user_id'], $total_am);
                            $post1 = $model4->findUById($b2['user_id']);
                            $input['t_for'] = 'win amount';
                            $input['w_id'] = $total_am1['wallet_id'];
                            $input['t_type'] = 1;
                            $input['total_am'] = $datan['win_amount'];
                            $model4->activity($input);
                        }
                    } elseif ($b2['gt_id'] == '3') {
                        // echo 1;
                        // echo "<pre>"; print_r("3");
                        // echo "</pre>";
                        $rr =  $rate['Single_Panna_Amount'] / $rate['Single_Panna_Point'];
                        if ($b2['Open_Panna'] == $result['Panna']) {
                            $datan['session'] = 'open';
                            $datan['re_id'] = $re_id;
                            $datan['b_id'] = $b2['b_id'];
                            $datan['user_id'] = $b2['user_id'];
                            $datan['total_amount'] = $b2['total_amount'];
                            $datan['win_amount'] = $b2['total_amount'] * $rr;
                            $post = $model3->save($datan);
                            $model4 = new CartModel();
                            $total_am1 = $model4->where('user_id', $b2['user_id'])->first();
                            $total_am = $total_am1['total_amount'] + $datan['win_amount'];
                            $model4->update1($b2['user_id'], $total_am);
                            $post1 = $model4->findUById($b2['user_id']);
                            $input['t_for'] = 'win amount';
                            $input['w_id'] = $total_am1['wallet_id'];
                            $input['t_type'] = 1;
                            $input['total_am'] = $datan['win_amount'];
                            $model4->activity($input);
                        }
                    } elseif ($b2['gt_id'] == '4') {
                        // echo "4";
                        $rr =  $rate['Double_Panna_Amount'] / $rate['Double_Panna_Point'];
                        if ($b2['Open_Panna'] == $result['Panna']) {
                            $datan['session'] = 'open';
                            $datan['re_id'] = $re_id;
                            $datan['b_id'] = $b2['b_id'];
                            $datan['user_id'] = $b2['user_id'];
                            $datan['total_amount'] = $b2['total_amount'];
                            $datan['win_amount'] = $b2['total_amount'] * $rr;

                            $post = $model3->save($datan);
                            $model4 = new CartModel();
                            $total_am1 = $model4->where('user_id', $b2['user_id'])->first();
                            $total_am = $total_am1['total_amount'] + $datan['win_amount'];
                            $model4->update1($b2['user_id'], $total_am);
                            $post1 = $model4->findUById($b2['user_id']);
                            $input['t_for'] = 'win amount';
                            $input['w_id'] = $total_am1['wallet_id'];
                            $input['t_type'] = 1;
                            $input['total_am'] = $datan['win_amount'];
                            $model4->activity($input);
                        }
                    } elseif ($b2['gt_id'] == '5') {
                        // echo 1;
                        $rr =  $rate['Tripple_Panna_Amount'] / $rate['Tripple_Panna_Point'];
                        if ($b2['Open_Panna'] == $result['Panna']) {
                            $datan['session'] = 'open';
                            $datan['re_id'] = $re_id;
                            $datan['b_id'] = $b2['b_id'];
                            $datan['user_id'] = $b2['user_id'];
                            $datan['total_amount'] = $b2['total_amount'];
                            $datan['win_amount'] = $b2['total_amount'] * $rr;
                            $post = $model3->save($datan);
                            $model4 = new CartModel();
                            $total_am1 = $model4->where('user_id', $b2['user_id'])->first();
                            $total_am = $total_am1['total_amount'] + $datan['win_amount'];
                            $model4->update1($b2['user_id'], $total_am);
                            $post1 = $model4->findUById($b2['user_id']);
                            $input['t_for'] = 'win amount';
                            $input['w_id'] = $total_am1['wallet_id'];
                            $input['t_type'] = 1;
                            $input['total_am'] = $datan['win_amount'];
                            $model4->activity($input);
                        }
                    }
                }
            }
        }
       
        return $bid1;
    }
    public function winall_pr($result)
    {

        $model2 = new BidModel();
        $model1 = new ResultModel();
        $model3 = new WinModel();
        $date = new DateTime();
        $date = date_default_timezone_set('Asia/Kolkata');
        $date1 = date("m-d-Y");

        $bid = $model2->findAll();

        $data['post'] = array();
        foreach ($bid as $b1) {
            $dateTime = \DateTime::createFromFormat('m-d-Y h:i A', $b1['date']);
            $dateOnly = $dateTime->format('m-d-Y');
            if ($date1 == $dateOnly) {
                $data['post'][] = array(
                    'g_id' => $b1['g_id'],
                    'gt_id' => $b1['gt_id'],
                    'user_id' => $b1['user_id'],
                    'b_id' => $b1['b_id'],
                    'session' => $b1['session'],
                    'Close_Digits' => $b1['Close_Digits'],
                    'Open_Digits' => $b1['Open_Digits'],
                    'Jodi' => $b1['Jodi'],
                    'Open_Panna' => $b1['Open_Panna'],
                    'Close_Panna' => $b1['Close_Panna'],
                    'total_amount' => $b1['total_amount'],
                    'date' => $date1

                );
            }
        }

        $dig = 0;
        $close = $result['Panna'];
        for ($i = 0; $i < strlen($close); $i++) {
            $dig += intval($close[$i]);
        }
        if ($dig < 10) {
            $dig = $dig;
        } else {
            $sumDigits = str_split($dig);

            // Split the sum into individual digits
            if (count($sumDigits) > 1) {
                $dig = intval($sumDigits[1]); // Take the second digit of the sum
                // Output will be the second digit of the sum
            }
        }
        $dig2 = 0;
        $open = $result['Open_Panna'];
        for ($i = 0; $i < strlen($open); $i++) {
            $dig2 += intval($open[$i]);
        }
        if ($dig2 < 10) {
            $start = $dig2;
        } else {
            $sumDigits = str_split($dig2);

            // Split the sum into individual digits
            if (count($sumDigits) > 1) {
                $start = intval($sumDigits[1]); // Take the second digit of the sum
                // Output will be the second digit of the sum
            }
        }

        $model = new BasicModel();
        $rate1 = $model->rate();
        $rate = (array)$rate1[0];

        $bid1 = $data['post'];

        foreach ($bid1 as $b2) {

            if ($b2['g_id'] == $result['g_id']) {

                if ($b2['session'] == $result['Session']) {
                    if ($b2['gt_id'] == '1') {
                        $rr =  $rate['Single_Digit_Amount'] / $rate['Single_Digit_Point'];
                        if ($b2['Close_Digits'] == $dig) {
                            $datan['session'] = 'close';
                            $datan['re_id'] = $re_id;
                            $datan['b_id'] = $b2['b_id'];
                            $datan['user_id'] = $b2['user_id'];
                            $datan['total_amount'] = $b2['total_amount'];
                            $datan['win_amount'] = $b2['total_amount'] * $rr;
                            $post = $model3->save($datan);
                            $model4 = new CartModel();
                            $total_am1 = $model4->where('user_id', $b2['user_id'])->first();
                            $total_am = $total_am1['total_amount'] + $datan['win_amount'];
                            $model4->update1($b2['user_id'], $total_am);
                            $post1 = $model4->findUById($b2['user_id']);
                            $input['t_for'] = 'win amount';
                            $input['w_id'] = $total_am1['wallet_id'];
                            $input['t_type'] = 1;
                            $input['total_am'] = $datan['win_amount'];
                            $model4->activity($input);
                        }
                    }
                    if ($b2['gt_id'] == '3') {
                        // echo "<pre>"; print_r("3");
                        // echo "</pre>";
                        $rr =  $rate['Single_Panna_Amount'] / $rate['Single_Panna_Point'];
                        if ($b2['Close_Panna'] == $result['Panna']) {
                            $datan['session'] = 'close';
                            $datan['re_id'] = $re_id;
                            $datan['b_id'] = $b2['b_id'];
                            $datan['user_id'] = $b2['user_id'];
                            $datan['total_amount'] = $b2['total_amount'];
                            $datan['win_amount'] = $b2['total_amount'] * $rr;
                            $post = $model3->save($datan);
                            $model4 = new CartModel();
                            $total_am1 = $model4->where('user_id', $b2['user_id'])->first();
                            $total_am = $total_am1['total_amount'] + $datan['win_amount'];
                            $model4->update1($b2['user_id'], $total_am);
                            $post1 = $model4->findUById($b2['user_id']);
                            $input['t_for'] = 'win amount';
                            $input['w_id'] = $total_am1['wallet_id'];
                            $input['t_type'] = 1;
                            $input['total_am'] = $datan['win_amount'];
                            $model4->activity($input);
                        }
                    }
                    if ($b2['gt_id'] == '4') {
                        $rr =  $rate['Double_Panna_Amount'] / $rate['Double_Panna_Point'];
                        if ($b2['Close_Panna'] == $result['Panna']) {
                            $datan['session'] = 'close';
                            $datan['re_id'] = $re_id;
                            $datan['b_id'] = $b2['b_id'];
                            $datan['user_id'] = $b2['user_id'];
                            $datan['total_amount'] = $b2['total_amount'];
                            $datan['win_amount'] = $b2['total_amount'] * $rr;

                            $post = $model3->save($datan);
                            $model4 = new CartModel();
                            $total_am1 = $model4->where('user_id', $b2['user_id'])->first();
                            $total_am = $total_am1['total_amount'] + $datan['win_amount'];
                            $model4->update1($b2['user_id'], $total_am);
                            $post1 = $model4->findUById($b2['user_id']);
                            $input['t_for'] = 'win amount';
                            $input['w_id'] = $total_am1['wallet_id'];
                            $input['t_type'] = 1;
                            $input['total_am'] = $datan['win_amount'];
                            $model4->activity($input);
                        }
                    }
                    if ($b2['gt_id'] == '5') {
                        $rr =  $rate['Tripple_Panna_Amount'] / $rate['Tripple_Panna_Point'];
                        if ($b2['Close_Panna'] == $result['Panna']) {
                            $datan['session'] = 'close';
                            $datan['re_id'] = $re_id;
                            $datan['b_id'] = $b2['b_id'];
                            $datan['user_id'] = $b2['user_id'];
                            $datan['total_amount'] = $b2['total_amount'];
                            $datan['win_amount'] = $b2['total_amount'] * $rr;
                            $post = $model3->save($datan);
                            $model4 = new CartModel();
                            $total_am1 = $model4->where('user_id', $b2['user_id'])->first();
                            $total_am = $total_am1['total_amount'] + $datan['win_amount'];
                            $model4->update1($b2['user_id'], $total_am);
                            $post1 = $model4->findUById($b2['user_id']);
                            $input['t_for'] = 'win amount';
                            $input['w_id'] = $total_am1['wallet_id'];
                            $input['t_type'] = 1;
                            $input['total_am'] = $datan['win_amount'];
                            $model4->activity($input);
                        }
                    }
                    if ($b2['gt_id'] == '6') {
                        $rr =  $rate['Half_Sangam_Amount'] / $rate['Half_Sangam_Point'];
                        if ($b2['Open_Panna'] == $result['Open_Panna'] || $b2['Close_Digits'] == $dig) {
                            $datan['session'] = 'close';
                            $datan['re_id'] = $re_id;
                            $datan['b_id'] = $b2['b_id'];
                            $datan['user_id'] = $b2['user_id'];
                            $datan['total_amount'] = $b2['total_amount'];
                            $datan['win_amount'] = $b2['total_amount'] * $rr;
                            $post = $model3->save($datan);
                            $model4 = new CartModel();
                            $total_am1 = $model4->where('user_id', $b2['user_id'])->first();
                            $total_am = $total_am1['total_amount'] + $datan['win_amount'];
                            $model4->update1($b2['user_id'], $total_am);
                            $post1 = $model4->findUById($b2['user_id']);
                            $input['t_for'] = 'win amount';
                            $input['w_id'] = $total_am1['wallet_id'];
                            $input['t_type'] = 1;
                            $input['total_am'] = $datan['win_amount'];
                            $model4->activity($input);
                        }
                    }
                    if ($b2['gt_id'] == '7') {
                        $rr =  $rate['Full_Sangam_Amount'] / $rate['Full_Sangam_Point'];
                        if ($b2['Open_Panna'] == $result['Open_Panna'] || $b2['Close_Panna'] == $result['Panna']) {
                            $datan['session'] = 'close';
                            $datan['re_id'] = $re_id;
                            $datan['b_id'] = $b2['b_id'];
                            $datan['user_id'] = $b2['user_id'];
                            $datan['total_amount'] = $b2['total_amount'];
                            $datan['win_amount'] = $b2['total_amount'] * $rr;
                            $post = $model3->save($datan);
                            $model4 = new CartModel();
                            $total_am1 = $model4->where('user_id', $b2['user_id'])->first();
                            $total_am = $total_am1['total_amount'] + $datan['win_amount'];
                            $model4->update1($b2['user_id'], $total_am);
                            $post1 = $model4->findUById($b2['user_id']);
                            $input['t_for'] = 'win amount';
                            $input['w_id'] = $total_am1['wallet_id'];
                            $input['t_type'] = 1;
                            $input['total_am'] = $datan['win_amount'];
                            $model4->activity($input);
                        }
                    }
                } elseif ($b2['session'] == "open") {
                    if ($b2['gt_id'] == '6') {
                        $rr =  $rate['Half_Sangam_Amount'] / $rate['Half_Sangam_Point'];
                        if ($b2['Close_Panna'] == $result['Panna'] && $b2['Open_Digits'] == $start) {

                            $datan['b_id'] = $b2['b_id'];
                            $datan['user_id'] = $b2['user_id'];
                            $datan['total_amount'] = $b2['total_amount'];
                            $datan['win_amount'] = $b2['total_amount'] * $rr;
                            $post = $model3->save($datan);
                            $model4 = new CartModel();
                            $total_am1 = $model4->where('user_id', $b2['user_id'])->first();
                            $total_am = $total_am1['total_amount'] + $datan['win_amount'];
                            $model4->update1($b2['user_id'], $total_am);
                            $post1 = $model4->findUById($b2['user_id']);
                            $input['t_for'] = 'win amount';
                            $input['w_id'] = $total_am1['wallet_id'];
                            $input['t_type'] = 1;
                            $input['total_am'] = $datan['win_amount'];
                            $model4->activity($input);
                        }
                    }
                    if ($b2['gt_id'] == '7') {
                        $rr =  $rate['Full_Sangam_Amount'] / $rate['Full_Sangam_Point'];
                        if ($b2['Open_Panna'] == $result['Open_Panna'] && $b2['Close_Panna'] == $result['Panna']) {
                            $datan['b_id'] = $b2['b_id'];
                            $datan['user_id'] = $b2['user_id'];
                            $datan['total_amount'] = $b2['total_amount'];
                            $datan['win_amount'] = $b2['total_amount'] * $rr;
                            $post = $model3->save($datan);
                            $model4 = new CartModel();
                            $total_am1 = $model4->where('user_id', $b2['user_id'])->first();
                            $total_am = $total_am1['total_amount'] + $datan['win_amount'];
                            $model4->update1($b2['user_id'], $total_am);
                            $post1 = $model4->findUById($b2['user_id']);
                            $input['t_for'] = 'win amount';
                            $input['w_id'] = $total_am1['wallet_id'];
                            $input['t_type'] = 1;
                            $input['total_am'] = $datan['win_amount'];
                            $model4->activity($input);
                        }
                    }
                } else {
                    if ($b2['gt_id'] == '2') {

                        $result['digt'] = $dig . $start;
                        // echo $result['digt'];
                        // die();

                        $rr =  $rate['Jodi_Digit_Amount'] / $rate['Jodi_Digit_Point'];
                        if ($b2['Jodi'] ==  $result['digt']) {
                            $datan['session'] = '';
                            $datan['re_id'] = $re_id;
                            $datan['b_id'] = $b2['b_id'];
                            $datan['user_id'] = $b2['user_id'];
                            $datan['total_amount'] = $b2['total_amount'];
                            $datan['win_amount'] = $b2['total_amount'] * $rr;
                            $post = $model3->save($datan);
                            $model4 = new CartModel();
                            $total_am1 = $model4->where('user_id', $b2['user_id'])->first();
                            $total_am = $total_am1['total_amount'] + $datan['win_amount'];
                            $model4->update1($b2['user_id'], $total_am);
                            $post1 = $model4->findUById($b2['user_id']);
                            $input['t_for'] = 'win amount';
                            $input['w_id'] = $total_am1['wallet_id'];
                            $input['t_type'] = 1;
                            $input['total_am'] = $datan['win_amount'];
                            $model4->activity($input);
                        }
                    }
                }
                // echo "yes";
                // die();

            }
        }
       
        return $bid1;
    }

}
