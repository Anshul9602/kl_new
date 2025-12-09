<?php

namespace App\Controllers;
use App\Models\CartModel;
use App\Models\UserModel;
use App\Models\TransactionModel;
use App\Models\ActiviteModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

use ReflectionException;
class Cart extends BaseController
{
    public function index()
    {
        $model = new CartModel();

        return $this->getResponse(
            [
                'message' => 'cart retrieved successfully',
                'post' => $model->findAll()
            ]
        );
    }
    
    public function store($id)
    {
        $input = $this->getRequestInput($this->request);
        $model = new CartModel();
        // echo json_encode($input);
            $total_am1 =$model->where('wallet_id', $id)->first();
            if($input['t_type'] == 0){
                $total_am = $total_am1['total_amount'] - $input['total_am'];
                $model->update_am($id ,$total_am);
                $model->add_wd($id ,$input);

                $input['t_for'] = 'W';
            }else if($input['t_type'] == 1){
                // echo json_encode($input);
                $total_am = $total_am1['total_amount'] + $input['total_am'];
               $model->update_am($id ,$total_am);
               $input['t_for'] = 'Add';
            }
           $post = $model->where('wallet_id', $id)->first();
         
         $input['w_id'] = $post['wallet_id'];
        
     
        $model->activity($input);
        return $this->getResponse(
            [
                'message' => 'amount  added successfully',
                'game' => $post
                
            ]
        );
    }

    // widrow database 
    public function wd_all()
    {
       
        $model = new CartModel();
        // echo json_encode($input);
          
        $wddata =  $model->getwdData();
        
          
        return $this->getResponse(
            [
                'message' => 'widrow  successfully',
                'post' => $wddata
                
            ]
        );
    }
    public function uwd_all($id)
    {
        $input = $this->getRequestInput($this->request);
        $model = new CartModel();
        // echo json_encode($input);
          
        $user =  $model->findUById($id);
        $id1 = $user['wallet_id'];
        $wddata =  $model->getuwdData($id1);
        
          
        return $this->getResponse(
            [
                'message' => 'widrow  successfully',
                'post' => $wddata
                
            ]
        );
    }
    public function wd_give($id)
    {
        $input = $this->getRequestInput($this->request);
        $model = new CartModel();
        // echo json_encode($input);
       $post = $model->wd_give($id,$input);
        return $this->getResponse(
            [
                'message' => 'widrow  successfully',
                 'post' => $post
            ]
        );
    }
    public function show($id)
    {
       // user_id pass
        try {

            $model = new CartModel();
            $post = $model->findUById($id);
            
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
    public function t_all($id)
    {
     
        $w_id = $id;
        try {
          
            $model1 = new TransactionModel();
          
            $post = $model1->findTById($w_id);
           
            return $this->getResponse(
                [
                    'message' => 'Transaction retrieved successfully',
                    'client' => $post
                ]
            );

        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find trnasation for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }
    public function tr_all()
    {
     
       
        try {
          
            $model1 = new TransactionModel();
          
            $post = $model1->findAll();
           
            return $this->getResponse(
                [
                    'message' => 'Transaction retrieved successfully',
                    'client' => $post
                ]
            );

        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find trnasation for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }
    public function update_by_user($id)
    {
        try {

            $model = new CartModel();
            $input = $this->getRequestInput($this->request);
            $total_am1 =$model->where('user_id', $id)->first();
            $total_am = $total_am1['total_amount'] + $input['total_am'];
            $model->update1($id ,$total_am);
            $post = $model->findUById($id);
            $input['t_for'] = 'Fund Add By Admin';
            $input['w_id'] = $total_am1['wallet_id'];
            $input['t_type'] = 1;
            $model->activity($input);
            return $this->getResponse(
                [
                    'message' => 'Wallet updated successfully',
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
    
    public function w_published($id)
    {
        try {
            $model = new CartModel();
            $model->findWById($id);
            $input = $this->getRequestInput($this->request);
            $model->updatepub($id ,$input);
            $post = $model->findWById($id);
            return $this->getResponse(
                [
                    'message' => 'Post Published successfully',
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
            $model = new CartModel();
            $post = $model->findWById($id);
            $model->deletedata($id);
            return $this
                ->getResponse(
                    [
                        'message' => 'Post deleted successfully',
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
    public function distroy($id)
    {
        try {


            $model1 = new UserModel();
            $model2 = new CartModel();
            $post = $model2->findWById($id);
            $model1->deletedata($id);
            $model2->deletedata1($id);
            return $this
                ->getResponse(
                    [
                        'message' => 'Post deleted successfully',
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


// complant 

public function save_com()
    {
        $input = $this->getRequestInput($this->request);
        $model = new CartModel();
        // echo json_encode($input);
        $model->save_com($input);
        return $this->getResponse(
            [
                'message' => 'complant  added successfully',
               
                
            ]
        );
    }


}











