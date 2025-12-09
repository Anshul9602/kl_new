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
class ResultModel extends Model
{
    protected $table = 'result_de';
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
        //  $user_id = $data['user_id'];
         $g_id = $data['g_id'];
         if($data['Session'] == 'open'){
            $date = new DateTime();
            $date = date_default_timezone_set('Asia/Kolkata');
            $date = date("m-d-Y h:i A");
            $open_date = $date;
            $result_date = date("m-d-Y");;
            $close_date = '';
            $Open_Panna = $data['Panna'];
            $Close_Panna = '';
         }else{
            
            $date = new DateTime();
            $date = date_default_timezone_set('Asia/Kolkata');
            $date = date("m-d-Y h:i A");
            $close_date = $date;
            $open_date = '';
            $result_date = date("m-d-Y");;
            $Close_Panna = $data['Panna'];
            $Open_Panna = '';
         }
         
        //  echo "<pre>"; print_r($data);
        //     echo "</pre>";
        //     die;
        // $date = date("m/d/Y h:i A");
        
        
        $sql = "INSERT INTO `result_de` (`re_id`,
        `g_id`, 
        `result_date`, 
        `open_date`, 
        `close_date`, 
        `Open_Panna`, 
        `Close_Panna`) VALUES (NULL,
        '$g_id', 
        '$result_date', 
        '$open_date', 
        '$close_date',
        '$Open_Panna', 
        '$Close_Panna' 
        )";
        // echo "<pre>"; print_r($sql);
        // echo "</pre>";
        // die;
        $post = $this->db->query($sql);
        

    if (!$post) 
        throw new Exception('Post does not exist for specified id');

    return $post;

       
    }
    public function update_open($id ,$data): bool
    {
        if (empty($data)) {
            echo "1";
            return true;
        }
        
       
           $date = new DateTime();
           $date = date_default_timezone_set('Asia/Kolkata');
           $date = date("m-d-Y h:i A");
           $open_date = $date;
         
           $Open_Panna = $data['Panna'];
          
      
        $sql = "UPDATE `result_de` SET  
        open_date= '$open_date',
        Open_Panna= '$Open_Panna'
        
         WHERE re_id = $id";
        // echo "<pre>"; print_r($sql);
        // echo "</pre>";
        // die();
        $post = $this->db->query($sql);
    if (!$post) 
        throw new Exception('Game does not exist for specified id');

    return $post;

       
    }
    public function update_close($id ,$data): bool
    {
        if (empty($data)) {
            echo "1";
            return true;
        }
        //   echo "<pre>"; print_r($data);
        //         echo "</pre>";
        //         die();
           $date = new DateTime();
           $date = date_default_timezone_set('Asia/Kolkata');
           $date = date("m-d-Y h:i A");
           $close_date = $date;
           $Close_Panna = $data['Panna'];
          $sql = "UPDATE `result_de` SET  
          close_date= '$close_date',
           Close_Panna= '$Close_Panna'
         WHERE re_id = $id";
        // echo "<pre>"; print_r($sql);
        // echo "</pre>";
        // die();
        $post = $this->db->query($sql);
    if (!$post) 
        throw new Exception('Game does not exist for specified id');

    return $post;

       
    }
    // half sigma

    // full sigma

    public function findGById1($id)
    {
        $post = $this
            ->asArray()
            ->where(['g_id' => $id])
            ->first();

        if (!$post) {
            return false;
        }else{
            return $post;
        }
          

        
    }
   
    public function findGById($id)
    {
        $post = $this
            ->asArray()
            ->where(['g_id' => $id])
            ->first();

        if (!$post) 
            throw new Exception('Result does not exist for specified id');

        return $post;
    }
    public function findlast($data)
    {
       
        $post = $this->asArray()
    ->where(['g_id' => $data['g_id'], 'result_date' => $data['date1']])
    ->first();


        if (!$post) 
            throw new Exception('Result does not exist for specified id');

        return $post;
    }
    public function findGByIdA($id)
    {
        $post = $this
            ->asArray()
            ->where(['g_id' => $id])
            ->findAll();

        // Return empty array if no results found instead of throwing exception
        if (empty($post)) {
            return [];
        }

        return $post;
    }
    public function findbydate($data)
    {
       $post =  $this->where('result_date', $data)->findAll();

        if (!$post) 
            throw new Exception('Result does not exist for specified date');

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
    public function deletedata1($id)
    {
        $close_date = '';
        $Close_Panna ='';
        $sql = "UPDATE `result_de` SET  
          close_date= '$close_date',
           Close_Panna= '$Close_Panna'
         WHERE re_id = $id";

           $post = $this->db->query($sql);
    if (!$post) 
        throw new Exception('Game does not exist for specified id');

    return $post;

    }
    public function deletedata2($id)
    {
        $open_date = '';
        $Open_Panna ='';
        $sql = "UPDATE `result_de` SET  
          open_date= '$open_date',
           Open_Panna= '$Open_Panna'
         WHERE re_id = $id";

           $post = $this->db->query($sql);
    if (!$post) 
        throw new Exception('Game does not exist for specified id');

    return $post;

    }
    public function deletedata($id)
    {
        $post = $this
            ->asArray()
            ->where(['re_id' => $id])
            ->delete();

        if (!$post) 
            throw new Exception('Service does not exist for specified id');

        return $post;
    }
}