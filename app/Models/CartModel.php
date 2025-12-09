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
class CartModel extends Model
{
    protected $table = 'wallet';
    // protected $allowedFields = [
    //     'name',
    //     'email',
    //     'retainer_fee'
    // ];
    protected $db;
    protected $updatedField = 'updated_at';

    public function save($data): bool
    {
        // echo json_encode($data);
        if (empty($data)) {
            echo "1";
            return true;
        } 
        $user_id = $data['user_id'];
        $total_amount = $data['total_am'];
        $status = $data['status'];
        $date = new DateTime();
         $date = date_default_timezone_set('Asia/Kolkata');
        $date1 = date("m-d-Y h:i A");
        
        $sql = "INSERT INTO `wallet` (`wallet_id`, 
        `user_id`, 
        `total_amount`,  
        `status`, 
        `date`) VALUES (NULL, 
        '$user_id', 
        '$total_amount',  
        '$status', 
        '$date1' 
        )";
        $post = $this->db->query($sql);

        $post1 = $this->findUById($user_id);
        $data1['w_id'] = $post1['wallet_id'];
        $data1['t_type'] = 1;
        $data1['total_am'] = $data['total_am'];
        $data1['t_for'] = 'bonus';
        $this->activity($data1);
    if (!$post) 
        throw new Exception('Post does not exist for specified id');

    return $post;

       
    }
    public function save_com($data): bool
    {
        // echo json_encode($data);
        if (empty($data)) {
            echo "1";
            return true;
        } 
        $user_id = $data['user_id'];
        $msg = $data['msg'];
        $date = new DateTime();
         $date = date_default_timezone_set('Asia/Kolkata');
        $date1 = date("m-d-Y h:i A");
        
        $sql = "INSERT INTO `complant` (`cm_id`, 
        `user_id`, 
        `msg`,  
        `date`) VALUES (NULL, 
        '$user_id', 
        '$msg',  
        '$date1' 
        )";
        $post = $this->db->query($sql);

        
    if (!$post) 
        throw new Exception('Post does not exist for specified id');

    return $post;

       
    }
    public function get_com()
    {
        // echo json_encode($data);
        
        $builder = $this->db->table('complant');
        $builder->select('*');
        $builder->join('user_log', 'complant.user_id = user_log.user_id', 'inner');
        $query = $builder->get();
        $result = $query->getResult();
    
        if (empty($result)) {
            throw new Exception('No data found in joined tables.');
        }
    
        return $result;
        
       
        

       
    }
    public function findWById($id)
    {
        $post = $this
            ->asArray()
            ->where(['wallet_id' => $id])
            ->first();

        if (!$post) 
            throw new Exception('Service does not exist for specified id');

        return $post;
    }
    public function findUById($user_id)
    {
        
        $post = $this
            ->asArray()
            ->where(['user_id' => $user_id])
            ->first();

            if (!$post) 
            throw new Exception('wallet does not exist for specified id');
// echo $post;
//         die();
        return $post;

        
    }
    public function findUById1($user_id)
    {
        // echo $user_id;
        // die();
        $post = $this
            ->asArray()
            ->where(['user_id' => $user_id])
            ->first();

        if (!$post){
            return false;
        } 
        else{
            return true;
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
            ->where(['wallet_id' => $id])
            ->delete();

        if (!$post) 
            throw new Exception('Service does not exist for specified id');

        return $post;
    }
    public function deletedata1($id)
    {
        $post = $this
            ->asArray()
            ->where(['user_id' => $id])
            ->delete();

        if (!$post) 
            throw new Exception('walle does not exist for specified user id');

        return $post;
    }
    
   
    public function activity($data): bool
    {
        if (empty($data)) {
            echo "1";
            return true;
        }

      
            $t_for = $data['t_for'];
           

        //    echo json_encode($data);
        //    die();

           $w_id = $data['w_id'];
           $total_am = $data['total_am'];
           $type = $data['t_type'];
           $status = 1;
           $date = new DateTime();
           $date = date_default_timezone_set('Asia/Kolkata');
           $date1 = date("m-d-Y h:i A");
           
            $sql1 = "INSERT INTO `transactions`
            (`transaction_id`, `wallet_id`,`amount`, `type`,`t_for`,  `status`, `date`) 
            VALUES (NULL, '$w_id', '$total_am', '$type','$t_for', '$status','$date1')";
            //  echo "<pre>"; print_r($sql1);
            //                     echo "</pre>";
            //                     die;
           $post1 = $this->db->query($sql1);
    if (!$post1) 
        throw new Exception('Game does not save specified time');

    return $post1;

       
    }
    public function update1($id ,$data): bool
    {

    // echo $id;
    // die();

        if (empty($data)) {
            echo "1";
            return true;
        }
        $total_am = $data;
        $sql = "UPDATE `wallet` SET  
       total_amount= '$total_am'
         WHERE user_id = $id";
        // echo "<pre>"; print_r($sql);
        // echo "</pre>";
        // die();
        $post = $this->db->query($sql);
    if (!$post) 
        throw new Exception('Game does not exist for specified id');

    return $post;
    }
    public function add_wd($id ,$data): bool
    {
        if (empty($data)) {
            echo "1";
            return true;
        }
         
        $w_id = $id;
        $pm_id = $data['pm_id'];
        $total_am = $data['total_am'];
        $status_wd = 0;
        $date = new DateTime();
        $date = date_default_timezone_set('Asia/Kolkata');
        $date1 = date("m-d-Y h:i A");
       
        $sql = "INSERT INTO `widrow`
            (`wd_id`, `wallet_id`,`amount`, `pm_id`, `status_wd`, `date`) 
            VALUES (NULL, '$w_id', '$total_am','$pm_id', '$status_wd','$date1')";
            //   echo "<pre>"; print_r($sql);
            //   echo "</pre>";
            //   die();
        $post = $this->db->query($sql);
    //   echo json_encode($post);
    if (!$post) 
        throw new Exception('widrow not exist for specified id');
    return $post;

       
    }
    public function wd_all()
    {
      
         
        $sql = "SELECT * FROM `widrow`";
        $query = $this->db->query($sql);
        $result = $query->getResult();
    
        if (empty($result)) {
            throw new Exception('No data found in widrow table.');
        }
    
        return $result;
      
   
       
    }
    public function getwdData()
    {
    $builder = $this->db->table('widrow');
    $builder->select('*');
    $builder->join('wallet', 'widrow.wallet_id = wallet.wallet_id', 'inner');
    $builder->join('p_mathod', 'p_mathod.pm_id = wallet.wallet_id', 'inner');
    $builder->join('user_log', 'wallet.user_id = user_log.user_id', 'inner');

    $query = $builder->get();
    $result = $query->getResult();

    if (empty($result)) {
        throw new Exception('No data found in joined tables.');
    }

    return $result;
    }
    public function getuwdData($id)
    {
    $builder = $this->db->table('widrow');
    $builder->select('*');
    $builder->join('wallet', 'widrow.wallet_id = wallet.wallet_id', 'inner');
    $builder->join('p_mathod', 'p_mathod.pm_id = wallet.wallet_id', 'inner');
    $builder->join('user_log', 'wallet.user_id = user_log.user_id', 'inner');
    $builder->where('widrow.wallet_id', 1);
    $query = $builder->get();
    $result = $query->getResult();

    if (empty($result)) {
        throw new Exception('No data found in joined tables.');
    }

    return $result;
    }
    public function wdDataForWallet($walletId)
{
    $builder = $this->db->table('widrow');
    $builder->select('*');
   
    
    $builder->where('widrow.wallet_id', $walletId);

    $query = $builder->get();
    $result = $query->getResult();

    if (empty($result)) {
        throw new Exception('No data found for wallet_id ' . $walletId);
    }

    return $result;
}

    

   
    public function wd_give($id,$data): bool
    {
      
         
        $status = $data['status_wd'];
        $sql = "UPDATE `widrow` SET  
        status_wd = '$status'
         WHERE wd_id = $id ";
            //   echo "<pre>"; print_r($sql);
            //   echo "</pre>";
            //   die();
        $post = $this->db->query($sql);
      
    if (!$post) 
        throw new Exception('widrow not exist for specified id');
    return $post;

       
    }
    public function update_am($id ,$data): bool
    {
// echo $data;
// die();

        // if (empty($data)) {

        //     echo "yes";
        //     echo "1";
        //     return true;
        // }
        
        $total_am = $data;
        $sql = "UPDATE `wallet` SET  
        total_amount= '$total_am'
         WHERE wallet_id = $id ";
        // echo "<pre>"; print_r($sql);
        //     echo "</pre>";
        //     die();
        $post = $this->db->query($sql);
    //   echo json_encode($post);
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
        $sql = "UPDATE `wallet` SET  status= '$status' WHERE wallet_id = $id";
        $post = $this->db->query($sql);
    if (!$post) 
        throw new Exception('wallet does not exist for specified id');

    return $post;

       
    }
   
    


}