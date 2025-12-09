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
class TransactionModel extends Model
{
    protected $table = 'transactions';
    // protected $allowedFields = [
    //     'name',
    //     'email',
    //     'retainer_fee'
    // ];
    protected $db;
    protected $updatedField = 'updated_at';


    public function findTById($id)
    {

        $post = $this
            ->asArray()
            ->where(['wallet_id' => $id])
            ->findAll();

        if (!$post)
            throw new Exception('tranziction does not exist for specified id');

        return $post;
    }
    public function findTById1($id)
    {

        $post = $this
            ->asArray()
            ->where(['wallet_id' => $id])
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
            // echo $eventData;
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
            ->where(['wallet_id' => $id])
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
    public function update1($id, $data): bool
    {

        // echo $id;

        if (empty($data)) {
            echo "1";
            return true;
        }
        $g_title = $data['g_title'];

        $status = $data['status'];

        $sql = "UPDATE `wallet` SET  
        g_title= '$g_title'
       
         WHERE g_id = $id";

        $post = $this->db->query($sql);
        if (!$post)
            throw new Exception('Game does not exist for specified id');

        return $post;
    }
    public function update_am($id, $data): bool
    {

        // echo $id;

        if (empty($data)) {
            echo "1";
            return true;
        }
        $total_am = $data['total_am'];

        $sql = "UPDATE `wallet` SET  
        total_amount= '$total_am',
         WHERE user_id = $id";

        $post = $this->db->query($sql);
        if (!$post)
            throw new Exception('Game does not exist for specified id');

        return $post;
    }
    public function updatepub($id, $data): bool
    {

        // echo $id;

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

    public function get_drafts($published)
    {

        $post = $this
            ->asArray()
            ->where(['published' => $published])
            ->findAll();

        if (!$post)
            throw new Exception('Post does not exist for specified id');

        return $post;
    }

    public function curPostRequest()
    {
        /* Endpoint */
        $url = 'https://fcm.googleapis.com/fcm/send';

        /* eCurl */
        $curl = curl_init($url);

        /* Data */
        $data = [
            'name' => 'John Doe',
            'email' => 'johndoe@yahoo.com'
        ];

        /* Set JSON data to POST */
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        /* Define content type */
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type:application/json',
            'App-Key: JJEK8L4',
            'App-Secret: 2zqAzq6'
        ));

        /* Return json */
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        /* make request */
        $result = curl_exec($curl);

        /* close curl */
        curl_close($curl);
    }
}
