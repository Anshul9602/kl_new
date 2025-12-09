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
class WinModel extends Model
{
    protected $table = 'win_table';
    // protected $allowedFields = [
    //     'name',
    //     'email',
    //     'retainer_fee'
    // ];
    protected $db;
    protected $updatedField = 'updated_at';
    public function getwinData()
    {
        $builder = $this->db->table('win_table');
        $builder->select('*');
        $builder->join('user_log', 'win_table.user_id = user_log.user_id', 'inner');
        $builder->join('bid_table', 'bid_table.b_id = win_table.b_id', 'inner');
        $builder->join('gn_type', 'gn_type.gt_id = bid_table.gt_id', 'inner');
        $builder->join('g_service', 'g_service.g_id = bid_table.g_id', 'inner');
       
    
        $query = $builder->get();
        $result = $query->getResult();
    
        if (empty($result)) {
            throw new Exception('No data found in joined tables.');
        }
    
        return $result;
    }
    public function getwinuData($id)
    {
        $builder = $this->db->table('win_table');
        $builder->select('*');
        $builder->join('user_log', 'win_table.user_id = user_log.user_id', 'inner');
        $builder->join('bid_table', 'bid_table.b_id = win_table.b_id', 'inner');
        $builder->join('gn_type', 'gn_type.gt_id = bid_table.gt_id', 'inner');
        $builder->join('g_service', 'g_service.g_id = bid_table.g_id', 'inner');
        $builder->where('win_table.user_id', $id);
    
        $query = $builder->get();
        $result = $query->getResult();
    
        if (empty($result)) {
            throw new Exception('No data found in joined tables.');
        }
    
        return $result;
    }
    public function sgetwinuData($id)
    {
        $builder = $this->db->table('swin_table');
        $builder->select('*');
        $builder->join('user_log', 'swin_table.user_id = user_log.user_id', 'inner');
        $builder->join('s_bid_table', 's_bid_table.b_id = swin_table.b_id', 'inner');
        $builder->join('gn_type', 'gn_type.gt_id = s_bid_table.gt_id', 'inner');
        $builder->join('gs_service', 'gs_service.g_id = s_bid_table.g_id', 'inner');
        $builder->where('swin_table.user_id', $id);
    
        $query = $builder->get();
        $result = $query->getResult();
    
        if (empty($result)) {
            throw new Exception('No data found in joined tables.');
        }
    
        return $result;
    }
   
    public function save($data): bool
    {
        if (empty($data)) {
            echo "1";
            return true;
        }
        
        //  // single
        // echo 'yes';
        // die();
         $user_id = $data['user_id'];
         $b_id = $data['b_id'];
         $re_id = $data['re_id'];
         $session = $data['session'];
         $total_amount = $data['total_amount'];
         $win_amount = $data['win_amount'];
        
        $date = date("m/d/Y h:i A");
         $date = new DateTime();
         $date = date_default_timezone_set('Asia/Kolkata');
    
         $date1 = date("m-d-Y h:i A");
        
        $sql = "INSERT INTO `win_table` (`win_id`,`user_id`,`b_id`,`re_id`,`session`, `total_amount`,  `win_amount`,`date`) VALUES (NULL, '$user_id','$b_id','$re_id','$session', '$total_amount','$win_amount', '$date1')";
        // echo "<pre>"; print_r($sql);
        // echo "</pre>";
        // die;
        $post = $this->db->query($sql);
        //  echo "<pre>"; print_r($post);
        // echo "</pre>";
        // die;

    if (!$post) 
        throw new Exception('Post does not exist for specified id');

    return $post;

       
    }

// for star line
    public function ssave($data): bool
    {
        if (empty($data)) {
            echo "1";
            return true;
        }
        
        //  // single
        // echo 'yes';
        // die();
         $re_id = $data['re_id'];
         $user_id = $data['user_id'];
         $b_id = $data['b_id'];
         $re_id = $data['re_id'];
         $session = $data['session'];
         $total_amount = $data['total_amount'];
         $win_amount = $data['win_amount'];
        
        $date = date("m/d/Y h:i A");
         $date = new DateTime();
         $date = date_default_timezone_set('Asia/Kolkata');
    
         $date1 = date("m-d-Y h:i A");
        
        $sql = "INSERT INTO `swin_table` (`swin_id`,`user_id`,`re_id`,`b_id`,`re_id`,`session`, `total_amount`,  `win_amount`,`date`) VALUES (NULL, '$user_id','$re_id','$b_id','$re_id','$session', '$total_amount','$win_amount', '$date1')";
        // echo "<pre>"; print_r($sql);
        // echo "</pre>";
        // die;
        $post = $this->db->query($sql);
        //  echo "<pre>"; print_r($post);
        // echo "</pre>";
        // die;

    if (!$post) 
        throw new Exception('Post does not exist for specified id');

    return $post;

       
    }
  
    public function findBById($id)
    {
        $post = $this
            ->asArray()
            ->where(['b_id' => $id])
            ->first();

        if (!$post) 
            throw new Exception('win does not exist for specified bid id'.$id);

        return $post;
    }
    public function findBByIdAd($id)
    {
        $post = $this
            ->asArray()
            ->where(['b_id' => $id])
            ->first();

        if (!$post){
         return false;
        }else{
            return $post;
        } 
            

       
    }
    public function findReById($id)
    {
        $post = $this
            ->asArray()
            ->where(['re_id' => $id])
            ->findAll();

        if (!$post){
            return false;
        }else{
            return $post;
        } 
           

        
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
            ->where(['win_id' => $id])
            ->delete();

        if (!$post) 
            throw new Exception('win does not exist for specified id');

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
   
   
    

}