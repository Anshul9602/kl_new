<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;
use \Datetime;
class UserModel extends Model
{
    protected $table = 'user_log';
   
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
    public function user_a($id)
    {
      
        $userId = $id; // Replace with the desired user_id

        $builder = $this->db->table('user_log');
        $builder->select('user_log.*, wallet.*, transactions.*');
        $builder->join('wallet', 'user_log.user_id = wallet.user_id', 'inner');
        $builder->join('transactions', 'wallet.wallet_id = transactions.wallet_id', 'inner');
        $builder->where('user_log.user_id', $userId); // Replace 1 with the desired user_id
        $query = $builder->get();
      
        echo "1";
        $user = $query->getResult();
        
        if (!$user){
            return null;
           
        } else{
            return $user;
        }
            

       
    }
    public function findUserByUserNumber(string $user_number)
    {
       
        $user = $this
            ->asArray()
            ->where(['user_number' => $user_number])
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
    public function findUserByUserNumber1(string $user_number)
    {
       
        $user = $this
            ->asArray()
            ->where(['user_number' => $user_number])
            ->first();
            
        if (!$user){
            return 0;
           
        } else{
            return 1;
        }
            

       
    }
    public function findUserById($id)
    {
        $user = $this
            ->asArray()
            ->where(['user_id' => $id])
            ->first();

        if (!$user) 
            throw new Exception('User does not exist for specified user id');

        return $user;
    }
    
    public function save($data): bool
    {
        
    $user_number = $data['user_number'];
    $pin = $data['pin'];
    $status = "1";
    
    $user_name = $data['user_name'];
    $date = new DateTime();
    $date = date_default_timezone_set('Asia/Kolkata');

    $date1 = date("m-d-Y h:i A");
    $sql = "INSERT INTO `user_log` (`user_id`, `user_number`,`user_name`, `pin`,`status`,`date`) 
    VALUES (NULL, '$user_number','$user_name', '$pin','$status','$date1')";
        $post = $this->db->query($sql);
        // echo json_encode($post);
    if (!$post) 
        throw new Exception('Post does not exist for specified id');

    return $post;

       
    }
   
   
    public function save1($data)
    {
        // echo json_encode($data);
        
    $user_name = $data['user_name'];
    $user_number = $data['user_number'];
    $pin = $data['pin'];
    $date = new DateTime();
    $date = date_default_timezone_set('Asia/Kolkata');

    $date = date("m-d-Y h:i A");
    $sql = "INSERT INTO `admin` (`user_id`, `user_name`, `user_number`,`pin`,`date`) VALUES (NULL, '$user_name','$user_number', '$pin','$date')";
    // echo json_encode($sql);
    // echo json_encode($data);
    //     die();
    $post = $this->db->query($sql);
      
    if (!$post){
        return false;
    }else{
        return $post;
    }

    }
    public function admin_update($id ,$data): bool
    {

      // echo $id;

        if (empty($data)) {
            echo "1";
            return true;
        }

        $pin = $data['pin'];
       
        $sql = "UPDATE `admin` SET  
        pin = '$pin'
          WHERE user_id = $id";
        // echo "<pre>"; print_r($sql);
        // echo "</pre>";
        $post = $this->db->query($sql);
    if (!$post) 
        throw new Exception('Post does not exist for specified id');

    return $post;

       
    }
    public function update1($id ,$data): bool
    {

      // echo $id;

        if (empty($data)) {
            echo "1";
            return true;
        }

        $user_name = $data['user_name'];
      
        $user_number = $data['user_number'];
        $status = $data['status'];
        $sql = "UPDATE `user_log` SET  
        user_name = '$user_name',
        user_number = '$user_number',
        status = '$status'
          WHERE user_id = $id";
        // echo "<pre>"; print_r($sql);
        // echo "</pre>";
        $post = $this->db->query($sql);
    if (!$post) 
        throw new Exception('Post does not exist for specified id');

    return $post;

       
    }
    public function update_a($id ,$data): bool
    {

      // echo $id;

        if (empty($data)) {
            echo "1";
            return true;
        }

        $status = $data['status'];
        $sql = "UPDATE `user_log` SET  
        status = '$status'
          WHERE user_id = $id";
        // echo "<pre>"; print_r($sql);
        // echo "</pre>";
        $post = $this->db->query($sql);
    if (!$post) 
        throw new Exception('Post does not exist for specified id');

    return $post;

       
    }
    public function update_pin($id ,$data): bool
    {

      // echo $id;

        if (empty($data)) {
            echo "1";
            return true;
        }

        $pin = $data['pin'];
        $sql = "UPDATE `user_log` SET  
        pin = '$pin'
          WHERE user_id = $id";
        // echo "<pre>"; print_r($sql);
        // echo "</pre>";
        $post = $this->db->query($sql);
    if (!$post) 
        throw new Exception('Post does not exist for specified id');

    return $post;

       
    }
    public function deletedata($id)
    {
        $post = $this
            ->asArray()
            ->where(['user_id' => $id])
            ->delete();

        if (!$post) 
            throw new Exception('user does not exist for specified id');

        return $post;
    }
}



   
  
   
    
 