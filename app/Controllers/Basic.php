<?php

namespace App\Controllers;
use App\Models\BasicModel;
use App\Models\UserAModel;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Basic extends BaseController
{
    public function index()
    {
        $model = new BasicModel();

        return $this->getResponse(
            [
                'message' => 'Post retrieved successfully',
                'post' => $model->findAll()
            ]
        );
    }
    public function latest_log($id)
    {
        $model = new UserAModel();

        return $this->getResponse(
            [
                'message' => 'Post retrieved successfully',
                'post' => $model->findUserByUserId($id)
            ]
        );
    }
    
    public function rate()
    {
        $model = new BasicModel();
        $rate =$model->rate();
        //    echo "<pre>"; print_r($rate);
        // echo "</pre>";
        return $this->getResponse(
            [
                'message' => 'Post retrieved successfully',
                'rate' => $rate
            ]
        );
    }
    public function rates()
    {
        $model = new BasicModel();
        $rate =$model->rates();
        //    echo "<pre>"; print_r($rate);
        // echo "</pre>";
        return $this->getResponse(
            [
                'message' => 'Post retrieved successfully',
                'rate' => $rate
            ]
        );
    }
    public function rate_u()
    {
        $input = $this->getRequestInput($this->request);
        $model = new BasicModel();
        $rate =$model->rate_u($input);
        //    echo "<pre>"; print_r($rate);
        // echo "</pre>";
        return $this->getResponse(
            [
                'message' => 'Post retrieved successfully',
                'rate' => $rate
            ]
        );
    }
    public function rates_u()
    {
        $input = $this->getRequestInput($this->request);
        $model = new BasicModel();
        $rate =$model->rates_u($input);
        //    echo "<pre>"; print_r($rate);
        // echo "</pre>";
        return $this->getResponse(
            [
                'message' => 'Post retrieved successfully',
                'rate' => $rate
            ]
        );
    }
   
    public function update($id)
    {
        try {
            $model = new BasicModel();
            $input = $this->getRequestInput($this->request);
            $model->update_num($id ,$input);
            $post = $model->findAll();
            return $this->getResponse(
                [
                    'message' => 'detail updaetd successfully',
                    'client' => $post
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


public function otp_send()
{
    $input = $this->getRequestInput($this->request);
    session_start();

    $api_key = 'mk9FmduXikm530fTCyirdg';
    $mobile_number = $input['user_number'];
    $otp = $input['otp'];
    // $otp = mt_rand(100000, 999999);
    
    // // Store OTP and timestamp in the session
    // $_SESSION['otp'] = $otp;
    // $_SESSION['otp_timestamp'] = time();
   
    $message = "Your One Time Password is: $otp. Thanks SMSINDIAHUB";

    $url = "http://cloud.smsindiahub.in/vendorsms/pushsms.aspx";
    $params = [
        'APIKey' => $api_key,
        'msisdn' => "91$mobile_number",
        'sid' => 'AREPLY',
        'msg' => $message,
        'fl' => 0,
        'gwid' => 2
    ];

    $url .= '?' . http_build_query($params);

    $response = file_get_contents($url);

    if ($response !== false) {
       
            echo "OTP sent successfully!";
       
    } else {
        echo "Failed to communicate with the SMS gateway.";
    }
}


  
   
  
   
}
