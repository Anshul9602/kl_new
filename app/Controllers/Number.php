<?php

namespace App\Controllers;
use App\Models\ResultModel;
use App\Models\SResultModel;
use App\Models\NumberModel;
use App\Models\NumberHModel;
use App\Models\PostModel;
use App\Models\UserModel;
use App\Models\TransactionModel;
use App\Models\ActiviteModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
use \DateTime;

use ReflectionException;
class Number extends BaseController
{
    public function index()
    {
        $model = new NumberModel();
        return $this->getResponse(
            [
                'message' => 'result  get successfully',
                'game' => $model->findAll()
                
            ]
        );
    }
  
    public function hindex()
    {
        $model = new NumberHModel();
        return $this->getResponse(
            [
                'message' => 'result  get successfully',
                'game' => $model->findAll()
                
            ]
        );
    }
  
    
    
    public function gt_id($id)
    {
       // user_id pass
       
        try {

            $model = new NumberModel();
            $post = $model->findGTById($id);
            return $this->getResponse(
                [
                    'message' => 'nuber retrieved successfully',
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
    public function show_ank($id)
    {
       
       // user_id pass
        try {

            $model = new NumberModel();
            $post = $model->findAById($id);
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
    public function show_half_ank($id)
    {
       // user_id pass
        try {

            $model = new NumberHModel();
            $post = $model->findAById($id);
            return $this->getResponse(
                [
                    'message' => 'Number retrieved successfully',
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
  
    public function show_half_panna($id)
    {
       // user_id pass
        try {

            $model = new NumberHModel();
            $post = $model->findPById($id);
            return $this->getResponse(
                [
                    'message' => 'Number retrieved successfully',
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
  
   
   
  

}
