<?php
/**
 * Home Controller
 *
 * @category Class
 * @package  App
 */
namespace App\Controllers;

use App\Domain\Entity\User;
use App\Domain\Exception\FormInvalidException;
use App\Domain\Exception\ValidationException;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\IDUnset;
use App\Domain\ValueObject\Key;
use App\Domain\ValueObject\Password;
use App\Presenter\Molecule\Form\FormPresenter;
use Silex\Application;
use Solution10\Config\Exception;
use Symfony\Component\HttpFoundation\Request;
use DateTime;

/**
 * For the 'User' paths
 */
class UsersController extends Controller
{

    private $userService;

    protected function pre()
    {
        $this->userService = $this->getServiceFactory()
            ->createService('Users');
    }

    /**
     * User List (/users)
     * @param Request $request
     * @return string
     */
    public function listAction(Request $request)
    {
        $perPage = 1;

        $users = $this->userService
            ->findLatest($perPage, $this->getCurrentPage($request));

        $this->set('users', $users->getDomainModels());
        $this->set('total', $users->getTotal());

        return $this->render($request, 'users/list');
    }

    /**
     * @param Request $request
     * @return string
     */
    public function showAction(Request $request)
    {
        $key = $request->get('user_key');
        $user = $this->userService
            ->findByKey(new Key($key));

        if (!$user) {
            $this->app->abort(404, 'User ' . $key . ' does not exist.');
        }

        $this->set('user', $user);
        return $this->render($request, 'users/show');
    }

    /**
     * @param Request $request
     * @return string
     */
    public function newAction(Request $request)
    {
        if ($request->getMethod() == 'POST') {
            $form = new FormPresenter($request->request->all());

            try {
                // separate try/catch for each item, to test it
                $name = $form->get('userName');
                try {
                    $email = new Email($form->get('userEmail'));
                } catch (ValidationException $e) {
                    $form->addValidationError('userEmail', $e->getMessage());
                    throw new FormInvalidException;
                }

                $creationTime = new DateTime();

                $temporaryPassword = md5(time());

                $user = new User(
                    new IDUnset(),
                    $creationTime,
                    $creationTime,
                    $name,
                    $email,
                    new Password($temporaryPassword),
                    true // password is already expired
                );

                $user = $this->userService->createNewUser($user);

                // @todo - send the user a welcome e-mail

                // @todo set flash message
                return $this->app->redirect(
                    $this->app["url_generator"]->generate(
                        'users_show',
                        [
                            'user_key' => $user->getKey()
                        ]
                    )
                );

            } catch (ValidationException $e) {
                // do nothing, let the page load the orginal form
                //$this->messages->add('There was an error with the form');
            } catch (FormInvalidException $e) {
                // do nothing, let the page load the orginal form
                //$this->messages->add('There was an error with the form');
            } catch (Exception $e) {
                //$this->messages->add('There was a save error');
            }
        } else {
            $form = new FormPresenter();
        }

        $this->set('form', $form);
        return $this->render($request, 'users/new');
    }
}
