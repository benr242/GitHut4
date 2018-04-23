<?php
/**
 * Created by PhpStorm.
 * User: benr242
 * Date: 4/16/18
 * Time: 7:18 PM
 */

namespace App\Controller;


use App\Service\GitHubApi;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class GitHutController extends Controller
{
    private $username;
    
    /**
     * @Route("/{username}", name="default", defaults={"username"="benr242"})
     */
    public function githutAction(Request $request, GitHubApi $api, $username = "benr242", LoggerInterface $logger)
    {
        dump($username);
        $logger->info(json_encode('username::GitHut: ' . $username));

        return $this->render('githut/index.html.twig', [
            'username' => $username
        ]);

    }

    /**
     * @Route("/index", name="index")
     */
    public function intex()
    {
        return $this->render('githut/index.html.twig');
    }
}