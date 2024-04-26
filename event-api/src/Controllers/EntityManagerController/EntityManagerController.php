<?php

namespace App\Controllers\EntityManagerController;

use App\Controllers\AbstractController;
use App\Tools\JSONResponse;
use App\Entity\User;
use App\Entity\Forum;
use App\Entity\Forum_message;
use App\Entity\Capteurs;
use App\Entity\Organization;
use App\Entity\Reservation;
use App\Entity\Room;
use App\Entity\Status;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\Exception\ORMException;
use OpenApi\Annotations as OA;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

class EntityManagerController extends AbstractController
{

    public function __construct()
    {
        parent::__construct();
    }

    const entity = [
        'user' => User::class,
        'capteur' => Capteurs::class,
        'forum' => Forum::class,
        'forum_message' => Forum_message::class,
        'organization' => Organization::class,
        'reservation' => Reservation::class,
        'room' => Room::class,
        'status' => Status::class,
    ];

    /**
     * @OA\Post(
     *     path="/{entity}",
     *     @OA\Parameter(
     *         name="entity",
     *         in="path",
     *         required=true,
     *         description="Entity name",
     *         @OA\Schema(
     *             type="string",
     *             enum={"user", "capteur", "forum", "forum_message", "organization", "reservation", "room", "status"}
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Check if the connection is working.",
     *         @OA\JsonContent(
     *             type="string",
     *             description="Connection status",
     *         )
     *     )
     * )
     * @throws ORMException
     */

    public function entity(array $params)
    {
        $errorAttr = "";
        $errorNameEntity = "";
        $dataResponse = "";
        if (array_key_exists("get", $params)) {
            foreach ($params["get"] as $nameEntity => $values)
                switch ($nameEntity) {
                    case("user"):
                        $repo = $this->entityManager->getRepository(User::class);
                        $dataResponse = $repo->findAll();
                }

        }
        if (array_key_exists("create", $params)) {
            foreach ($params["create"] as $name => $value) {
                try {
                    switch ($name) {
                        case ("user"):
                            $newUser = new User();
                            $newUser->setCreatedAt(new \DateTime('now'));
                            $newUser->setLastConnection(new \DateTime('now'));
                            foreach ($params['create']['user'] as $nameAttr => $valueAttr) {
                                switch ($nameAttr) {
                                    case('last_connection'):
                                        break;
                                    default:
                                        try{
                                            $setter = 'set' . ucfirst($nameAttr);
                                            $newUser->$setter($valueAttr);
                                        } catch (\Exception $e){
                                            $errorAttr = $nameAttr;
                                            $errorNameEntity = 'user';
                                        }

                                }
                            }
                            $this->entityManager->persist($newUser);
                            $this->entityManager->flush();
                            $this->entityManager->refresh($newUser);
                            break;
                    }
                }catch(Exception $exception) {
                    $error = printf('%s is not defined as attribute of %s: %s',$errorAttr,$errorNameEntity,$exception);
                }
            }

        }
        $response = new JSONResponse($dataResponse);
        $response->send();
    }
}