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
class MethodModel extends Model
{
    protected $table = 'p_mathod';
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
        $name = $data['name'];
        $number = $data['number'];
        $ac_h_name = '';
        $ifsc = '';
        $b_name = '';
        $b_add = '';
        $date = new DateTime();
         $date = date_default_timezone_set('Asia/Kolkata');
        $date1 = date("m-d-Y h:i A");
        
        $sql = "INSERT INTO `p_mathod` (`pm_id`,`user_id`,`name`,`number`,`ac_h_name`,`ifsc`,`b_name`,`b_add`,`date`) VALUES (NULL, 
        '$user_id','$name','$number','$ac_h_name','$ifsc','$b_name','$b_add','$date1')";
        $post = $this->db->query($sql);
    if (!$post) 
        throw new Exception('Post does not exist for specified id');

    return $post; 
    }
    public function save_ac($data): bool
    {
        // echo json_encode($data);
        if (empty($data)) {
            echo "1";
            return true;
        } 
        $user_id = $data['user_id'];
        $name = $data['name'];
        $number = $data['number'];
        $ac_h_name = $data['ac_h_name'];
        $ifsc = $data['ifsc'];
        $b_name = $data['b_name'];
        $b_add = $data['b_add'];
        $date = new DateTime();
         $date = date_default_timezone_set('Asia/Kolkata');
        $date1 = date("m-d-Y h:i A");
        
        $sql = "INSERT INTO `p_mathod` (`pm_id`,`user_id`,`name`,`number`,`ac_h_name`,`ifsc`,`b_name`,`b_add`,`date`) VALUES (NULL, 
        '$user_id','$name','$number','$ac_h_name','$ifsc','$b_name','$b_add','$date1')";
        $post = $this->db->query($sql);
    if (!$post) 
        throw new Exception('Post does not exist for specified id');

    return $post; 
    }
    public function findPById($id)
    {
        echo "<pre>";
        print_r($id);
        echo "</pre>";
        $post = $this
            ->asArray()
            ->where(['pm_id' => $id])
            ->first();

        if (!$post) 
            throw new Exception('Method does not exist for specified id');

        return $post;
    }
    public function findUById($user_id)
    {
        // echo $user_id;
        // die();
        $post = $this
            ->asArray()
            ->where(['user_id' => $user_id])
            ->findAll();

            if (!$post) 
            throw new Exception('Method does not exist for specified id');

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
            ->where(['pm_id' => $id])
            ->delete();

        if (!$post) 
            throw new Exception('Service does not exist for specified id');

        return $post;
    }
    
   
  
    public function update_num($id ,$data): bool
    {

    // echo $id;

        if (empty($data)) {
            echo "1";
            return true;
        }
        $number = $data['number'];

        $sql = "UPDATE `p_mathod` SET  
          number = '$number';
         WHERE pm_id = $id";
        // echo "<pre>"; print_r($sql);
        // echo "</pre>";
        $post = $this->db->query($sql);
    if (!$post) 
        throw new Exception('Method does not exist for specified id');

    return $post;
    }
    public function update_ac($id ,$data): bool
    {
        if (empty($data)) {
            echo "1";
            return true;
        }
        
        $name = $data['name'];
        $number = $data['number'];
        $ac_h_name = $data['ac_h_name'];
        $ifsc = $data['ifsc'];
        $b_name = $data['b_name'];
        $b_add = $data['b_add'];
        $sql = "UPDATE `p_mathod` SET
           name = '$name',
        ac_h_name = '$ac_h_name',
        ifsc = '$ifsc',
        b_name = '$b_name',
        b_add = '$b_add',
        number= '$number'
         WHERE pm_id = $id ";
        //  echo "<pre>"; print_r($sql);
        //  echo "</pre>";
        //  die();
        $post = $this->db->query($sql);
      echo json_encode($post);
    if (!$post) 
        throw new Exception('Game does not exist for specified id');
    return $post;

       
    }
    
   
   


}