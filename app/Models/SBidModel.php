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
class SBidModel extends Model
{
    protected $table = 's_bid_table';
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
        
         // single
        if ($data['gt_id'] == 1) {
          
            $Digits = $data['number'];
            $Panna = '';
          
        }else{
            $Digits = '';
            $Panna = $data['number'];
            
        }
      
        // jodi
        
         $user_id = $data['user_id'];
         $g_id = $data['g_id'];
         $gt_id = $data['gt_id'];
         
         $total_amount = $data['total_amount'];
        
        $date = date("m/d/Y h:i A");
         $date = new DateTime();
         $date = date_default_timezone_set('Asia/Kolkata');
    
         $date1 = date("m-d-Y h:i A");
        
        $sql = "INSERT INTO `s_bid_table` (`b_id`, 
        `user_id`, `g_id`, `gt_id`,  `Digits`,  `Panna`,  `total_amount`,  
        `date`) VALUES (NULL, 
        '$user_id', '$g_id',   '$gt_id',  '$Digits', '$Panna',   '$total_amount',  
        '$date1' 
        )";
        // echo "<pre>"; print_r($sql);
        // echo "</pre>";
        // die;
        $post = $this->db->query($sql);
        

    if (!$post) 
        throw new Exception('Post does not exist for specified id');

    return $post;

       
    }
    // half sigma
   
    public function findGById($id)
    {
        $post = $this
            ->asArray()
            ->where(['g_id' => $id])
            ->first();

        if (!$post) 
            throw new Exception('Service does not exist for specified id');

        return $post;
    }
    public function findBById($id)
    {
        $post = $this
            ->asArray()
            ->where(['b_id' => $id])
            ->first();

        if (!$post) 
            throw new Exception('bid does not exist for specified id');

        return $post;
    }
    public function findUById($user_id)
    {
        $post = $this
            ->asArray()
            ->where(['user_id' => $user_id])
            ->findAll();

        if (!$post){
            return false;
        }else{
            return $post;

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
    public function deletedata($id)
    {
        $post = $this
            ->asArray()
            ->where(['b_id' => $id])
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

           $w_id = $data['w_id'];
           $total_am = $data['total_am'];
           $type = $data['t_type'];
           $status = $data['status'];
           
           $date = new DateTime();
           $date = date_default_timezone_set('Asia/Kolkata');
           $date1 = date("m-d-Y h:i A");
            $sql1 = "INSERT INTO `transactions`
            (`transaction_id`, `wallet_id`,`amount`, `type`,  `status`, `date`) 
            VALUES (NULL, '$w_id', '$total_am', '$type', '$status','$date1')";
              // echo "<pre>"; print_r($sql1);
           // echo "</pre>";
           // die();
           $post1 = $this->db->query($sql1);


    if (!$post1) 
        throw new Exception('Game does not save specified time');

    return $post1;

       
    }
   
    public function update_num($id ,$data): bool
    {

       // echo $id;

        if (empty($data)) {
            echo "1";
            return true;
        }
      
        $Open_Digits = $data['Open_Digits'];
        $Close_Digits = $data['Close_Digits'];
        $Jodi = $data['Jodi'];
        $Open_Panna = $data['Open_Panna'];
        $Close_Panna = $data['Close_Panna'];
        $sql = "UPDATE `s_bid_table` SET  
        Open_Digits= '$Open_Digits',Close_Digits= '$Close_Digits',Jodi= '$Jodi',Open_Panna= '$Open_Panna',
        Close_Panna= '$Close_Panna'
         WHERE b_id = $id";
        // echo "<pre>"; print_r($sql);
        // echo "</pre>";
        $post = $this->db->query($sql);
    if (!$post) 
        throw new Exception('Game does not exist for specified id');

    return $post;

       
    }
   
    


}