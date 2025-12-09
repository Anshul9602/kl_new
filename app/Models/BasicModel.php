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
class BasicModel extends Model
{
    protected $table = 'basic_table';
    // protected $allowedFields = [
    //     'name',
    //     'email',
    //     'retainer_fee'
    // ];
    protected $db;
    protected $updatedField = 'updated_at';

  
  
    
    
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

   
    public function update_num($id,$data): bool
    {

       // echo $id;

        if (empty($data)) {
            echo "1";
            return true;
        }
      
        $whatsapp = $data['whatsapp'];
        $ac_holder_name = $data['ac_holder_name'];
        $ac_number = $data['ac_number'];
        $ifse_code = $data['ifse_code'];
        $app_link = $data['app_link'];
        $share_msg = $data['share_msg'];
        $am_share_msg = $data['am_share_msg'];
        $am_show = $data['am_show'];
        $max_add = $data['max_add'];
        $max_wd = $data['max_wd'];
        $min_tran = $data['min_tran'];
        $max_tran = $data['max_tran'];
        $min_bid = $data['min_bid'];
        $max_bid = $data['max_bid'];
        $well_bonus = $data['well_bonus'];
        $wd_open = $data['wd_open'];
        $wd_close = $data['wd_close'];
        $telegram = $data['telegram'];
        $min_wd = $data['min_wd'];
        $min_add = $data['min_add'];
        $upi_id = $data['upi_id'];
        $trans_id = $data['trans_id'];
        $m_name = $data['m_name'];
        $email = $data['email'];
        $global_batting = $data['global_batting'];
        $merchant_code = $data['merchant_code'];
        
        $sql = "UPDATE `basic_table` SET  
        whatsapp= '$whatsapp',
        ac_holder_name= '$ac_holder_name',
        ac_number= '$ac_number',
        ifse_code= '$ifse_code',
        app_link= '$app_link',
        share_msg= '$share_msg',
        am_share_msg= '$am_share_msg',
        am_show= '$am_show',
        max_add= '$max_add',
        max_wd= '$max_wd',
        min_tran= '$min_tran',
        max_tran= '$max_tran',
        min_bid= '$min_bid',
        max_bid= '$max_bid',
        well_bonus= '$well_bonus',
        wd_open= '$wd_open',
        wd_close= '$wd_close',
        email= '$email',
        telegram= '$telegram',
        min_wd= '$min_wd',
        min_add= '$min_add',
        upi_id= '$upi_id',
        trans_id= '$trans_id',
        m_name= '$m_name',
        global_batting= '$global_batting',
        merchant_code= '$merchant_code'
       
         WHERE bs_id = 1";
        // echo "<pre>"; print_r($sql);
        // echo "</pre>";
        $post = $this->db->query($sql);
    if (!$post) 
        throw new Exception('basic detals does not exist for specified id');

    return $post;

       
    }
    public function rate()
    {

       // echo $id;
       $sql = "SELECT * FROM `g_rate`";
       $query = $this->db->query($sql);
       $result = $query->getResult();
   
       if (empty($result)) {
           throw new Exception('No data found in g_rate table.');
       }
   
       return $result;
    }
    public function rates()
    {

       // echo $id;
       $sql = "SELECT * FROM `gs_rate`";
       $query = $this->db->query($sql);
       $result = $query->getResult();
   
       if (empty($result)) {
           throw new Exception('No data found in g_rate table.');
       }
   
       return $result;
    }
    public function rate_u($data)
    {
       $Single_Digit_Point = $data['Single_Digit_Point'];
       $Single_Digit_Amount = $data['Single_Digit_Amount'];
       $Jodi_Digit_Point = $data['Jodi_Digit_Point'];
       $Jodi_Digit_Amount = $data['Jodi_Digit_Amount'];
       $Single_Panna_Point = $data['Single_Panna_Point'];
       $Single_Panna_Amount = $data['Single_Panna_Amount'];
       $Double_Panna_Point = $data['Double_Panna_Point'];
       $Double_Panna_Amount = $data['Double_Panna_Amount'];
       $Tripple_Panna_Point = $data['Tripple_Panna_Point'];
       $Tripple_Panna_Amount = $data['Tripple_Panna_Amount'];
       $Half_Sangam_Point = $data['Half_Sangam_Point'];
       $Half_Sangam_Amount = $data['Half_Sangam_Amount'];
       $Full_Sangam_Point = $data['Full_Sangam_Point'];
       $Full_Sangam_Amount = $data['Full_Sangam_Amount'];
       // echo $id;
       $sql = "UPDATE `g_rate` SET `Single_Digit_Point`='$Single_Digit_Point',`Single_Digit_Amount`='$Single_Digit_Amount',`Jodi_Digit_Point`='$Jodi_Digit_Point',`Jodi_Digit_Amount`='$Jodi_Digit_Amount',`Single_Panna_Point`='$Single_Panna_Point',`Single_Panna_Amount`='$Single_Panna_Amount',`Double_Panna_Point`='$Double_Panna_Point',`Double_Panna_Amount`='$Double_Panna_Amount',`Tripple_Panna_Point`='$Tripple_Panna_Point',`Tripple_Panna_Amount`='$Tripple_Panna_Amount',`Half_Sangam_Point`='$Half_Sangam_Point',`Half_Sangam_Amount`='$Half_Sangam_Amount',`Full_Sangam_Point`='$Full_Sangam_Point',`Full_Sangam_Amount`='$Full_Sangam_Amount' WHERE 'gr_id' = 1";

       $post = $this->db->query($sql);
      
   
       if (empty($post)) {
           throw new Exception('No data found in g_rate table.');
       }
   
       return $post;
    }
    public function rates_u($data)
    {
       $Single_Digit_Point = $data['Single_Digit_Point'];
       $Single_Digit_Amount = $data['Single_Digit_Amount'];
      
       $Single_Panna_Point = $data['Single_Panna_Point'];
       $Single_Panna_Amount = $data['Single_Panna_Amount'];
       $Double_Panna_Point = $data['Double_Panna_Point'];
       $Double_Panna_Amount = $data['Double_Panna_Amount'];
       $Tripple_Panna_Point = $data['Tripple_Panna_Point'];
       $Tripple_Panna_Amount = $data['Tripple_Panna_Amount'];
       
       // echo $id;
       $sql = "UPDATE `gs_rate` SET `Single_Digit_Point`='$Single_Digit_Point',`Single_Digit_Amount`='$Single_Digit_Amount',`Single_Panna_Point`='$Single_Panna_Point',`Single_Panna_Amount`='$Single_Panna_Amount',`Double_Panna_Point`='$Double_Panna_Point',`Double_Panna_Amount`='$Double_Panna_Amount',`Tripple_Panna_Point`='$Tripple_Panna_Point',`Tripple_Panna_Amount`='$Tripple_Panna_Amount' WHERE 'grs_id' = 1";
     echo "<pre>"; print_r($sql);
        echo "</pre>";
       $post = $this->db->query($sql);
      
   
       if (empty($post)) {
           throw new Exception('No data found in gs_rate table.');
       }
   
       return $post;
    }
   
   

       
   
   
   

}