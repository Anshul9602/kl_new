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
class BidModel extends Model
{
    protected $table = 'bid_table';
    // protected $allowedFields = [
    //     'name',
    //     'email',
    //     'retainer_fee'
    // ];
    protected $db;
    protected $updatedField = 'updated_at';
    public function getbdData()
    {
        // $builder = $this->db->table('bid_table');
        // $builder->select('*');
        // $builder->join('user_log', 'bid_table.user_id = user_log.user_id', 'inner');
        // $builder->join('g_service', 'g_service.g_id = bid_table.g_id', 'inner');
        // $builder->join('gn_type', 'gn_type.gt_id = bid_table.gt_id', 'inner');
        $builder = $this->db->table('bid_table');
        $builder->select('bid_table.*, g_service.*, gn_type.*, user_log.user_id, user_log.user_name'); // Replace 'some_other_columns' with the actual columns you need from user_log
        $builder->join('user_log', 'bid_table.user_id = user_log.user_id', 'inner');
        $builder->join('g_service', 'g_service.g_id = bid_table.g_id', 'inner');
        $builder->join('gn_type', 'gn_type.gt_id = bid_table.gt_id', 'inner');

        $query = $builder->get();
        $result = $query->getResult();

        if (empty($result)) {
            throw new Exception('No data found in joined tables.');
        }

        return $result;
    }
    public function sgetbdData()
    {
        $builder = $this->db->table('s_bid_table');
        $builder->select('*');
        $builder->join('user_log', 's_bid_table.user_id = user_log.user_id', 'inner');
        $builder->join('gs_service', 'gs_service.g_id = s_bid_table.g_id', 'inner');
        $builder->join('gn_type', 'gn_type.gt_id = s_bid_table.gt_id', 'inner');


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

        // single
        if ($data['gt_id'] == 1) {

            if ($data['session'] == 'open') {
                $Open_Digits = $data['number'];
            } else {
                $Open_Digits = '';
            }
            if ($data['session'] == 'close') {
                $Close_Digits = $data['number'];
            } else {
                $Close_Digits = '';
            }
        } else {
            $Close_Digits = '';
            $Open_Digits = '';
        }

        // jodi
        if ($data['gt_id'] == 2) {

            $Jodi = $data['number'];
        } else {

            $Jodi = '';
        }
        // panna
        if ($data['gt_id'] == 3) {

            if ($data['session'] == 'open') {

                $Open_Panna = $data['number'];
            } else {
                $Open_Panna = '';
            }

            if ($data['session'] == 'close') {
                $Close_Panna = $data['number'];
            } else {
                $Close_Panna = '';
            }
        } else {

            $Close_Panna = '';
            $Open_Panna = '';
        }
      
        if ($data['gt_id'] == 4) {
            if ($data['session'] == 'open') {
                $Open_Panna = $data['number'];
            } else {
                $Open_Panna = '';
            }
            if ($data['session'] == 'close') {
                $Close_Panna = $data['number'];
            } else {
                $Close_Panna = '';
            }
        }
        if ($data['gt_id'] == 5) {
            if ($data['session'] == 'open') {
                $Open_Panna = $data['number'];
            } else {
                $Open_Panna = '';
            }
            if ($data['session'] == 'close') {
                $Close_Panna = $data['number'];
            } else {
                $Close_Panna = '';
            }
        } 

        // secction 
        if ($data['session']) {

            $session = $data['session'];
        } else {

            $session = '';
        }
        $user_id = $data['user_id'];
        $g_id = $data['g_id'];
        $gt_id = $data['gt_id'];
        // echo "<pre>"; print_r($Open_Panna);
        // echo "</pre>";
        // die();
        $total_amount = $data['total_amount'];

        $date = date("m/d/Y h:i A");
        $date = new DateTime();
        $date = date_default_timezone_set('Asia/Kolkata');

        $date1 = date("m-d-Y h:i A");

        $sql = "INSERT INTO `bid_table` (`b_id`, 
        `user_id`, 
        `g_id`, 
        `gt_id`, 
        `session`, 
        `Open_Digits`, 
        `Close_Digits`, 
        `Jodi`, 
        `Open_Panna`, 
        `Close_Panna`, 
        `total_amount`,  
       
        `date`) VALUES (NULL, 
        '$user_id', 
        '$g_id', 
        '$gt_id', 
        '$session', 
        '$Open_Digits', 
        '$Close_Digits', 
        '$Jodi', 
        '$Open_Panna', 
        '$Close_Panna', 
        '$total_amount',  
        '$date1' 
        )";
        // echo "<pre>";
        // print_r($sql);
        // echo "</pre>";
        // die;
        $post = $this->db->query($sql);


        if (!$post)
            throw new Exception('Post does not exist for specified id');

        return $post;
    }
    // half sigma
    public function save6($data): bool
    {
        if (empty($data)) {
            echo "1";
            return true;
        }
        if ($data['session'] == 'open') {
            $Open_Digits = $data['number'];
            $Close_Panna = $data['close_digits'];
            $Close_Digits ='';
            $Open_Panna = '';
        }elseif ($data['session'] == 'close') {
            $Close_Digits = $data['number'];
            $Open_Panna = $data['close_digits'];
            $Open_Digits = '';
            $Close_Panna = '';
        } else {
            $Close_Panna = '';
            $Open_Panna = '';
            $Open_Digits = '';
            $Close_Digits = '';
        }

       
        $Jodi = '';
        // secction 
        if ($data['session']) {
            $session = $data['session'];
        } else {
            $session = '';
        }
        $user_id = $data['user_id'];
        $g_id = $data['g_id'];
        $gt_id = $data['gt_id'];

        $total_amount = $data['total_amount'];


        $date = new DateTime();
        $date = date_default_timezone_set('Asia/Kolkata');

        $date1 = date("m-d-Y h:i A");
        $sql = "INSERT INTO `bid_table` (`b_id`, 
        `user_id`,`g_id`, `gt_id`, `session`, `Open_Digits`,`Close_Digits`,`Jodi`,`Open_Panna`,`Close_Panna`, 
        `total_amount`,`date`) VALUES (NULL,'$user_id','$g_id','$gt_id','$session','$Open_Digits','$Close_Digits', 
        '$Jodi','$Open_Panna','$Close_Panna','$total_amount','$date1')";
        // echo "<pre>"; print_r($sql);
        // echo "</pre>";
        // die;
        $post = $this->db->query($sql);


        if (!$post)
            throw new Exception('Post does not exist for specified id');

        return $post;
    }

    // full sigma
    public function save7($data): bool
    {
        if (empty($data)) {
            echo "1";
            return true;
        }
        $Close_Digits = '';
        $Open_Digits = '';
        $Jodi = '';
        $Open_Panna = $data['number'];
        $Close_Panna = $data['close_digits'];

        if ($data['session']) {
            $session = $data['session'];
        } else {
            $session = '';
        }
        $user_id = $data['user_id'];
        $g_id = $data['g_id'];
        $gt_id = $data['gt_id'];
        $total_amount = $data['total_amount'];
        $date = new DateTime();
        $date = date_default_timezone_set('Asia/Kolkata');
        $date1 = date("m-d-Y h:i A");
        $sql = "INSERT INTO `bid_table` (`b_id`, 
        `user_id`, 
        `g_id`, 
        `gt_id`, 
        `session`, 
        `Open_Digits`, 
        `Close_Digits`, 
        `Jodi`, 
        `Open_Panna`, 
        `Close_Panna`, 
        `total_amount`,   
        `date`) VALUES (NULL, 
        '$user_id', 
        '$g_id', 
        '$gt_id', 
        '$session', 
        '$Open_Digits', 
        '$Close_Digits', 
        '$Jodi', 
        '$Open_Panna', 
        '$Close_Panna', 
        '$total_amount',  
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
    public function findGByIdA($id)
    {
        $post = $this
            ->asArray()
            ->where(['g_id' => $id])
            ->findAll();

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

        if (!$post) {
            return false;
        } else {
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

            if (!empty($eventData['returnData'])) {
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

    public function update_num($id, $data): bool
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
        $sql = "UPDATE `bid_table` SET  
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
