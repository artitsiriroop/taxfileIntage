<?php
/**
 * Created by PhpStorm.
 * User: arttit
 * Date: 20/4/2560
 * Time: 15:44 น.
 */

namespace UserBundle\Controller;


use AppBundle\Entity\G_DocIndex;
use AppBundle\Entity\T_UploadDetail;
use AppBundle\Entity\T_UploadHeader;
use  AppBundle\Entity\T_UploadDocDetail;
use AppBundle\Entity\Test;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Type\T_UploadHeaderType;
use AppBundle\GVal\DocCodeGenerator;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;


use  AppBundle\GVal\GDateTime;



class settingUploadFileController extends  Controller
{
    function exception_error_handler($errno, $errstr, $errfile, $errline ) {
        throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
    }
    public  function indexAction(Request $request)
    {
        $usrId= $this->get('security.token_storage')->getToken()->getUser()->getId();
        $result=$this->getDoctrine()->getRepository("AppBundle:User")->find($usrId);
        $cpnCode =$result->getCpnCode();
        $entities=$this->getDoctrine()->getRepository("AppBundle:T_UploadHeader")->findBy(array('cpnCode'=>$cpnCode));
        //$data=$resultHeader->();
        return $this->render('UserBundle:Admin:settingUploadFileIndex.html.twig', array('entities' =>$entities));
    }

    public function  newAction(Request $request)
    {

        $usrId= $this->get('security.token_storage')->getToken()->getUser()->getId();
        $result=$this->getDoctrine()->getRepository("AppBundle:User")->find($usrId);
        $cpnCode =$result->getCpnCode();
        $username =$result->getUsername();
        $upload = new T_UploadHeader();
        $gDate=new GDateTime();
        $nowYear=$gDate->getYear();
        $nowMonth=$gDate->getMonth();
        $nowDay=$gDate->getDate();

        $form = $this->createForm(T_UploadHeaderType::class, $upload);
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()) {


            $em = $this->getDoctrine()->getManager();
            $em->getConnection()->beginTransaction();
            try{
                $file = $upload->getUploadLocation();
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $file->move(
                    $this->getParameter('documents_directory'),
                    $fileName
                );
               // $this->getDoctrine()->getRepository("AppBundle:G_DocIndex")->updateDocIndex('up');
                //$result= $this->getDoctrine()->getRepository("AppBundle:G_DocIndex")->nowDocIndex('up');
              //  $nowDoc=$result->getDocIndex();
                $x=new \DateTime('now');
                $result=$this->getDoctrine()->getRepository("AppBundle:G_DocIndex")->findOneBy(array('docType'=>'up','docTime'=>$x));
                if($result==null)
                {
                    $nowDocId=null;
                    $nowDoc=1;


                }else{
                    $nowDocId=$result->getId();
                    $nowDoc=$result->getDocIndex();

                }

                $test='no';

                if($nowDocId==null)
                {
                  $test='yes';
                    $docIndex=new G_DocIndex();


                    $docIndex->setDocTime(new \DateTime("now"));
                    $docIndex->setDocType("up");
                    $docIndex->setDocIndex(1);
                    $docIndex->setDocYear($nowYear);
                    $docIndex->setDocMonth($nowMonth);
                    $docIndex->setDocDay($nowDay);
                    $em->persist($docIndex);
                }else{
                    $nowDoc++;
                    $result->setDocIndex($nowDoc);

                }




                $zip = new \ZipArchive($fileName);
                $path=$this->getParameter('documents_directory').'/'.$fileName;
                $file=$zip->open($path);
                $docGen =new DocCodeGenerator('up',$nowYear,$nowMonth,$nowDay,$nowDoc);
                $currDocCode=$docGen->getDocCode();
                $upload->setDocCode($currDocCode);
               // $upload->setDocYear($nowYear);
                $upload->setUploadBy($username);
                $upload->setUploadTime(new \DateTime("now"));
                $upload->setSumItems(0);
                $upload->setSumAccounts(0);
                $upload->setUploadLocation($path);
                $upload->setCpnCode($cpnCode);
                $unzipPath=$this->getParameter('documents_unzip_directory').'/'.pathinfo($path, PATHINFO_FILENAME);
                $upload->setUnzipUploadLoaction($unzipPath);
                $em->persist($upload);
                $em->flush();

                /*
                 * inser T_UploadDetail
                 */





                $resultHeader=$this->getDoctrine()->getRepository("AppBundle:T_UploadHeader")->findOneBy(array('docCode'=>$currDocCode));
                $headerId=$resultHeader->getId();

//************edit
               // $file = iconv('utf-8', 'windows-874', $file);
              //  $unzipPath = iconv('utf-8', 'windows-874', $unzipPath);
                /*for($i = 0; $i < $zip->numFiles; $i++) {
                    $name = $zip->getNameIndex($i);
                    $order = mb_detect_order();
                    $encoding = mb_detect_encoding($name, $order, true);
                    if (FALSE === $encoding) {
                        throw new UnexpectedValueException(
                            sprintf(
                                'Unable to detect input encoding with mb_detect_encoding, order was: %s'
                                , print_r($order, true)
                            )
                        );
                    } else {
                        $encoding = mb_detect_encoding($name);
                        $stringUtf8 = iconv($encoding, 'UTF-8//IGNORE', $name);
                        try {
                            $zip->extractTo(preg_replace('[^a-zA-Z_0-9ก-๙]', "", $unzipPath), $stringUtf8);
                        }catch (\Exception $exception)
                        {
                            $logger = $this->get('logger');
                            $str=preg_replace('[^a-zA-Z_0-9ก-๙]', "", $unzipPath);
                            $logger->info('unziplog');
                            $logger->error($str);

                            $logger->critical('I left the oven on!', array(
                                // include extra "context" info in your logs
                                'cause' => 'in_hurry',
                            ));


                        }
                    }
                }*/
                /*for($i = 0; $i < $zip->numFiles; $i++) {

                    $zip->extractTo($unzipPath, array($zip->getNameIndex($i)));

                    // here you can run a custom function for the particular extracted file

                }*/

///edit

               $zip->extractTo( $unzipPath);
                $zip->close();
              //  unlink($path);
                $countPdfS=0;
                $countAccounts=0;




                $folders = scandir($unzipPath, 0);
                for($i = 2; $i < count($folders); $i++){
                    $files = scandir($unzipPath.'/'.$folders[$i], 0);
                    for($j = 2; $j < count($files); $j++)
                    {



                        $countAccounts++;
                        $pdfs = scandir($unzipPath.'/'.$folders[$i].'/'.$files[$j], 0);

                        $username=preg_replace('/\D/', '', pathinfo($files[$j], PATHINFO_FILENAME));

                        $tUploadDocDetail=new T_UploadDocDetail();
                        $tUploadDocDetail->setHeader($resultHeader);
                        $tUploadDocDetail->setUserName($username);
                        $tUploadDocDetail->setDocCode($currDocCode);
                        $tUploadDocDetail->setCpnCode($cpnCode);
                       // $tUploadDocDetail->setSumItems(count($pdfs)-2);
                        $em->persist($tUploadDocDetail);
                        $em->flush();
                        //$upload->setSumItems(count($pdfs));

                        for($k = 2; $k<count($pdfs); $k++){

                            $docDisplayName=preg_replace("/[^0-9\\.]+/i","",pathinfo($pdfs[$k], PATHINFO_FILENAME));//preg_replace('/\D/', '', pathinfo($pdfs[$k], PATHINFO_FILENAME));
                            $docDisplayName=$docDisplayName.'.pdf';

                            $ext = pathinfo($pdfs[$k], PATHINFO_EXTENSION);
                            $invpdf=0;
                            if($ext=='pdf')
                            {

                               // rename("/folder/file.ext", "newfile.ext");

                                $T_UploadDetail=new T_UploadDetail();
                                $T_UploadDetail->setHeader($resultHeader);//insert object not id
                                $T_UploadDetail->setUserName($username);
                                $pdfPath=$unzipPath.'/'.$folders[$i].'/'.$files[$j].'/'.$pdfs[$k];
                                $T_UploadDetail->setUploadLocation($pdfPath);
                                $T_UploadDetail->setFilName($docDisplayName);
                                $countPdfS++;
                                $invpdf++;
                               // $T_UploadDetail->setPdfDocDate($docCreateDate);
                                $em->persist($T_UploadDetail);
                                $em->flush();
                                $tUploadDocDetail->setSumItems($invpdf);
                                $em->persist($tUploadDocDetail);
                                $em->flush();

                            }





                        }

                       // rename($files[$j],$username);

                    }

                }




               // $em->persist($test);
                $upload->setSumItems($countPdfS);
                $upload->setSumAccounts($countAccounts);
                $em->persist($upload);
                $em->flush();



                $em->getConnection()->commit();
                //return $this->render('UserBundle:Test:Test.html.twig', array('entity' =>$fileName,));





            }catch (\Exception $ex)
            {
               // unlink($path);
                return $this->render('UserBundle:Test:Test.html.twig', array('entities' =>$ex->getLine(),"data"=>''));
                //$em->getConnection()->rollback();


            }



        }

        return $this->render('UserBundle:Admin:settingUploadFile.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    public function  deleteAction(T_UploadHeader $tUploadHeader)
    {
        $usrId= $this->get('security.token_storage')->getToken()->getUser()->getId();
        $result=$this->getDoctrine()->getRepository("AppBundle:User")->find($usrId);
        $cpnCode =$result->getCpnCode();

        $fileLocation=$tUploadHeader->getUploadLocation();
        $unzipFileLoaction=$tUploadHeader->getUnzipUploadLoaction();

        if(file_exists($fileLocation)){
            unlink($fileLocation);
        }else{

        }
        if(is_dir($unzipFileLoaction))
        {
                //rmdir($unzipFileLoaction);
                $fs = new Filesystem();
                try {
                    $fs->remove(array('symlink', $unzipFileLoaction, 'activity.log'));
                } catch (IOExceptionInterface $e) {
                    echo "An error occurred while creating your directory at ".$e->getPath();
                }

        }






        $em = $this->getDoctrine()->getManager();
        $em->remove($tUploadHeader);
        $em->flush();

        $entities=$this->getDoctrine()->getRepository("AppBundle:T_UploadHeader")->findBy(array('cpnCode'=>$cpnCode));
        //$data=$resultHeader->();
        return $this->render('UserBundle:Admin:settingUploadFileIndex.html.twig', array('entities' =>$entities));

    }
    public function  viewDocDetailAction(T_UploadHeader $tUploadHeader)
    {



        $usrId= $this->get('security.token_storage')->getToken()->getUser()->getId();
        $result=$this->getDoctrine()->getRepository("AppBundle:User")->find($usrId);
        $cpnCode =$result->getCpnCode();

       // $em = $this->getDoctrine()->getManager();
        $id=$tUploadHeader->getId();
        $docCode=$tUploadHeader->getDocCode();
        $entities=$this->getDoctrine()->getRepository("AppBundle:T_UploadDocDetail")->getAllDocDetail($id);


        return $this->render('UserBundle:Admin:settingUploadFileDocDetail.html.twig', array('entities' =>$entities));

    }


}