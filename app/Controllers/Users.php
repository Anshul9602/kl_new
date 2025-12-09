<?php

namespace App\Controllers;
use App\Models\PostModel;
use App\Models\SPostModel;
use App\Models\BannerModel;
use App\Models\PostTypeModel;
use App\Models\SPostTypeModel;
use App\Models\UserModel;

use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

use ReflectionException;
class Users extends BaseController
{
    public function index()
    {
        $model = new PostModel();

        return $this->getResponse(
            [
                'message' => 'Post retrieved successfully',
                'post' => $model->findAll()
            ]
        );
    }
    public function sindex()
    {
        $model = new SPostModel();

        return $this->getResponse(
            [
                'message' => 'Post retrieved successfully',
                'post' => $model->findAll()
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
        $image= $input['image'];
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
            $model->update1($id ,$input);
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
    public function g_type()
    {
        $model = new PostTypeModel();

        return $this->getResponse(
            [
                'message' => 'Post retrieved successfully',
                'post' => $model->findAll()
            ]
        );
    }
    public function sg_type()
    {
        
        $model = new PostTypeModel();

        return $this->getResponse(
            [
                'message' => 'Post retrieved successfully',
                'post' => $model->star()
            ]
        );
    }
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
    public function sstore()
    {
        $input = $this->getRequestInput($this->request);
        $g_title = $input['g_title'];
        $model = new SPostModel();
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
    public function sshow($id)
    {
        try {
            $model = new SPostModel();
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
    public function update($id)
    {
        try {
            $model = new PostModel();
           
            $input = $this->getRequestInput($this->request);
            $model->update1($id ,$input);
            $post = $model->findPostById($id);
            return $this->getResponse(
                [
                    'message' => 'Client updated successfully',
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
    public function supdate($id)
    {
        try {
            $model = new SPostModel();
           
            $input = $this->getRequestInput($this->request);
            $model->update1($id ,$input);
            $post = $model->findPostById($id);
            return $this->getResponse(
                [
                    'message' => 'Client updated successfully',
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
    
    // g status update
    public function g_published($id)
    {
        try {
            $model = new PostModel();
            $model->findPostById($id);
            $input = $this->getRequestInput($this->request);
            $model->updatepub($id ,$input);
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
    public function gs_published($id)
    {
        try {
            $model = new SPostModel();
            $model->findPostById($id);
            $input = $this->getRequestInput($this->request);
            $model->updatepub($id ,$input);
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
    public function g_market($id)
    {
        try {
            $model = new PostModel();
            $model->findPostById($id);
            $input = $this->getRequestInput($this->request);
            $model->updatepub1($id ,$input);
            $post = $model->findPostById($id);

            return $this->getResponse(
                [
                    'message' => 'markte status updated successfully',
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
    public function gs_market($id)
    {
        try {
            $model = new SPostModel();
            $model->findPostById($id);
            $input = $this->getRequestInput($this->request);
            $model->updatepub1($id ,$input);
            $post = $model->findPostById($id);

            return $this->getResponse(
                [
                    'message' => 'markte status updated successfully',
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
