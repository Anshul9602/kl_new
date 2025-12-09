<?php

namespace App\Controllers;


use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;


use ReflectionException;
class Contact extends BaseController
{
    public function index()
    {
        
        return view('contact');
    }
    
   
   
}
