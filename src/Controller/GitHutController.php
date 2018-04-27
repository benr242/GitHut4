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

    public function __construct(GitHubApi $capi)
    {
        $this->api=$capi;
    }

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


    /**
     * @Route("/profile/{username}", name="profile", defaults={ "username": "codereviewvideos" })
     */
    //public function profile(Request $request, GitHubApi $api, $username, LoggerInterface $logger)
    public function profile($username, GitHubApi $api, LoggerInterface $logger)
    {
        //$logger->info(json_encode('username::GitHut:profile: ' . $username));
        $logger->info("****************" . get_class($logger) . "*****************************");
        $profileData = $api->getProfile($username);
        return $this->render('githut/profile.html.twig', $profileData);
    }

    /**
     * @Route("/repos/{username}", name="repos", defaults={ "username": "codereviewvideos" })
     */
    //public function repos(Request $request, GitHubApi $api, $username)
    public function repos(Request $request, GitHubApi $api, $username)
    {
        $repoData = $api->getRepos($username);
        //dump($repoData);
        return $this->render('githut/repos.html.twig', $repoData);
    }
}