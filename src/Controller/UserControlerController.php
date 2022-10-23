<?php

namespace App\Controller;

use createHelper;
use SebastianBergmann\CodeCoverage\Report\Xml\Report;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class UserControlerController extends AbstractController
{
    
    // #[Route('/user/controler/{$id?}', name: 'app_user_controler')]
    // public function index(): Response
    // {
        
       

        
    //     return $this->render('user_controler/index.html.twig', [
    //         'user' => $users ?? [],
    //     ]);
    // }
    #[Route('/user/controller/{id?}', name: 'app_user_controler')]
    public function user_id(Request $request): Response 
    {
        $userId = $request->attributes->get('id');
        $url = 'https://gorest.co.in/public/v2/users/' . $userId;

        $curl = curl_init();
        curl_setopt_array($curl,[
            CURLOPT_URL => $url,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_RETURNTRANSFER => true,
        ]);

        $rawRespomse = curl_exec($curl);
        $info = curl_getinfo($curl);
        curl_close($curl);
        if($info['http_code']===200){
            $response = json_decode($rawRespomse,true);
            $users = $response;
        }

        return $this->render('user_controler/index.html.twig', [
            'user' => $users ?? [],
        ]);
    }
}
