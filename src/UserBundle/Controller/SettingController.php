<?php
/**
 * Created by PhpStorm.
 * User: arttit
 * Date: 9/4/2560
 * Time: 15:56 น.
 */

namespace UserBundle\Controller;
use AppBundle\Entity\m_employee;
use AppBundle\Entity\User;
use AppBundle\Entity\Test;
use AppBundle\GVal\GDateTime;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Component\HttpFoundation\Response;

use AppBundle\GClass\SimpleXLSX;



use FOS\UserBundle\Controller\RegistrationController;





use Symfony\Bundle\FrameworkBundle\Controller\Controller;
class SettingController extends Controller
{



    public function indexAction(Request $request)
    {




            $entities = $this->getDoctrine()->getRepository("AppBundle:m_employee")->findAll();
            return $this->render('UserBundle:Admin:setting.html.twig',array('entities' => $entities));




    }
    public function settingEmpIndexAction(Request $request)
    {
        $usrId= $this->get('security.token_storage')->getToken()->getUser()->getId();
        $result=$this->getDoctrine()->getRepository("AppBundle:User")->find($usrId);
        $cpnCode =$result->getCpnCode();
        $entities = $this->getDoctrine()->getRepository("AppBundle:m_employee")->getAllEmpByCpn($cpnCode);
        return $this->render('UserBundle:Admin:settingEmpIndex.html.twig',array('entities' => $entities));
    }
    public function settingEmpAddAction(Request $request)
    {

        $usrId= $this->get('security.token_storage')->getToken()->getUser()->getId();
        $result=$this->getDoctrine()->getRepository("AppBundle:User")->find($usrId);
        $cpnCode =$result->getCpnCode();
        $zip = $this->getDoctrine()->getRepository("AppBundle:G_Subdistrict")->getListOfZip();


        $task = new User();
        $emp=new m_employee();
        $form = $this->createFormBuilder($task)
            ->add('username', TextType::class,array('label'=>'username','required' => true))
            ->add('email', EmailType::class, array( 'required'=>true))
            ->add('telephoneNo', TextType::class, array('label' => 'telephoneNo', 'required' => true))
            ->add('roles', ChoiceType::class, array(
                    'choices'  => array(
                        'ROLE_ADMIN' => 'ROLE_ADMIN',
                        'ROLE_USER' => 'ROLE_USER',


                    ),'multiple'=>true
                )
            )
            ->add('enabled', ChoiceType::class, array(
                'choices'  => array(
                    'Yes' => 1,
                    'No' => 0,

                    )
               )
            )
            ->add('prvCode','entity', array(
                    'class' => 'AppBundle\Entity\G_Province','choice_label' => function ($category) {return (string)$category->getPrvNameTh();
                     },'label'=>'จังหวัด','choices_as_values' => true,
                )

            )
            ->add('disCode','entity', array(
                    'class' => 'AppBundle\Entity\G_District','choice_label'  => function ($category) {return (string)$category->getDisNameTh();
                    },'label'=>'อำเภอ','choices_as_values' => true,
                )

            )
            ->add('subDisCode','entity', array(
                    'class' => 'AppBundle\Entity\G_Subdistrict','choice_label'  => function ($category) {return (string)$category->getSubDisNameTh();
                    },'label'=>'ตำบล','choices_as_values' => true,
                )

            )

            ->add('password', PasswordType::class,array('empty_data'  => '123','required' => true))
            ->add('name',TextType::class)
            ->add('lastname',TextType::class)
            ->add('empCode',TextType::class)
            ->add('address1',TextType::class,array('required'=> false,'empty_data'  => null,'label'=>'address1'))
            ->add('address2',TextType::class,array('required'=> false,'empty_data'  => null,'label'=>'address2'))
            ->add('zipCode',TextType::class,array('required'=> false,'empty_data'  => null,'label'=>'zipcode','required' => true))
            //->add('created_at',DateType::class, ['widget' => 'single_text', 'format' => 'dd-MM-yyyy'])

           // ->add('created_at', 'date', ['widget' => 'single_text', 'format' => 'dd-MM-yyyy'])//datepicker
           // ->add('modified_at', 'date', ['widget' => 'single_text', 'format' => 'dd-MM-yyyy'])
            ->getForm();
       // $form = $this->createForm($task);
        $form->handleRequest($request);


        if ('POST' === $request->getMethod() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->getConnection()->beginTransaction();

          try{


                $dateTime=new GDateTime();
                $dateTimeFormat=$dateTime->getDateTime();
                $username=$form->get('username')->getData();
              $usernameCanonical=strtolower($form->get('username')->getData());
              $empCode=$form->get('empCode')->getData();
              $name=$form->get('name')->getData();
              $lastname=$form->get('lastname')->getData();
              $address1=$form->get('address1')->getData();
              $address2=$form->get('address2')->getData();
              $subDisCode=$form->get('subDisCode')->getData();
              $disCode=$form->get('disCode')->getData();
              $prvCode=$form->get('prvCode')->getData();
              $zipcode=$form->get('zipCode')->getData();
              $telNo =   $form->get('telephoneNo')->getData();
              $factory = $this->get('security.encoder_factory');
              $isEnable=$form->get('enabled')->getData();

              //$task = new Bundle\Entity\User();
              $task->setUsernameCanonical(strtolower($form->get('username')->getData()));
              $task->setEmailCanonical(strtolower($form->get('email')->getData()));

              $encoder = $factory->getEncoder($task);
              $password = $encoder->encodePassword($task->getPassword(), $task->getSalt());
              $task->setPassword($password);
              $task->setCpnCode($cpnCode);
              $em->persist($task);
              $em->flush();
              $fosId= $task->getId();
              $resultHeader=$this->getDoctrine()->getRepository("AppBundle:User")->findOneBy(array('username'=>$username));
              //$fosId= $task->getId();


              //UserInterface();
             // $password = $this->get('security.password_encoder')->encodePassword($task,$task->getPlainPassword());




                //$factory = $this->get('security.encoder_factory');
                //$encoder = $factory->getEncoder($task);
                //$password = $encoder->encodePassword($task->getPlainPassword(), $task->getSalt());


              //  $task->setPassword($password);

              if($isEnable==1)
              {
                  $task->setEnabled(true);

              }else{
                  $task->setEnabled(false);
              }
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
                return $this->render('UserBundle:Admin:settingEmpAdd.html.twig',array('form' => $form->createView(),"zip"=>$zip));
           } catch(\Doctrine\ORM\ORMException $e){
                $em->getConnection()->rollBack();
                $this->get('logger')->error($e->getTraceAsString());
            } catch(\Exception $e){
                $em->getConnection()->rollBack();
                $this->get('logger')->error($e->getTraceAsString());

            }






        }
        return $this->render('UserBundle:Admin:settingEmpAdd.html.twig',array('form' => $form->createView(),"zip"=>$zip));


    }
    public function settingEmpEditAction(Request $request,m_employee $employee)
    {
        $usrId= $this->get('security.token_storage')->getToken()->getUser()->getId();
        $result=$this->getDoctrine()->getRepository("AppBundle:User")->find($usrId);
        $cpnCode =$result->getCpnCode();
        $zip = $this->getDoctrine()->getRepository("AppBundle:G_Subdistrict")->getListOfZip();
        $fosObj=$employee->getFos();
        $fosObj->getUsername();
        $curPrvNameTh= $employee->getPrvNameTh();
        $curDisNameTh= $employee->getDistrictNameTh();
        $curSubDisNameTh=$employee->getSubDistrictNameTh();




        $task = new User();
        $emp=new m_employee();
        //$empId=$this->getDoctrine()->getRepository("AppBundle:User")->find($id);

        $form = $this->createFormBuilder($employee)
            ->add('username', TextType::class,array('label'=>'username','required' => true,'data'=> $fosObj->getUsername()))
            ->add('email', EmailType::class, array( 'required'=>true,"data"=>$fosObj->getEmail()))
            ->add('roles', ChoiceType::class, array(
                    'choices'  => array(
                        'ROLE_ADMIN' => 'ROLE_ADMIN',
                        'ROLE_USER' => 'ROLE_USER',


                    ),'multiple'=>true,"data"=>$fosObj->getRoles()
                )
            )
            ->add('telephoneNo', TextType::class, array('label' => 'telephoneNo', 'required' => true))
            ->add('enabled', ChoiceType::class, array(
                    'choices'  => array(
                        'Yes' => 1,
                        'No' => 0,

                    ),"data"=>$fosObj->isEnabled()
                )
            )
            ->add('prvCode','entity', array(
                    "data"=>23,
                    'class' => 'AppBundle\Entity\G_Province','choice_label' => function ($category) {return (string)$category->getPrvNameTh();},
                    'label'=>'จังหวัด',
                )

            )
            ->add('disCode','entity', array(
                    'class' => 'AppBundle\Entity\G_District','choice_label'  => function ($category) {return (string)$category->getDisNameTh();
                    },'label'=>'อำเภอ',
                )

            )
            ->add('subDisCode','entity', array(
                    'class' => 'AppBundle\Entity\G_Subdistrict','choice_label'  => function ($category) {return (string)$category->getSubDisNameTh();
                    },'label'=>'ตำบล',
                )

            )

            ->add('password', PasswordType::class,array('empty_data'  => '123','required' => true))
            ->add('name',TextType::class)
            ->add('lastname',TextType::class)
            ->add('empCode',TextType::class)
            ->add('address1',TextType::class,array('required'=> false,'empty_data'  => null,'label'=>'address1'))
            ->add('address2',TextType::class,array('required'=> false,'empty_data'  => null,'label'=>'address2'))
            ->add('zipCode',TextType::class,array('required'=> false,'empty_data'  => null,'label'=>'zipcode','required' => true))
            //->add('created_at',DateType::class, ['widget' => 'single_text', 'format' => 'dd-MM-yyyy'])

            // ->add('created_at', 'date', ['widget' => 'single_text', 'format' => 'dd-MM-yyyy'])//datepicker
            // ->add('modified_at', 'date', ['widget' => 'single_text', 'format' => 'dd-MM-yyyy'])
            ->getForm();
        // $form = $this->createForm($task);
        $form->handleRequest($request);


        if ('POST' === $request->getMethod() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->getConnection()->beginTransaction();

            try{
                //$employee->getFos();

                $em->remove($employee);
                $em->flush();
                $em->remove($fosObj);
                $em->flush();
                $dateTime=new GDateTime();
                $dateTimeFormat=$dateTime->getDateTime();
                $username=$form->get('username')->getData();
                $usernameCanonical=strtolower($form->get('username')->getData());
                $empCode=$form->get('empCode')->getData();
                $name=$form->get('name')->getData();
                $lastname=$form->get('lastname')->getData();
                $address1=$form->get('address1')->getData();
                $address2=$form->get('address2')->getData();
                $subDisCode=$form->get('subDisCode')->getData();
                $disCode=$form->get('disCode')->getData();
                $prvCode=$form->get('prvCode')->getData();
                $zipcode=$form->get('zipCode')->getData();
                $email=$form->get('email')->getData();
                $isEnable=$form->get('enabled')->getData();
                $telNo =   $form->get('telephoneNo')->getData();



                $factory = $this->get('security.encoder_factory');
                $task->setUsername($username);
                $task->setUsernameCanonical(strtolower($form->get('username')->getData()));
                $task->setEmail($email);

                $task->setEmailCanonical(strtolower($form->get('email')->getData()));
                $encoder = $factory->getEncoder($task);
                $password = $encoder->encodePassword($task->getPassword(), $task->getSalt());
                $task->setPassword($password);
                $task->setCpnCode($cpnCode);
                if($isEnable==1)
                {
                    $task->setEnabled(true);

                }else{
                    $task->setEnabled(false);
                }

                $em->persist($task);
                $em->flush();
                $fosId= $task->getId();
                $resultHeader=$this->getDoctrine()->getRepository("AppBundle:User")->findOneBy(array('username'=>$username));
                //$fosId= $task->getId();


                //UserInterface();
                // $password = $this->get('security.password_encoder')->encodePassword($task,$task->getPlainPassword());




                //$factory = $this->get('security.encoder_factory');
                //$encoder = $factory->getEncoder($task);
                //$password = $encoder->encodePassword($task->getPlainPassword(), $task->getSalt());


                //  $task->setPassword($password);
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
                return $this->render('UserBundle:Admin:settingEmpEdit.html.twig',array('form' => $form->createView(),"zip"=>$zip,"curPrvNameTh"=>$curPrvNameTh,"curDisNameTh"=>$curDisNameTh,"curSubDisNameTh"=>$curSubDisNameTh));
           } catch(\Doctrine\ORM\ORMException $e){
                $em->getConnection()->rollBack();
                $this->get('logger')->error($e->getTraceAsString());
            } catch(\Exception $e){
                $em->getConnection()->rollBack();
                $this->get('logger')->error($e->getTraceAsString());

            }






        }

        return $this->render('UserBundle:Admin:settingEmpEdit.html.twig',array('form' => $form->createView(),"zip"=>$zip,"curPrvNameTh"=>$curPrvNameTh,"curDisNameTh"=>$curDisNameTh,"curSubDisNameTh"=>$curSubDisNameTh));
    }
    public function settingEmpDeleteAction(m_employee $m_employee)
    {
        $usrId= $this->get('security.token_storage')->getToken()->getUser()->getId();
        $result=$this->getDoctrine()->getRepository("AppBundle:User")->find($usrId);
        $cpnCode =$result->getCpnCode();
        $fosObj=$m_employee->getFos();
        $fosId=$m_employee->getFos()->getId();
        $em = $this->getDoctrine()->getManager();
        $fosObj->setEnabled(false);
        $em->flush();




       /* $data = new User();
        $data->setId($fosId);
        $data->setEnable(false);
        $em = $this->getDoctrine()->getManager();
        $em->merge($data);
        $em->flush();*/

       // $result = $this->getDoctrine()->getRepository("AppBundle:m_employee")->find($id);



        $entities = $this->getDoctrine()->getRepository("AppBundle:m_employee")->getAllEmpByCpn($cpnCode);
        return $this->render('UserBundle:Admin:settingEmpIndex.html.twig',array('entities' => $entities));


    }
    public function settingEmpImportAction(Request $request)
    {
        $usrId= $this->get('security.token_storage')->getToken()->getUser()->getId();
        $result=$this->getDoctrine()->getRepository("AppBundle:User")->find($usrId);
        $cpnCode =$result->getCpnCode();


        return $this->render('UserBundle:Admin:settingEmpImport.html.twig',array('entities'=>""));


    }
    public function settingEmpImportExcelRespondAction(Request $request)
    {
        $usrId= $this->get('security.token_storage')->getToken()->getUser()->getId();
        $result=$this->getDoctrine()->getRepository("AppBundle:User")->find($usrId);
        $cpnCode =$result->getCpnCode();
        $data =$request->getContent();
        $dateTime=new GDateTime();
        $dateTimeFormat=$dateTime->getDateTime();

        $arrData=explode('#',$data);
        $username=$arrData[0];
        $name=$arrData[1];
        $lastname=$arrData[2];
        try{

            $em = $this->getDoctrine()->getManager();
            $em->getConnection()->beginTransaction();
            $user=new Test();
            $fos=new User();
            $emp=new m_employee();
            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($fos);
            $password = $encoder->encodePassword('123', $fos->getSalt());
            $fos->setPassword($password);
            $fos->setUsername(str_replace(' ','',str_replace('"','',preg_replace("[^a-zA-Z_0-9ก-๙]","",$username))));
            $fos->setEnabled(true);
            $fos->addRole('ROLE_USER');
            $fos->setCpnCode($cpnCode);
            $fos->setUsernameCanonical(strtolower($username));
            $fos->setPassword($password);

            $emp->setEmpCode(str_replace(' ','',str_replace('"','',preg_replace("[^a-zA-Z_0-9ก-๙]","",$username))));
            $emp->setCpnCode($cpnCode);
            $emp->setFos($fos);
            $emp->setName(str_replace(' ','',str_replace('"','',preg_replace("[^a-zA-Z_0-9ก-๙]","",$name))));
            $emp->setLastname(str_replace(' ','',str_replace('"','',preg_replace("[^a-zA-Z_0-9ก-๙]","",$lastname))));
            $emp->setCreatedAt($dateTimeFormat);
            //$fos->setEmailCanonical(strtolower($form->get('email')->getData()));

            // $user->setTestvalue($username);


            $em->persist($fos);
            $em->flush();
            $em->persist($emp);
            $em->flush();
            $em->getConnection()->commit();

        }catch (\Exception $exception)
        {

            $logger = $this->get('logger');
            $logger->info($exception->getFile().'#'.$exception->getLine());
            $logger->error('An error occurred');

            $logger->critical('error', array(
                // include extra "context" info in your logs
                'cause' => $exception->getTraceAsString(),
            ));
            return $this->render('UserBundle:Test:Test.html.twig',array('entities'=>''));
        }




        //return new Response('This is not ajax!', 400);


       return $this->render('UserBundle:Test:Test.html.twig',array('entities'=>''));


    }



    public function settingDepartmentIndexAction(Request $request)
    {
        $usrId= $this->get('security.token_storage')->getToken()->getUser()->getId();
        $result=$this->getDoctrine()->getRepository("AppBundle:User")->find($usrId);
        $cpnCode =$result->getCpnCode();
        $entities = $this->getDoctrine()->getRepository("AppBundle:M_Department")->getAllDepartmentByCpn($cpnCode);
        return $this->render('UserBundle:Admin:settingDepartmentIndex.html.twig',array('entities' => $entities));




    }

    public function settingDepartmentAddAction(Request $request)
    {





    }



    public function autocompleteAction(Request $request)
    {
        $names = array();
       // $zip = trim(strip_tags($request->get('zipCode')));

        $em = $this->getDoctrine()->getManager();

        $em= $this->getEntityManager();
        $query = $em->createQuery('SELECT  dt.zipCode  FROM AppBundle:G_Subdistrict dt');
        $entities =  $query->getResult();
        /*$entities = $em->getRepository('AppBundle:G_Subdistrict')->createQueryBuilder('c')
            ->where('c.zipCode LIKE :zip')
            ->setParameter('zip', '%'.$zip.'%')
            ->getQuery()
            ->getSingleResult();*/

       /* foreach ($entities as $entity)
        {
            $names[] = $entity->getName();
        }

        $response = new JsonResponse();
        $response->setData($names);*/
        $response = array("code" => 100, "success" => true);
        //you can return result as JSON
        return new Response(json_encode($response));

        return $response;
    }

    public function empActivationAction(Request $request)
    {

        //prepare the response, e.g.
        $response = array("code" => 100, "success" => true);
        //you can return result as JSON
        return new Response(json_encode($response));

        //return $response;
    }













    public function showAction($id) {
        $news = $this->getDoctrine()
            ->getRepository('FooNewsBundle:News')
            ->find($id);
        if (!$news) {
            throw $this->createNotFoundException('No news found by id ' . $id);
        }

        $build['news_item'] = $news;
        return $this->render('FooNewsBundle:Default:news_show.html.twig', $build);
    }

    public function addAction(Request $request) {



        $task = new m_employee();
        $form = $this->createFormBuilder($task)
            ->add('empCode', TextType::class,array('required'=> true, 'empty_data'  => null,'label'=>'emp code'))
            ->add('name', TextType::class)
            ->add('lastname', TextType::class)
            ->add('created_at', DateType::class)
            ->add('modified_at', DateType::class)
            ->add('save', SubmitType::class, array('label' => 'Create Post'))
            ->getForm();
        if ('POST' === $request->getMethod() && $form->isValid()) {

            try {
                // ...
                $em = $this->getDoctrine()->getManager();
                $em->persist($task);
                $em->flush();
            }
            catch (UniqueConstraintViolationException $e) {
                $em = $this->getDoctrine()->resetManager();
                $em->merge($task);
                $em->flush();
                // ....
            }



            $entities = $this->getDoctrine()->getRepository("AppBundle:m_employee")->findAll();
            return $this->render('UserBundle:Admin:setting.html.twig',array('entities' => $entities,'form' => $form->createView()));
        }else{
            $result=$form->getErrors();
            $entities = $this->getDoctrine()->getRepository("AppBundle:m_employee")->findAll();
            return $this->render('UserBundle:Admin:setting.html.twig',array('entities' => $entities,"result"=>$result,'form' => $form->createView()));

        }

    }

    public function editAction($id, Request $request) {

        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository("AppBundle:m_employee")->find($id);
        if (!$entities) {
            throw $this->createNotFoundException(
                'No news found for id ' . $id
            );
        }

        $form = $this->createFormBuilder($entities)
            ->add('title', 'text')
            ->add('body', 'text')
            ->add('save', 'submit')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->flush();
            return new Response('News updated successfully');
        }

        $build['form'] = $form->createView();

        return $this->render('FooNewsBundle:Default:news_add.html.twig', $build);
    }


    public function deleteAction($id, Request $request) {

        $em = $this->getDoctrine()->getManager();
        $news = $em->getRepository('FooNewsBundle:News')->find($id);
        if (!$news) {
            throw $this->createNotFoundException(
                'No news found for id ' . $id
            );
        }

        $form = $this->createFormBuilder($news)
            ->add('delete', 'submit')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->remove($news);
            $em->flush();
        }

        $build['form'] = $form->createView();
        return $this->render('FooNewsBundle:Default:news_add.html.twig', $build);
    }

}