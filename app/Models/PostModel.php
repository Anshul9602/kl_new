<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;
use \Datetime;


// structure

//save
//find by id--
//find all
// deletes by id
// activity
//update service    
class PostModel extends Model
{
    protected $table = 'g_service';
    // protected $allowedFields = [
    //     'name',
    //     'email',
    //     'retainer_fee'
    // ];
    protected $db;
    protected $updatedField = 'updated_at';

   


    /// g section start == //
    public function save($data): bool
    {
        if (empty($data)) {
            echo "1";
            return true;
        }
     $g_title = $data['g_title'];
     $g_name_hindi = $data['g_name_hindi'];

     $ot = $data['open_t']; // 24-hour format
     $ct = $data['close_t']; // 24-hour format

     // Convert 24-hour format to 12-hour format
    //  $time12 = date('h:i A', strtotime($ot));
     $open_t = date('h:i A', strtotime($ot));
     $close_t = date('h:i A', strtotime($ct));
     $status = $data['status'];
     $maket_status = $data['maket_status'];
    
        $sql = "INSERT INTO `g_service` (`g_id`, 
        `g_title`, 
        `g_name_hindi`, 
        `open_t`, 
        `close_t`, 
        `status`, 
        `maket_status`) VALUES (NULL, 
        '$g_title', 
        '$g_name_hindi', 
        '$open_t', 
        '$close_t', 
        '$status', 
        '$maket_status' 
        )";
        $post = $this->db->query($sql);
        if (!$post) 
        throw new Exception('Post does not exist for specified id');
        return $post;  
    }
    
    public function findPostById($id)
    {
        $post = $this
            ->asArray()
            ->where(['g_id' => $id])
            ->first();

        if (!$post) 
            throw new Exception('Service does not exist for specified id');

        return $post;
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
    public function deletedata($id)
    {
        $post = $this
            ->asArray()
            ->where(['g_id' => $id])
            ->delete();

        if (!$post) 
            throw new Exception('Service does not exist for specified id');

        return $post;
    }
    
   
    public function activity($data): bool
    {
        if (empty($data)) {
            echo "1";
            return true;
        }

           $user_id = $data['user_id'];
           $username = $data['user_name'];
           $dp_url = $data['dp_url'];
           $activity_name = $data['g_name'];
           $activity_amount = $data['g_amount'];
           $g_number = $data['g_number'];
           $date = date("M-d-Y h:i A");
         $sql1 = "INSERT INTO `g_activity_log` (`activity_log_id`, `user_id`,`username`, `dp_url`, `activity_name`, `activity_amount`,  `g_id`, `timestamp`) VALUES (NULL, '$user_id', '$username', '$dp_url', '$activity_name', '$activity_amount','$g_number','$date')";
        $post1 = $this->db->query($sql1);
        if (!$post1) 
        throw new Exception('Game does not save specified time');
        return $post1; 
    }
    public function update1($id ,$data): bool
    {
        if (empty($data)) {
            echo "1";
            return true;
        }
        $g_title = $data['g_title'];
        $g_name_hindi = $data['g_name_hindi'];
        $maket_status = $data['maket_status'];
        $open_t = $data['open_t'];
        $close_t = $data['close_t'];
        $status = $data['status'];
        $sql = "UPDATE `g_service` SET  
        g_title= '$g_title',
        g_name_hindi= '$g_name_hindi',
        open_t= '$open_t',
        close_t= '$close_t',
        status= '$status',
        maket_status= '$maket_status'
         WHERE g_id = $id";
        $post = $this->db->query($sql);
        if (!$post) 
        throw new Exception('Game does not exist for specified id');

         return $post;  
    }
    public function updatepub($id ,$data): bool
    {
        if (empty($data)) {
            echo "1";
            return true;
        }
        $status = $data['status'];
        $sql = "UPDATE `g_service` SET  status= '$status' WHERE g_id = $id";
        $post = $this->db->query($sql);
    if (!$post) 
        throw new Exception('service does not exist for specified id');

    return $post;

    }
    public function updatepub1($id ,$data): bool
    {
        if (empty($data)) {
            echo "1";
            return true;
        }
        $maket_status = $data['maket_status'];
        $sql = "UPDATE `g_service` SET  maket_status= '$maket_status' WHERE g_id = $id";
        $post = $this->db->query($sql);
    if (!$post) 
        throw new Exception('service does not exist for specified id');

    return $post;

    }
   
    

}