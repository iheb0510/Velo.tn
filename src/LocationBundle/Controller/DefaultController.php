<?php

namespace LocationBundle\Controller;

use AppBundle\Entity\Notification;
use Doctrine\ORM\Query;
use LocationBundle\Entity\Magasin;
use LocationBundle\Entity\Produit;
use LocationBundle\Entity\Region;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use AppBundle\Entity\User;
class DefaultController extends Controller
{
    public function homeAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $posts=$em->getRepository('LocationBundle:Location')->findAll();
        return $this->render('@Location/Default/home.html.twig', array(
            "posts" =>$posts
        ));
        return $this->redirectToRoute('home_page');
    }

    public function mapAction(){

        return $this->render('@Location/Default/map.html.twig');
    }
    public function villeAction($ville)
    {
        $region = $this->getDoctrine()->getManager()->getRepository(Region::class)->findOneBy(['nom'=> $ville]);
        $m=$this->getDoctrine()->getManager()->getRepository(Magasin::class)->findBy(['id_region' =>$region->getIdReg()]);

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($m);
        return new JsonResponse($formatted);
    }
    public function notificationAction(){
        $notification = $this->getDoctrine()->getManager()->getRepository(Notification::class)->findAll();
        return $this->render('@Location/Default/a.html.twig', array(
            'notifications' => $notification
        ));
    }
    public function listproduitAction($id_magasin)
    {
        $magasin = $this->getDoctrine()->getManager()->getRepository(Magasin::class)->findOneBy(['id'=> $id_magasin]);


        $m=$this->getDoctrine()->getManager()
            ->getRepository(Produit::class)
            ->findBy([
                'id_Magasin' => $magasin->getId(),
                "Disponible" => 1,
                "statut" => 1
            ]);
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($m);
        return new JsonResponse($formatted);
    }
    public function loginAction(Request $request,$username,$password)
    {
        $u = new User();

        $u->setUsername($username);
        // $username = $request->query->get($username);
        $u->setPassword($password);
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository("AppBundle:User")->findBy(['username' => $username,"password"=>$password]);

        if ($user) {

            $serializer = new Serializer([new ObjectNormalizer()]);
            $formatted = $serializer->normalize($user);
            return new JsonResponse($formatted);

        } else {
            return new Response("failed");
        }


    }
    public function registerAction(Request $request,$email,$username,$password,$role){

        $u = new User();
        $u->setEmail($email);
        $u->setUsername($username);
        $u->setPassword($password);
        $u->addRole($role);

        $u->setEnabled(true);
        $em = $this->getDoctrine()->getManager();
        $em->persist($u);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($u);
        return new JsonResponse($formatted);
    }
    public function updateAction(Request $request){
        $u = $this->getDoctrine()->getManager()->getRepository(User::class)
            ->findOneBy(['username' => $request->get("username")]);

        $u->setEmail($request->get('email'));
        $u->setUsername($request->get('username'));
        $u->setPlainPassword($request->get('password'));
        $u->addRole($request->get('role'));
        $u->setEnabled(true);
        $em = $this->getDoctrine()->getManager();
        $em->persist($u);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($u);
        return new JsonResponse($formatted);
    }



}

