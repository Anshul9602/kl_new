<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;
use \Datetime;
class UserAModel extends Model
{
    protected $table = 'user_log_a';
   
    protected $allowedFields = [
        'user_name',
        'pin',
    ];
    protected $updatedField = 'updated_at';

    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    protected function beforeInsert(array $data): array
    {
    
        return $this->getUpdatedDataWithHashedPassword($data);
    }

    protected function beforeUpdate(array $data): array
    {
        return $this->getUpdatedDataWithHashedPassword($data);
    }

    private function getUpdatedDataWithHashedPassword(array $data): array
    {
        if (isset($data['data']['password'])) {
            $plaintextPassword = $data['data']['password'];
            $data['data']['password'] = $this->hashPassword($plaintextPassword);
        }
        return $data;
    }

    private function hashPassword(string $plaintextPassword): string
    {
        return password_hash($plaintextPassword, PASSWORD_BCRYPT);
    }                         
    
    public function findUserByUserId($id)
    {
       
        $user = $this
            ->asArray()
            ->where(['user_id' => $id])
            ->first();
            
        if (!$user){
            return null;
           
        } else{
            return $user;
        }
            

       
    }
    
    public function findAll(int $limit = 0, int $offset = 0)
    {
        if ($this->tempAllowCallbacks) {
            // Call the before event and check for a return
            $eventData = $this->trigger('beforeFind', [
                'method'    => 'findAll',
                'limit'     => $limit,
                'offset'    => $offset,
                'singleton' => false,
            ]);

            if (! empty($eventData['returnData'])) {
                return $eventData['data'];
            }
        }

        $eventData = [
            'data'      => $this->doFindAll($limit, $offset),
            'limit'     => $limit,
            'offset'    => $offset,
            'method'    => 'findAll',
            'singleton' => false,
        ];

        if ($this->tempAllowCallbacks) {
            $eventData = $this->trigger('afterFind', $eventData);
        }

        $this->tempReturnType     = $this->returnType;
        $this->tempUseSoftDeletes = $this->useSoftDeletes;
        $this->tempAllowCallbacks = $this->allowCallbacks;

        return $eventData['data'];
    }
   
    public function findUserById($id)
    {
        $user = $this
            ->asArray()
            ->where(['log_id' => $id])
            ->first();

        if (!$user) 
            throw new Exception('User does not exist for specified user id');

        return $user;
    }
    
    public function save($id): bool
    {
        
    $user_id = $id;
   
    $date = new DateTime();
    $date = date_default_timezone_set('Asia/Kolkata');

    $date1 = date("m-d-Y h:i A");
    $sql = "INSERT INTO `user_log_a` (`log_id`, `user_id`,`date`) 
    VALUES (NULL, '$user_id','$date1')";
        $post = $this->db->query($sql);
        // echo json_encode($post);
    if (!$post) 
        throw new Exception('Post does not exist for specified id');

    return $post;

       
    }
   
    public function up_log($id): bool
    {
    $date = new DateTime();
    $date = date_default_timezone_set('Asia/Kolkata');

    $date1 = date("m-d-Y h:i A");
    $sql = "UPDATE `user_log_a` SET date = '$date1' WHERE user_id = $id";
    // echo json_encode($sql);
        $post = $this->db->query($sql);
        
    if (!$post) 
        throw new Exception('Post does not exist for specified id');

    return $post;

       
    }
    
   
}



   
  
   
    
 