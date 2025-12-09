<?php

namespace App\Controllers;
use App\Models\BidModel;
use App\Models\SBidModel;
use App\Models\CartModel;
use App\Models\UserModel;
use App\Models\TransactionModel;
use App\Models\ActiviteModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
use \DateTime;

use ReflectionException;
class Bid extends BaseController
{
    public function index()
    {
        $model = new BidModel();

        return $this->getResponse(
            [
                'message' => 'Post retrieved successfully',
                'post' => $model->findAll()
            ]
        );
    }
    public function index_admin()
    {
        $model = new BidModel();
        $post = $model->getbdData();
        return $this->getResponse(
            [
                'message' => 'Post retrieved successfully',
                'post' => $post
            ]
        );
    }
    public function sindex_admin()
    {
        $model = new BidModel();
        $post = $model->sgetbdData();
        return $this->getResponse(
            [
                'message' => 'Post retrieved successfully',
                'post' => $post
            ]
        );
    }
    public function today()
    {
        $model = new BidModel();
        $bid = $model->findAll();
        $date = new DateTime();
        $date = date_default_timezone_set('Asia/Kolkata');
        $date1 = date("m-d-Y");
        $data['post'] = array();
        foreach ($bid as $b1) {  
            $dateTime = \DateTime::createFromFormat('m-d-Y h:i A', $b1['date']);
            $dateOnly = $dateTime->format('m-d-Y');
            if($date1 == $dateOnly){
                // echo "yes";
               $data['post'][] = array(
                'bid_date' => $dateOnly,
                'b_id' => $b1['b_id'],
                'user_id' => $b1['user_id'],
                'g_id' => $b1['g_id'],
                'gt_id' => $b1['gt_id'],
                'session' => $b1['session'],
                'Open_Digits' => $b1['Open_Digits'],
                'Close_Digits' => $b1['Close_Digits'],
                'Jodi' => $b1['Jodi'],
                'Open_Panna' => $b1['Open_Panna'],
                'Close_Panna' => $b1['Close_Panna'],
                'total_amount' => $b1['total_amount'],
                'date' => $b1['date']

               

                );
            }
            }


//     echo "<pre>"; print_r($bid);
    //     echo "</pre>";
    //   die();

        return $this->getResponse(
            [
                'message' => 'Post retrieved successfully',
                'post' => $data['post']
            ]
        );
    }
    public function sindex()
    {
        $model = new SBidModel();

        return $this->getResponse(
            [
                'message' => 'Post retrieved successfully',
                'post' => $model->findAll()
            ]
        );
    }
    
    public function store()
    {
        $input = $this->getRequestInput($this->request);
        $model = new BidModel();
        $gt_id = $input['gt_id'];
        $user_id = $input['user_id'];


        if ($gt_id == 6) {
        //  echo "6";
          $model->save6($input);
        }else if($gt_id == 7){
            // echo "7";
            $model->save7($input);
        }
        else {
           
            $model->save($input);
        }
        
        $model1 = new CartModel();
        $total_am1 =$model1->where('user_id', $user_id)->first();
       
        $total_am = $total_am1['total_amount'] - $input['total_amount'];   
        // echo "<pre>"; print_r($total_am);
        //     echo "</pre>";
        //     die();
        $model1->update_am($total_am1['wallet_id'] ,$total_am);
        $input['t_type'] = 0;
        $input['total_am'] = $input['total_amount'];
        $input['w_id'] =$total_am1['wallet_id'];
        $input['t_for'] ='bid';

         $model1->activity($input); 
        $post = $model->where('user_id', $user_id)->first();
        return $this->getResponse(
            [
                'message' => 'service  added successfully',
                'game' => $post
                
            ]
        );
    }
    public function sstore()
    {
        $input = $this->getRequestInput($this->request);
        $model = new SBidModel();
        $gt_id = $input['gt_id'];
        $user_id = $input['user_id'];
        $model->save($input);
        $model1 = new CartModel();
        $total_am1 =$model1->where('user_id', $user_id)->first();
        // echo "<pre>"; print_r($total_am1);
        // echo "</pre>";
        // die();
        $total_am = $total_am1['total_amount'] - $input['total_amount'];   
       
        $model1->update_am($total_am1['wallet_id'] ,$total_am);
        $input['t_type'] = 0;
        $input['total_am'] = $input['total_amount'];
        $input['w_id'] =$total_am1['wallet_id'];
        $input['t_for'] ='bid';

         $model1->activity($input); 
        $post = $model->where('user_id', $user_id)->first();
        return $this->getResponse(
            [
                'message' => 'service  added successfully',
                'game' => $post
                
            ]
        );
    }
    public function show($id)
    {
       // user_id pass
        try {
            $model = new BidModel();
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
    public function sshow($id)
    {
       // user_id pass
        try {
            $model = new SBidModel();
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
    public function B_all($id)
    {
        $model = new BidModel();
        $post = $model->findUById($id);
        
        if($post != null){
            return $this->getResponse(
                [
                    'message' => 'bid retrieved successfully',
                    'client' => $post
                ]
            );
        }else{
            return $this->getResponse(
                [
                    'message' => 'Could not find Bid for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
       
    }
    public function sB_all($id)
    {
        $model = new SBidModel();
        $post = $model->findUById($id);
        
        if($post != null){
            return $this->getResponse(
                [
                    'message' => 'bid retrieved successfully',
                    'client' => $post
                ]
            );
        }else{
            return $this->getResponse(
                [
                    'message' => 'Could not find Bid for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
       
    }
    
    public function update_num($id)
    {
        try {
            $model = new BidModel();
            $input = $this->getRequestInput($this->request);
            $model->update_num($id ,$input);
            $post = $model->findBById($id);
            return $this->getResponse(
                [
                    'message' => 'Bid updaetd successfully',
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
    public function supdate_num($id)
    {
        try {
            $model = new SBidModel();
            $input = $this->getRequestInput($this->request);
            $model->update_num($id ,$input);
            $post = $model->findBById($id);
            return $this->getResponse(
                [
                    'message' => 'Bid updaetd successfully',
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
   
    public function destroy($id)
    {
        try {
            $model = new BidModel();
            $model->deletedata($id);
            return $this
                ->getResponse(
                    [
                        'message' => 'Bid deleted successfully',
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
    public function sdestroy($id)
    {
        try {
            $model = new SBidModel();
            $model->deletedata($id);
            return $this
                ->getResponse(
                    [
                        'message' => 'Bid deleted successfully',
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
    public function revert($id)
    {
        try {
            $model = new BidModel();
            $bid = $model->findBById($id);
            $model4 = new CartModel();
            $total_am1 = $model4->where('user_id', $bid['user_id'])->first();
            $total_am = $total_am1['total_amount'] + $bid['total_amount'];
            $model4->update1($bid['user_id'], $total_am);
           
            $input['t_for'] = 'refund bid amount';
            $input['w_id'] = $total_am1['wallet_id'];
            $input['t_type'] = 1;
            $input['total_am'] = $bid['total_amount'];
            $model4->activity($input);
            $model->deletedata($id);
            return $this
                ->getResponse(
                    [
                        'message' => 'Bid deleted successfully',
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

}
