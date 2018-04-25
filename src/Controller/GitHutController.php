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
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class GitHutController extends AbstractController
{
    private $username;

    /**
     * @Route("/user/{username}", name="user", defaults={"username"="codereviewvideos"})
     */
    public function githutAction(Request $request, GitHubApi $api, $username, LoggerInterface $logger)
    {
        dump($username);
        $logger->info(json_encode('username::GitHut: ' . $username));

        $profile = $api->getProfile($username);
        $repos = $api->getRepos($username);


        return $this->render('githut/index.html.twig', [
            'username' => $username,
            'profile' => $profile,
            'repos' => $repos
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