<?php

namespace App\Controllers;

use App\Models\UserModelLotus;

use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

use ReflectionException;

class AuthLotus extends BaseController
{
    /**
     * Register a new user
     * @return Response
     * @throws ReflectionException
     */
    public function register()
    {
       $input = $this->getRequestInput($this->request);
       $model = new UserModelLotus();
          
       $user = $model->findUserByUserNumber1($input['user_number']);
     //    echo "<pre>"; print_r($user); echo "</pre>";
        //    die();
       if($user == 0){
        $data =[
            
            'user_name' => $input['user_name'],
            'user_number' => $input['user_number'],
            'pin' => password_hash($input['pin'], PASSWORD_DEFAULT),
        ];

        $user1 = $model->save($data);         
        $data1 = $model->findUserByUserNumber($input['user_number']);
        $data['user_id'] = $data1['user_id'];
      
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
        if($this->validateRequestlot($input, $rules, $errors)){
           
            return $this->getJWTForUser($input['user_number']);
        }else{
            // return $this->getResponse($input);
              $response = $this->response->setStatusCode(400)->setBody('Invalid login Mobile Number');
            return  $response;
        }
        
       
       
    }
    
    public function user_update($id)
    {
        try {
            $model = new UserModelLotus();
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
    
    private function getJWTForUser(
        string $user_Number,
        int $responseCode = ResponseInterface::HTTP_OK
    )
    {
        
        try {
            $model = new UserModelLotus();
            $user = $model->findUserByUserNumber($user_Number);
            
            // echo json_encode($user);
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
            $model = new UserModelLotus();
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

    public function lot_b()
    {
        $model = new UserModelLotus();
        $post =$model->basic();
        return $this->getResponse(
            [
                'message' => 'Post retrieved successfully',
                'post' => $post
            ]
        );
    }
}
