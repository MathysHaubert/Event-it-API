<?php

namespace App\Controllers\EntityManagerController;

use App\Controllers\AbstractController;
use App\Entity\ForumMessage;
use App\Tools\JSONResponse;
use App\Entity\User;
use App\Entity\Forum;
use App\Entity\Capteurs;
use App\Entity\Organization;
use App\Entity\Reservation;
use App\Entity\Room;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\Exception\ORMException;
use OpenApi\Annotations as OA;

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
        'forum_message' => ForumMessage::class,
        'organization' => Organization::class,
        'reservation' => Reservation::class,
        'room' => Room::class,
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

    public function entity(array $params): void
    {
        $errorAttr = "";
        $errorNameEntity = "";
        $dataResponse = "";
        if (array_key_exists("get", $params)) {
            foreach ($params["get"] as $nameEntity => $values)
                switch ($nameEntity) {
                    case("user"):
                        $repo = $this->entityManager->getRepository(User::class);
                        $dataResponse = $repo->findBy($params['get']['user']);
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
                                    case ('created_at'):
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
                            $dataResponse = true;
                            break;
                    }
                }catch(Exception $exception) {
                    $error = ["error" => []];
                    $message = sprintf('%s is not defined as attribute of %s: %s',$errorAttr,$errorNameEntity,$exception);
                }
            }

        }
        $response = new JSONResponse($dataResponse);
        $response->send();
    }
}