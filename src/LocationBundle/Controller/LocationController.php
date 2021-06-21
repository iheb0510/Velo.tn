<?php

namespace LocationBundle\Controller;

use AppBundle\Entity\User;
use LocationBundle\Entity\Location;
use LocationBundle\Entity\Produit;
use LocationBundle\Form\LocationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\Constraints\DateTime;


class LocationController extends Controller
{


    public function addLocationAction(Request $request ,$idprod,$iduser,$end_l,$startl,$montant )

    {

        //$rep = $this->getDoctrine()->getManager()->getRepository(region::class);
      //  $user = $this->container->get('security.token_storage')->getToken()->getUser();
      //  $user->getId();
        $user = $this->getDoctrine()->getManager()->getRepository(User::class)->find($iduser);
        $user->getId();
        $produit = $this->getDoctrine()->getManager()->getRepository(Produit::class)->find($idprod);
        $produit->getId();

        $location = new Location();
        $d1 = new \DateTime($startl);
        $d2 = new \DateTime($end_l);
        $location->setEndL($d2);
        $location->setStartL($d1);

           $em=$this->getDoctrine()->getManager();
            $location->setIdClient($user);
            $location->setIdProduit($produit);


            $location->getIdProduit()->setDisponible(0);
             $a =$location->getIdProduit()->getPrixHeure();
            $location->setMontant( $montant);

             $em->persist($location);
            $em->flush();
            $serializer = new Serializer([new ObjectNormalizer()]);
              $formatted = $serializer->normalize($location);
               return new JsonResponse($formatted);



        //else {
         //   return $this->render('@Location/Default/addlocation.html.twig', array('form' => $form->createView()));
        //}

// return $this->render('@Amendes/Default/index.html.twig');

        //$em = $this->getDoctrine()->getManager();
        //$location = new Location();
        //$location->setMontant($request->get('montant'));
       // $location->setIdClient($request->get('id_client'));
       // $location->setEndL($request->get('end_l'));
        //$location->setIdProduit($request->get('id_Produit'));
        //$location->setStartL($request->get('start_l'));

        //$em->persist($location);
        //$em->flush();
        //$serializer = new Serializer([new ObjectNormalizer()]);
        //$formatted = $serializer->normalize($location);
        //return new JsonResponse($formatted);
    }
    public function updateLocationAction(Request $request,$id)
    {

        $Formation = $this->getDoctrine()->getManager()->getRepository(\LocationBundle\Entity\Location::class)->find($id);
        $form =$this->createForm(LocationType::class,$Formation);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $this->getDoctrine()->getManager()->persist($Formation);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('Location_list');
        } else {
            return $this->render('@Location/Default/addlocation.html.twig', array('form' => $form->createView()));
        }

    }
    public function deleteLocationAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $list = $em->getRepository(\LocationBundle\Entity\Location::class)->find($id);

        $em->remove($list);
        $em->flush();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($list);
        return new JsonResponse($formatted);

    }
    public function listLocationAction()
    {
        $em = $this->getDoctrine()->getManager()->getRepository(\LocationBundle\Entity\Location::class);
        $list = $em->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($list);
        return new JsonResponse($formatted);
    }

    public function lectureLocationAction($id)
    {
        $em = $this->getDoctrine()->getManager()->getRepository(Location::class);
        $list = $em->find($id);
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($list);
        return new JsonResponse($formatted);
    }
    public function findlocAction($id)
    {

        $m=$this->getDoctrine()->getManager()->getRepository(Location::class)->findBy(['id_client' =>$id]);

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($m);
        return new JsonResponse($formatted);
    }
}
