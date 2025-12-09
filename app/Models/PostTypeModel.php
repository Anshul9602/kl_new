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
class PostTypeModel extends Model
{
    protected $table = 'gn_type';
    // protected $allowedFields = [
    //     'name',
    //     'email',
    //     'retainer_fee'
    // ];
    protected $db;
    protected $updatedField = 'updated_at';

    public function save($data): bool
    {
        if (empty($data)) {
            echo "1";
            return true;
        }
     $g_title = $data['gt_name'];
     
    // $date = date("m/d/Y h:i A");
    //  $date = new DateTime();
    //  $date = date_default_timezone_set('Asia/Kolkata');

    //  $date = date("m/d/Y h:i A");
        $sql = "INSERT INTO `gn_type` (`g_id`, 
        `g_title`) VALUES (NULL, 
        '$g_title' 
        )";
        // echo "<pre>"; print_r($sql);
        // echo "</pre>";
        // die;
        $post = $this->db->query($sql);
       

    if (!$post) 
        throw new Exception('Post does not exist for specified id');

    return $post;

       
    }
    public function star()
{
    $sql = "SELECT * FROM gn_type
    WHERE gt_id IN (1, 3, 4, 5)";
    
    $query = $this->db->query($sql);

    if (!$query) {
        throw new Exception('Query execution failed');
    }
    
    $post = $query->getResultArray();
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
    public function findById($id)
    {
        $post = $this
            ->asArray()
            ->where(['gt_id' => $id])
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
       // echo "<pre>"; print_r($sql1);
       // echo "</pre>";
       // die();
        $post1 = $this->db->query($sql1);


    if (!$post1) 
        throw new Exception('Game does not save specified time');

    return $post1;

       
    }
    public function update1($id ,$data): bool
    {

    // echo $id;

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
        
       // $date = date("m/d/Y h:i A");
        // $date = new DateTime();
        // $date = date_default_timezone_set('Asia/Kolkata');
   
        // $date = date("m/d/Y h:i A");


        $sql = "UPDATE `g_service` SET  
        g_title= '$g_title',
        g_name_hindi= '$g_name_hindi',
        open_t= '$open_t',
        close_t= '$close_t',
        status= '$status',
        maket_status= '$maket_status',
         WHERE g_id = $id";
        // echo "<pre>"; print_r($sql);
        // echo "</pre>";
        $post = $this->db->query($sql);
    if (!$post) 
        throw new Exception('Game does not exist for specified id');

    return $post;

       
    }
    public function updatepub($id ,$data): bool
    {

    // echo $id;

        if (empty($data)) {
            echo "1";
            return true;
        }
        $status = $data['status'];
       // $date = date("m/d/Y h:i A");
        // $date = new DateTime();
        // $date = date_default_timezone_set('Asia/Kolkata');
   
        // $date = date("m/d/Y h:i A");

        $sql = "UPDATE `g_service` SET  status= '$status' WHERE g_id = $id";
        // echo "<pre>"; print_r($sql);
        // echo "</pre>";
        $post = $this->db->query($sql);
    if (!$post) 
        throw new Exception('service does not exist for specified id');

    return $post;

       
    }
   
    
   


}