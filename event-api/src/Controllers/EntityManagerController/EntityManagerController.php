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
     */

    public function entity(array $params)
    {
        $dataResponse = "";
        if (array_key_exists("get",$params)) {
            foreach ($params["get"] as $name => $value)
            if ($value === "example") {
                $repo = $this->entityManager->getRepository(User::class);
                $dataResponse = $repo->findBy(["email" => "toto@example.com"]); // TODO: implement findBy to search for a specifi entity
            }

        }
        if (array_key_exists("create",$params)) {
            foreach ($params["create"] as $name => $value) {
                switch($name) {
                    case ("user"):
                        if ($value === "example") {
                            $user = new User();
                            $user->setLastConnection(new \DateTime('now'));
                            $user->setPassword("toto");
                            $user->setEmail("toto@example.com");
                            $this->entityManager->persist($user);
                            $this->entityManager->flush();
                        } else {
                            //TODO: return the right user
                        }
                        break;
                }
            }
        }
        $response = new JSONResponse($dataResponse);
        $response->send();
    }
}