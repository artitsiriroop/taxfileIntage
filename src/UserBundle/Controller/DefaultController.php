<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\m_employee;
use AppBundle\Entity\User;
use AppBundle\GVal\GDateTime;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;




class DefaultController extends Controller
{
    public function indexAction()
    {   $usrId= $this->get('security.token_storage')->getToken()->getUser()->getId();
        $result=$this->getDoctrine()->getRepository("AppBundle:User")->find($usrId);
        $cpnCode =$result->getCpnCode();
        $userName =$result->getUserName();
        $years = $this->getDoctrine()->getRepository("AppBundle:T_UploadHeader")->getPersonalDocHeader(array('id'=>$userName));
        return $this->render('UserBundle:Default:index.html.twig',array('years'=>$years));
    }

    public  function viewFileAction($id)
    {
        $usrId= $this->get('security.token_storage')->getToken()->getUser()->getId();
        $result=$this->getDoctrine()->getRepository("AppBundle:User")->find($usrId);
        $cpnCode =$result->getCpnCode();
        $userName =$result->getUsername();

        $files = $this->getDoctrine()->getRepository("AppBundle:T_UploadDetail")->findBy(array('header'=>$id,'userName'=>$userName));
        return $this->render('UserBundle:Default:viewFile.html.twig',array('files'=>$files,'userName'=>$userName));

    }

    public function downloadAction($id)
    {
        /*$request = $this->get('request');
        $path = $this->get('kernel')->getRootDir(). "/../web/downloads/";
        $content = file_get_contents($path.$filename);
        */
        $usrId= $this->get('security.token_storage')->getToken()->getUser()->getId();

        //$request = $this->get('request');
        ///$file = '/var/www/html/my_project_name/web/uploads/uploads/folder/123/1.pdf';//$this->getDoctrine()->getRepository("AppBundle:T_Upload")->getUpLoadLocation($id);

        $result=$this->getDoctrine()->getRepository("AppBundle:T_UploadDetail")->find($id);
        $file =$result->getUploadLocation();
        $response = new BinaryFileResponse($file);
        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT);

        return $response;
       // return $this->render('UserBundle:Test:Test.html.twig',array('entity'=>$file));
    }
    public  function registerAction(Request $request)
    {
        try {



            $cpnCode = $this->getDoctrine()->getRepository("AppBundle:G_Company")->findOneBy(array('cpnCode' => 'In'));

            $zip = $this->getDoctrine()->getRepository("AppBundle:G_Subdistrict")->getListOfZip();
            $task = new User();
            $emp = new m_employee();
            $form = $this->createFormBuilder($task)
               // ->add('username', TextType::class, array('label' => 'username', 'required' => true))
                ->add('email', EmailType::class, array('required' => false))
                ->add('roles', ChoiceType::class, array(
                        'choices' => array(
                            'ROLE_USER' => 'ROLE_USER',


                        ), 'multiple' => true
                    )
                )
                ->add('enabled', ChoiceType::class, array(
                        'choices' => array(
                            'Yes' => 1,


                        )
                    )
                )
                ->add('prvCode', 'entity', array(
                        'class' => 'AppBundle\Entity\G_Province', 'choice_label' => function ($category) {
                            return (string)$category->getPrvNameTh();
                        }, 'label' => 'จังหวัด', 'choices_as_values' => true,
                    )

                )
                ->add('disCode', 'entity', array(
                        'class' => 'AppBundle\Entity\G_District', 'choice_label' => function ($category) {
                            return (string)$category->getDisNameTh();
                        }, 'label' => 'อำเภอ', 'choices_as_values' => true,
                    )

                )
                ->add('subDisCode', 'entity', array(
                        'class' => 'AppBundle\Entity\G_Subdistrict', 'choice_label' => function ($category) {
                            return (string)$category->getSubDisNameTh();
                        }, 'label' => 'ตำบล', 'choices_as_values' => true,
                    )

                )
                ->add('password', PasswordType::class, array('empty_data' => '123', 'required' => false))
                ->add('name', TextType::class)
                ->add('lastname', TextType::class)
                ->add('telephoneNo', TextType::class, array('label' => 'telephoneNo', 'required' => true))
                ->add('empCode', TextType::class)
                ->add('address1', TextType::class, array('required' => false, 'empty_data' => null, 'label' => 'address1'))
                ->add('address2', TextType::class, array('required' => false, 'empty_data' => null, 'label' => 'address2'))
                ->add('zipCode', TextType::class, array('required' => false, 'empty_data' => null, 'label' => 'zipcode', 'required' => true))
                ->getForm();
            // $form = $this->createForm($task);
            $form->handleRequest($request);


            if ('POST' === $request->getMethod() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->getConnection()->beginTransaction();

                //  try{


                $dateTime = new GDateTime();
                $dateTimeFormat = $dateTime->getDateTime();
                $username = $form->get('username')->getData();
                $usernameCanonical = strtolower($form->get('username')->getData());
                $empCode = $form->get('username')->getData();
                $name = $form->get('name')->getData();
                $lastname = $form->get('lastname')->getData();
                $address1 = $form->get('address1')->getData();
                $address2 = $form->get('address2')->getData();
                $subDisCode = $form->get('subDisCode')->getData();
                $disCode = $form->get('disCode')->getData();
                $prvCode = $form->get('prvCode')->getData();
                $zipcode = $form->get('zipCode')->getData();
                $telNo =   $form->get('telephoneNo')->getData();
                $factory = $this->get('security.encoder_factory');
                // $cpnCode=$form->get('cpnCode')->getData();
                $task->setUsernameCanonical(strtolower($form->get('username')->getData()));
                $task->setEmailCanonical(strtolower($form->get('email')->getData()));

                $encoder = $factory->getEncoder($task);
                $plaintextpass = "123";
                $password = $encoder->encodePassword($plaintextpass, $task->getSalt());
                $task->setPassword($password);
                $task->setCpnCode($cpnCode);
                $em->persist($task);
                $em->flush();
                $fosId = $task->getId();
                $resultHeader = $this->getDoctrine()->getRepository("AppBundle:User")->findOneBy(array('username' => $username));
                $emp->setEmpCode($empCode);
                $emp->setName($name);
                $emp->setLastname($lastname);
                $emp->setCreatedAt($dateTimeFormat);
                $emp->setAddress1($address1);
                $emp->setAddress2($address2);
                $emp->setSubDistrictNameTh($subDisCode);
                $emp->setDistrictNameTh($disCode);
                $emp->setPrvNameTh($prvCode);
                $emp->setZipCode($zipcode);
                $emp->setCpnCode($cpnCode);
                $emp->setTelephoneNo($telNo);
                // $emp->setFos($resultHeader);
                $emp->setFos($task);
                $em->persist($emp);
                $em->persist($task);
                $em->flush();
                $em->getConnection()->commit();
                return $this->render('UserBundle:Default:agreement.html.twig', array("registername" => $username));

            }
            return $this->render('UserBundle:Default:registration.html.twig', array('form' => $form->createView(), "zip" => $zip));
        }catch(\mysqli_sql_exception $e)
        {
            return $this->render('UserBundle:Default:agreementx.html.twig');
        }



    }
}
