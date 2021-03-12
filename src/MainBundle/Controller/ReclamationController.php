<?php

namespace MainBundle\Controller;

use FOS\CKEditorBundle\Form\Type\CKEditorType;
use MainBundle\Entity\Reclamation;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;

class ReclamationController extends Controller
{

    public function showreclamationAction()
    { $em=$this->getDoctrine()->getManager();
        //$id = $this->get('security.token_storage')->getToken()->getUser()->getId();
       // $user = $em->getRepository('UserBundle:User')->findOneBy(['id' => $id]);
        $posts = $this->getDoctrine()->getRepository('MainBundle:Reclamation')->findBy(['idUser' =>1]);
        return $this->render('Reclamation/showreclamation.html.twig',['posts'=>$posts]);
    }


    public function CreateRAction(Request $request)
    {           $em = $this->getDoctrine()->getManager();

        $RAW_QUERY = "SELECT nom_event FROM Events ";

        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();

        $result = $statement->fetchAll();

        $reclamation = new Reclamation();
        $form = $this->createFormBuilder($reclamation)

            ->add('contenu',CKEditorType::class,array('attr'=>array('class'=>'form-control','placeholder'=> 'reclamer ici...','required'=>'true') ))
            ->add('type',ChoiceType::class, [
                'choices' => [
                    'Urgente' => 'Urgente',
                    'non Urgente' => 'non Urgente',
                ],'choice_label' => function ($obj, $key, $value) {
                    return $obj;
                }
            ])
            ->add('idEvent', EntityType::class, [
                // looks for choices from this entity
                'class' => \MainBundle\Entity\Events::class,

                // uses the User.username property as the visible option string
                'choice_label' => 'nom_event',

                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
            ])
            ->add('save',SubmitType::class,array('label'=>'Create Reclamation','attr'=>array('class'=>' btn confer-btn mt-3 mt-lg-0 ml-3 ml-lg-5') ))
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid())
        {
            $contenu=$form['contenu']->getData();
            $type=$form['type']->getData();
            $choix = $form['idEvent']->getData();            {

                $reclamation->setContenu($contenu);
                $reclamation->setType($type);
                $reclamation->setEtat('non traitée');
                $reclamation->setReponse('');
                $reclamation->setDate(new \DateTime('now'));
                $em=$this->getDoctrine()->getManager();
              //  $id = $this->get('security.token_storage')->getToken()->getUser()->getId();
                $user = $em->getRepository('MainBundle:FosUser')->findOneBy(['id' => 1]);
                $reclamation->setIdUser($user);

                $reclamation->setIdEvent($choix->getIdEv());


                $em->persist($reclamation);
                $em->flush();
                $this->addFlash('message','Reclamation Crée');


            }
            return $this->redirectToRoute('show_front_Reclamation');
        }
        return $this->render('Reclamation/createreclamation.html.twig',['form'=>$form->createView()]);

    }
    /**
     *
     */
    public function DeleteRecAction($id)
    {$em=$this->getDoctrine()->getManager();
        $r=$em->getRepository('MainBundle:Reclamation')->find($id);
        $em->remove($r);
        $em->flush();
        return $this->redirectToRoute('show_front_Reclamation');
    }

    public function EditRecAction(Request $request,$id)
    {   $r= $this->getDoctrine()->getManager()->getRepository('MainBundle:Reclamation')->find($id);
        $r->setContenu($r->getContenu());
        $r->setType($r->getType());
        $form = $this->createFormBuilder($r)

            ->add('contenu',CKEditorType::class,array('attr'=>array('class'=>'form-control','placeholder'=> 'reclamer ici...','required'=>'true') ))
            ->add('idEvent', EntityType::class, [
                // looks for choices from this entity
                'class' => \MainBundle\Entity\Events::class,

                // uses the User.username property as the visible option string
                'choice_label' => 'nom_event',

                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
            ])
            ->add('type',ChoiceType::class, [
                'choices' => [
                    'Urgente' => 'Urgente',
                    'non Urgente' => 'non Urgente',
                ],'choice_label' => function ($obj, $key, $value) {
                    return $obj;
                }
            ])
            ->add('save',SubmitType::class,array('label'=>'Modifier La Reclamation','attr'=>array('class'=>'btn confer-btn mt-3 mt-lg-0 ml-3 ml-lg-5') ))
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid())
        {

            $contenu=$form['contenu']->getData();
            $type=$form['type']->getData();
            $choix=$form['idEvent']->getData();
            $em=$this->getDoctrine()->getManager();
            $r=$em->getRepository('MainBundle:Reclamation')->find($id);

            $r->setContenu($contenu);
            $r->setType($type);
            $r->setEtat('non traitée');
            $r->setReponse('');
            $r->setIdEvent($choix->getIdEv());


            $em->flush();
            return $this->redirectToRoute('show_front_Reclamation');
        }

        // replace this example code with whatever you need
        return $this->render('Reclamation/editreclamation.html.twig',['form'=>$form->createView()]);
    }

    public function ShowREmpAction()
    {

        $em = $this->getDoctrine()->getManager();

        $RAW_QUERY = "SELECT * FROM reclamation ";

        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();

        $result = $statement->fetchAll();

        return $this->render('Reclamation/ShowREmp.html.twig',['posts'=>$result]);
    }
    public function TriRecAction(Request $request)
    {
        $nom=$request->get('nom');
        $em = $this->getDoctrine()->getManager();

        $RAW_QUERY = "SELECT * FROM reclamation WHERE type='$nom'";

        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();

        $result = $statement->fetchAll();

        return $this->render('Reclamation/ShowREmp.html.twig',['posts'=>$result]);
    }
    public function ShowDetRecAction(Request $request)
    {   $id=$request->get('id');

        $em = $this->getDoctrine()->getManager();

        $RAW_QUERY = "SELECT * FROM reclamation where  id='$id' ";

        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();

        $result = $statement->fetchAll();



        return $this->render('Reclamation/ShowDetRec.html.twig',['posts'=>$result]);
    }

    public function SaveRecAction(Request $request)
    {





        $id=$request->get('id');
        $rep=$request->get('rep');
        $etat=$request->get('etat');



        $r= $this->getDoctrine()->getManager()->getRepository('MainBundle:Reclamation')->find($id);


        $r->setEtat($etat);
        $r->setReponse($rep);
        $e = $this->getDoctrine()->getManager();
        $e->persist($r);
        $e->flush();

        return $this->redirectToRoute('ShowREmp');

    }



    public function ShowRAdmAction()
    {
        $dat=new \DateTime('now');
        $dat->format('d/m/Y');
        $em = $this->getDoctrine()->getManager();

        $RAW_QUERY = "SELECT * FROM reclamation where  type='Urgente' and etat='non traitee' and  DATEDIFF(CURDATE(),date)>7";

        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();

        $result = $statement->fetchAll();

        return $this->render('Reclamation/ShowRAdm.html.twig',['posts'=>$result]);
    }
    public function BanAction()
    { $dat=new \DateTime('now');
        $dat->format('d/m/Y');
        $em = $this->getDoctrine()->getManager();

        $RAW_QUERY = " select e.nom_event as ev , e.id_ev as idd, r.id_event from  events e ,reclamation r where e.id_ev=r.id_event
   GROUP By r.id_event HAVING COUNT(*) >1 ";

        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();

        $result = $statement->fetchAll();

        return $this->render('Reclamation/ban.html.twig',['posts'=>$result]);
    }
    public function BloqAction( $id)
    {
            $idd=1 ;
        $em=$this->getDoctrine()->getManager();

        $r=$em->getRepository('MainBundle:FosUser')->find($id);

        $em = $this->getDoctrine()->getManager();

        $RAW_QUERY = " select id as us  from  events e ,fos_user u where e.nom_org=u.id and e.id_ev='$id' ";

        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute(array('id' => $idd));

        $result = $statement->fetchAll();

        //$idd= " select u.id as us  from  events e ,fos_user u where e.nom_org=u.id and e.id_ev='$id' ";


       // $idd=$result['id'];
        $RAW_QUERY1 = " UPDATE fos_user SET enabled = 0 WHERE id='$idd'; ";

        $statement1 = $em->getConnection()->prepare($RAW_QUERY1);
        $statement1->execute();





        return $this->redirectToRoute('ShowREmp');
    }


}
