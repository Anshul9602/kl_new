<?php

namespace App\Controllers;

use App\Models\CartModel;
use App\Models\BannerModel;
use App\Models\UserModel;
use App\Models\BidModel;
use App\Models\PostTypeModel;


use App\Models\MethodModel;
use App\Models\TransactionModel;
use App\Models\PostModel;


use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

use ReflectionException;

class AUsers extends BaseController
{
    public function index()
    {
        $model = new UserModel();

        $model1 = new CartModel();
        $post = $model->findAll();
        $data['post'] = array();

        foreach ($post as $post1) {
            $wallet = $model1->findUById($post1['user_id']);
            $data['post'][] = array(
                'user_id' => $post1['user_id'],
                'status' => $post1['status'],
                'name' => $post1['user_name'],
                'number' => $post1['user_number'],
                'date' => $post1['date'],
                'Balance' => $wallet['total_amount'],
                'Batting' => $wallet['status']
            );
        }

        // echo "<pre>";
        // print_r($data['post'] );
        // echo "</pre>";
        // die();
        return $this->getResponse(
            [
                'message' => 'result  get successfully',
                'game' => $data['post']

            ]
        );

        return $this->getResponse(
            [
                'message' => 'Post retrieved successfully',
                'post' => $model->findAll()
            ]
        );
    }

    public function user_a($id)
    {
        try {
            $model = new UserModel();
            $model1 = new CartModel();
            $model2 = new TransactionModel();
            $model3 = new BidModel();
            $model4 = new MethodModel();
            $mode5 = new PostTypeModel();

            $post = $model->findUserById($id);

            $data['post'] = array();
            $data['bid'] = array();
            $b1 = $model3->findUById($post['user_id']);

            $w1 = $model1->findUById($post['user_id']);

            if ($post) {

                $wallet[] = array();
                if ($w1) {

                    $transtion[] = array();
                    $transtion1 = $model2->findTById1($w1['wallet_id']);
                    if ($transtion1) {

                        foreach ($transtion1 as $t1) {
                            $transtion = array(
                                'transaction_id' => $t1['transaction_id'],
                                'transtion_status' => $t1['status'],
                                'amount' => $t1['amount'],
                                't_type' => $t1['type'],
                                't_for' => $t1['t_for']
                            );
                        }
                    } else {
                        $transtion = array();
                    }

                    $wallet = array(
                        'wallet_id' => $w1['wallet_id'],
                        'wallet_status' => $w1['status'],
                        'total_amount' => $w1['total_amount'],
                        'transtion' => $transtion
                    );
                }

                $data['post'][] = array(
                    'user_id' => $post['user_id'],
                    'status' => $post['status'],
                    'name' => $post['user_name'],
                    'number' => $post['user_number'],
                    'date' => $post['date'],
                    'wallet' => $wallet

                );
            }

            if ($b1) {
                foreach ($b1 as $bd1) {

                    $mode6 = new PostModel();
                    $game = $mode6->findPostById($bd1['g_id']);
                    $gamet = $mode5->findById($bd1['gt_id']);
                    // echo "<pre>";
                    // print_r($gamet );
                    // echo "</pre>";
                    $data['bid'][] = array(
                        'b_id' => $bd1['b_id'],
                        'g_id' => $bd1['g_id'],
                        'g_title' => $game['g_title'],

                        'gt_name' => $gamet['gt_name'],
                        'gt_id' => $bd1['gt_id'],

                        'session' => $bd1['session'],
                        'Open_Digits' => $bd1['Open_Digits'],
                        'Close_Digits' => $bd1['Close_Digits'],
                        'Jodi' => $bd1['Jodi'],
                        'Open_Panna' => $bd1['Open_Panna'],
                        'Close_Panna' => $bd1['Close_Panna'],
                        'total_amount' => $bd1['total_amount'],
                        'date' => $bd1['date']
                    );
                }
            } else {

                $data['bid'][] = array();
            }


            return $this->getResponse(
                [
                    'message' => 'user updated successfully',
                    'client' => $data

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
    public function update_a($id)
    {
        try {
            $model = new UserModel();

            $input = $this->getRequestInput($this->request);
            $model->update_a($id, $input);
            $post = $model->findUserById($id);
            return $this->getResponse(
                [
                    'message' => 'user updated successfully',
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
    public function update_w($id)
    {
        try {
            $model = new CartModel();

            $input = $this->getRequestInput($this->request);
            $model->updatepub($id, $input);
            $post = $model->findUById($id);
            return $this->getResponse(
                [
                    'message' => 'wallet updated successfully',
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
    public function st_bt($id)
    {
        try {
            $model = new CartModel();
            $model1 = new UserModel();
            $wallet = $model->findUById($id);
            $user = $model1->findUserById($id);
            $user_status = $user['status'];
            $wallet_status = $wallet['status'];
            return $this->getResponse(
                [
                    'message' => 'data get successfully',
                    'user_status' => $user_status,
                    'batting_status' => $wallet_status

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

    // compaln
    public function compant()
    {

        $model = new CartModel();
        $post = $model->get_com();
        return $this->getResponse(
            [
                'message' => 'Banner retrieved successfully',
                'post' => $post
            ]
        );
    }


    // ---- banner ===//
    public function banners()
    {

        $model = new BannerModel();
        return $this->getResponse(
            [
                'message' => 'Banner retrieved successfully',
                'post' => $model->findAll()
            ]
        );
    }
    public function banner_add()
    {
        $input = $this->getRequestInput($this->request);
        $image = $input['image'];
        $model = new BannerModel();
        $model->save_img($image);

        return $this->getResponse(
            [
                'message' => 'Banner  added successfully',

            ]
        );
    }
    public function destroy_banner($id)
    {
        try {
            $model = new BannerModel();
            $post = $model->findBannerById($id);
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
    public function update_banner($id)
    {
        try {
            $model = new BannerModel();
            $input = $this->getRequestInput($this->request);
            $model->update1($id, $input);
            $post = $model->findBannerById($id);
            return $this->getResponse(
                [
                    'message' => 'banner updated successfully',
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

    // -------- start g section -------//
    //game type

    // g store new
    public function store()
    {
        $input = $this->getRequestInput($this->request);
        $g_title = $input['g_title'];
        $model = new PostModel();
        $model->save($input);
        $post = $model->where('g_title', $g_title)->first();
        $input['g_id'] = $post['g_id'];
        return $this->getResponse(
            [
                'message' => 'service  added successfully',
                'game' => $post

            ]
        );
    }

    public function show($id)
    {
        try {
            $model = new PostModel();
            $post = $model->findPostById($id);
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


    // g status update
    public function g_published($id)
    {
        try {
            $model = new PostModel();
            $model->findPostById($id);
            $input = $this->getRequestInput($this->request);
            $model->updatepub($id, $input);
            $post = $model->findPostById($id);

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
    // g deleted the
    public function destroy($id)
    {
        try {
            $model = new PostModel();
            $post = $model->findPostById($id);
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
