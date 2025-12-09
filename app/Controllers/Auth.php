<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\UserAModel;
use App\Models\BasicModel;
use App\Models\AdminUserModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
use App\Models\CartModel;
use ReflectionException;

class Auth extends BaseController
{
    /**
     * Register a new user
     * @return Response
     * @throws ReflectionException
     */
    public function register()
    {
       $input = $this->getRequestInput($this->request);
    //    echo "<pre>"; print_r($input); echo "</pre>";
    //    die();
       $model = new UserModel();
       $model1 = new CartModel();      
       $user = $model->findUserByUserNumber1($input['user_number']);
        // echo "<pre>"; print_r($user); echo "</pre>";
        //    die();
       if($user == 0){
        $data =[
            
            'user_name' => $input['user_name'],
            'user_number' => $input['user_number'],
            'pin' => password_hash($input['pin'], PASSWORD_DEFAULT),
        ];
        $model3 = new BasicModel();
        $basic1 = $model3->findAll();
        $basic = (array)$basic1[0];
        //      echo "<pre>"; print_r($basic); echo "</pre>";
        //    die();
        $user1 = $model->save($data);         
        $data1 = $model->findUserByUserNumber($input['user_number']);
        $data['user_id'] = $data1['user_id'];
        $data['total_am'] = $basic['well_bonus'];
        $data['status'] = $basic['global_batting'];
         $model1->save($data);
        // echo json_encode( $wallet );
        // die();
        }else{
            $user1 = null;
            $response = $this->response->setStatusCode(500)->setBody('user allrady in list');
            return  $response;
         }
        if($user1 == null){
            $response = $this->response->setStatusCode(400)->setBody('user not listed');
            return  $response;
              
        }else{

            return $this->getJWTForNewUser(
                $data['user_number'],
                ResponseInterface::HTTP_CREATED
            );
        } 
    }
        public function basic()
        {
            $model = new BasicModel();
            $basic = $model->findAll();
            return $basic;
            
        }
    public function admin_register()
    {


        // $rules = [
        //     'user_name' => 'required',
        //     'pin' => 'required|min_length[4]'
        // ];
      
       $input = $this->getRequestInput($this->request);

       $model1 = new AdminUserModel();
                    
       $user = $model1->findUserByUserNumber1($input['user_number']);
    //    echo "<pre>"; print_r($user); echo "</pre>";
    //    die();
       if($user == 0){
        $data =[
            
            'user_name' => $input['user_name'],
            'user_number' => $input['user_number'],
            'pin' => password_hash($input['pin'], PASSWORD_DEFAULT),
        ];
       
      
        $userModel = new UserModel();  
        $user_admin = $userModel->save1($data);

        }else{
            $user_admin = null;
              $response = $this->response->setStatusCode(400)->setBody('user allrady in list');
            return  $response;
           
          
         }
       
        if($user_admin == null){
              $response = $this->response->setStatusCode(400)->setBody('not register');
            return  $response;
             
        }else{
            return $this->getJWTForNewUser(
                $data['user_number'],
                ResponseInterface::HTTP_CREATED
            );
        }

           
      
    }
    /**
     * Authenticate Existing User
     * @return Response
     */
    public function login()
    {
        $rules = [

            'pin' => 'required|min_length[4]|max_length[4]|validateUser[user_number, pin]'
        ];

        $errors = [
            'pin' => [
                'validateUser' => 'Invalid login credentials provided'
            ]
        ];

        $input = $this->getRequestInput($this->request);
        // echo json_encode($input);
        if($this->validateRequest($input, $rules, $errors)){
           
            return $this->getJWTForUser($input['user_number']);
        }else{
            // return $this->getResponse($input);
              $response = $this->response->setStatusCode(400)->setBody('Invalid login Mobile Number');
            return  $response;
        }
        
       
       
    }
    public function admin_login()
    {
      
        $rules = [
           
            'pin' => 'required|min_length[4]|max_length[4]|validateUser[user_number, pin]'
        ];

        $errors = [
            'pin' => [
                'validateUser' => 'Invalid login credentials provided'
            ]
        ];

        $input = $this->getRequestInput($this->request);
        // echo json_encode($input);
        if($this->validateRequest1($input, $rules, $errors)){
            // return $this->getResponse($input);
            return $this->getJWTForAdminUser($input['user_number']);
        }else{
            $response = $this->response->setStatusCode(400)->setBody('Invalid login credentials provided');
            return  $response;
        }
        
       
       
    }
    public function user_update($id)
    {
        try {
            $model = new UserModel();
            $input = $this->getRequestInput($this->request);
            $model->update1($id ,$input);
            $post = $model->findUserById($id);
            return $this->getResponse(
                [
                    'message' => 'user updaetd successfully',
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
    public function user_up_pin($id)
    {
        try {
            $model = new UserModel();
            $input = $this->getRequestInput($this->request);
            //   echo "<pre>"; print_r($input);
            // echo "</pre>";
            // die();

            if($this->validatepin($input, $id)){
                // return $this->getResponse($input);
                $data =[
                    'pin' => password_hash($input['newpin'], PASSWORD_DEFAULT),
                ];
                $model->update_pin($id ,$data);
            }else{
                $response = $this->response->setStatusCode(400)->setBody('Invalid provided Old Password');
                return  $response;
            }

           
            $post = $model->findUserById($id);
            return $this->getResponse(
                [
                    'message' => 'user pin updaetd successfully',
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
    public function auser_up_pin($id)
    {
        try {
            $model = new UserModel();
            $input = $this->getRequestInput($this->request);
            $data =[
                'pin' => password_hash($input['newpin'], PASSWORD_DEFAULT),
            ];
            $model->update_pin($id ,$data);
           
            $post = $model->findUserById($id);
            return $this->getResponse(
                [
                    'message' => 'user pin updaetd successfully',
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
    public function adminuser_update($id)
    {
        try {
            $model = new UserModel();
          $input = $this->getRequestInput($this->request);
          $data =[
            'pin' => password_hash($input['newpin'], PASSWORD_DEFAULT),
        ];
            $model->admin_update($id ,$data);
              
            // $post = $model->findUserById($id);
            return $this->getResponse(
                [
                    'message' => 'user updaetd successfully'
                    
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
    private function getJWTForUser(
        string $user_Number,
        int $responseCode = ResponseInterface::HTTP_OK
    )
    {
        
        try {
            $model = new UserModel();
            $model1 = new UserAModel();
            $user = $model->findUserByUserNumber($user_Number);
            $model = new CartModel();
            $cart = $model->findUById($user['user_id']);
            $log = $model1->findUserByUserId($user['user_id']);
            if($log == null) {
                
                $log = $model1->save($user['user_id']);
            }else{
             
                $log = $model1->up_log($user['user_id']);
            }
            // echo json_encode($user);
            unset($user['pin']);

            helper('jwt');

            return $this
                ->getResponse(
                    [
                        'message' => 'User authenticated successfully',
                        'user' => $user,
                        'cart' => $cart,
                        'access_token' => getSignedJWTForUser($user_Number)
                    ]
                );
        } catch (Exception $exception) {
            return $this
                ->getResponse(
                    [
                        'error' => $exception->getMessage(),
                    ],
                    $responseCode
                );
        }
    }
    private function getJWTForAdminUser(
        string $user_Number,
        int $responseCode = ResponseInterface::HTTP_OK
    )
    {
        
        try {
            $model = new AdminUserModel();
            $user = $model->findUserByUserNumber($user_Number);
           
            unset($user['pin']);

            helper('jwt');

            return $this
                ->getResponse(
                    [
                        'message' => 'User authenticated successfully',
                        'user' => $user,
                       
                        'access_token' => getSignedJWTForUser($user_Number)
                    ]
                );
        } catch (Exception $exception) {
            return $this
                ->getResponse(
                    [
                        'error' => $exception->getMessage(),
                    ],
                    $responseCode
                );
        }
    }
    private function getJWTForNewUser(
        string $user_number,
        int $responseCode = ResponseInterface::HTTP_OK
    )
    {
        
        try {
            $model = new UserModel();
            $user = $model->findUserByUserNumber($user_number);
            // echo json_encode($user);
            unset($user['pin']);

            helper('jwt');

            return $this
                ->getResponse(
                    [
                        'message' => 'User Created successfully',
                        
                        'access_token' => getSignedJWTForUser($user_number)
                    ]
                );
        } catch (Exception $exception) {
            return $this
                ->getResponse(
                    [
                        'error' => $exception->getMessage(),
                    ],
                    $responseCode
                );
        }
    }
    
}
