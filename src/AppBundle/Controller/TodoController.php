<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Todo;
use Symfony\Component\HttpFoundation\Response;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Translation\Loader\XliffFileLoader;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Form\Forms;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\Extension\Csrf\CsrfExtension;
use Symfony\Component\Security\Csrf\CsrfTokenManager;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;


define('DEFAULT_FORM_THEME', 'form_div_layout.html.twig');

define('VENDOR_DIR', realpath(__DIR__ . '/../vendor'));
define('VENDOR_FORM_DIR', VENDOR_DIR . '/symfony/form');
define('VENDOR_VALIDATOR_DIR', VENDOR_DIR . '/symfony/validator');
/*define('VENDOR_TWIG_BRIDGE_DIR', VENDOR_DIR . '/symfony/twig-bridge');
define('VIEWS_DIR', realpath(__DIR__ . '/../views'));*/

class TodoController extends Controller
{
    /**
     * @Route("/todo", name="todo")
     * @Route("/todo/{todo_id}", name="todo")
     */

    public function indexAction(Request $request, $todo_id = null)
    {


        // Set up the CSRF Token Manager
        $csrfTokenManager = new CsrfTokenManager();
        // Set up the Validator component
        $validator = Validation::createValidator();

        // Set up the Translation component
        $translator = new Translator('en');
        $translator->addLoader('xlf', new XliffFileLoader());
        $translator->addResource('xlf', VENDOR_FORM_DIR . '/Resources/translations/validators.en.xlf', 'en', 'validators');
        $translator->addResource('xlf', VENDOR_VALIDATOR_DIR . '/Resources/translations/validators.en.xlf', 'en', 'validators');


        // Set up the Form component
        $formFactory = Forms::createFormFactoryBuilder()
            ->addExtension(new CsrfExtension($csrfTokenManager))
            ->addExtension(new ValidatorExtension($validator))
            ->getFormFactory();
       // $form = $formFactory->createBuilder();

        if(isset($todo_id)){



            $em = $this->getDoctrine()->getManager();
            $todo = $em->getRepository('AppBundle:Todo')->find($todo_id);

            $form = $formFactory->createBuilder()
                ->add('Title', 'text', array(
                    'data' =>  $todo->getTitle(),
                ))
                ->add('Description', 'text' ,array(
                    'data' =>  $todo->getDescription(),
                ))
                ->getForm();

            if(isset($_POST)){
                if (isset($_POST[$form->getName()])) {
                    $form->submit($_POST[$form->getName()]);
                    if ($form->isValid()) {

                      //  var_dump($todo_id);

                        //$todo = new Todo();

                        $todo->setTitle($form['Title']->getData());
                        $todo->setDescription($form['Description']->getData());

                        $todo->setId($todo_id);

                        $em = $this->getDoctrine()->getManager();

                        // tells Doctrine you want to (eventually) save the Product (no queries yet)
                        //$em->persist($todo);

                        // actually executes the queries (i.e. the INSERT query)
                        $em->flush();


                        $repository = $this->getDoctrine()->getRepository('AppBundle:Todo');
                        $allTodo=  $repository->findAll();

                        return $this->render('layouts/todo.html.twig', array(
                            'form' => $form->createView(),
                            'todo_id' => $todo_id,
                            'allTodo' => $allTodo,
                        ));
                    }
                }
            }

              $repository = $this->getDoctrine()->getRepository('AppBundle:Todo');
             $allTodo=  $repository->findAll();

             //return $this->redirect($this->generateUrl('/todo/'.$todo_id));
            return $this->render('layouts/todo.html.twig', array(
                 'form' => $form->createView(),
                 'todo_id' => $todo_id,
                 'allTodo' => $allTodo,
             ));

        }else{

            $form = $formFactory->createBuilder()
                ->add('Title', 'text', array(
                    'constraints' => array(
                        new NotBlank(),
                        new Length(array('min' => 4)),
                    ),
                ))
                ->add('Description', 'text', array(
                    'constraints' => array(
                        new NotBlank(),
                        new Length(array('min' => 4)),
                    ),
                ))
                ->getForm();

        }

        if (isset($_POST[$form->getName()])) {
            $form->submit($_POST[$form->getName()]);
            if ($form->isValid()) {


                $todo = new Todo();

                $todo->setTitle($form['Title']->getData());
                $todo->setDescription($form['Description']->getData());

                $em = $this->getDoctrine()->getManager();

                // tells Doctrine you want to (eventually) save the Product (no queries yet)
                $em->persist($todo);

                // actually executes the queries (i.e. the INSERT query)
                $em->flush();


                $repository = $this->getDoctrine()->getRepository('AppBundle:Todo');
                $allTodo=  $repository->findAll();

                return $this->render('layouts/todo.html.twig', array(
                    'form' => $form->createView(),
                    'allTodo' => $allTodo,
                ));
            }
        }

        $repository = $this->getDoctrine()->getRepository('AppBundle:Todo');
        $allTodo=  $repository->findAll();

        return $this->render('layouts/todo.html.twig', array(
            'form' => $form->createView(),
            'allTodo' => $allTodo,
        ));

    }

    /**
     * @Route("/deleteTodo/{todo_id}", name="deleteTodo")
     */
    public function deleteTodoAction($todo_id, Request $request)
    {

        $em = $this->getDoctrine()->getEntityManager();
        $todo = $em->getRepository('AppBundle:Todo')->find($todo_id);
        $em->remove($todo);
        $em->flush();

        return $this->redirect($this->generateUrl('todo'));
    }



}
