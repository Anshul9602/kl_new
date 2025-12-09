<?php

namespace App\Controllers;
use App\Models\MethodModel;
use App\Models\UserModel;
use App\Models\TransactionModel;
use App\Models\ActiviteModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

use ReflectionException;
class Method extends BaseController
{
    public function index()
    {
        $model = new MethodModel();

        return $this->getResponse(
            [
                'message' => 'cart retrieved successfully',
                'post' => $model->findAll()
            ]
        );
    }
    public function show($id)
    {
       // user_id pass
        try {

            $model = new MethodModel();
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
    public function store()
    {
        $input = $this->getRequestInput($this->request);
        $model = new MethodModel();
        // echo json_encode($input);
//             $total =$model->where('user_id', $input['user_id'])->first();
// print_r($total);
// die();
            if($input['name'] == 'account'){
                
                $model->save_ac($input);
               
            }else {
                $model->save($input);
               
            }
        return $this->getResponse(
            [
                'message' => 'method  added successfully',
                
                
            ]
        );
    }
    
   
    public function update($id)
    {
        try {

            $model = new MethodModel();
            
            $input = $this->getRequestInput($this->request);
            if($input['name'] == 'account'){
                $model->update_ac($id ,$input);
               
               
            }else {
                $model->update_num($id ,$input);
               
            }
           
            $post = $model->findPById($id);

            return $this->getResponse(
                [
                    'message' => 'Mehtod updated successfully',
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
            $model = new MethodModel();
            $post = $model->findPById($id);
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

}
