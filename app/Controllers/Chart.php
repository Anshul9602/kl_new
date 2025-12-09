<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PostModel;
use App\Models\ResultModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
use \Datetime;

use ReflectionException;
class Chart extends BaseController
{
    public function index($g_id = null)
    {
        $model = new PostModel();
        $model1 = new ResultModel();
        
        // If no game ID provided, redirect to home or show error
        if ($g_id === null) {
            return redirect()->to('/');
        }

        // Get game information
        try {
            $gameInfo = $model->findPostById($g_id);
            $data['tt'] = $gameInfo['g_title'];
            $data['tth'] = $gameInfo['g_name_hindi'];
        } catch (Exception $e) {
            return redirect()->to('/')->with('error', 'Game not found');
        }

        // Get all results for this game
        $data['post'] = array();
        
        try {
            $results = $model1->findGByIdA($g_id);
        } catch (Exception $e) {
            // No results found for this game - that's okay, just show empty chart
            $results = [];
        }
        
        if (!empty($results)) {
            foreach ($results as $result) {
                $open = '***';
                $close = '***';
                $start = "*";
                $end = "*";
                
                if ($result['Open_Panna']) {
                    $open = $result['Open_Panna'];
                    $start = 0;
                    for ($i = 0; $i < strlen($open); $i++) {
                        $start += intval($open[$i]);
                    }
                }
                
                if ($result['Close_Panna']) {
                    $close = $result['Close_Panna'];
                    $end = 0;
                    for ($i = 0; $i < strlen($close); $i++) {
                        $end += intval($close[$i]);
                    }
                }
                
                // Calculate start digit
                $sumDigits1 = str_split((string)$start);
                if (count($sumDigits1) > 1) {
                    $start1 = intval($sumDigits1[1]); // Second digit
                } else {
                    $start1 = $start;
                }
                
                // Calculate end digit
                $sumDigits = str_split((string)$end);
                if (count($sumDigits) > 1) {
                    $end1 = intval($sumDigits[1]); // Second digit
                } else {
                    $end1 = $end;
                }
                
                $data['post'][] = array(
                    'result_date' => $result['result_date'],
                    'open_num' => $open,
                    'close_num' => $close,
                    'start' => $start1,
                    'end' => $end1
                );
            }
        }
        
        return view('chart', $data);
    }
    
   
    
}
