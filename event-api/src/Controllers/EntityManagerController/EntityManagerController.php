<?php

namespace App\Controllers\EntityManagerController;

use App\Controllers\AbstractController;
use App\Entity\ForumMessage;
use App\Tools\JSONResponse;
use App\Entity\User;
use App\Entity\Forum;
use App\Entity\Capteur;
use App\Entity\CapteurArchive;
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
        'capteur' => Capteur::class,
        'capteurArchive' => CapteurArchive::class,
        'forum' => Forum::class,
        'forumMessage' => ForumMessage::class,
        'organization' => Organization::class,
        'reservation' => Reservation::class,
        'room' => Room::class,
    ];

    /**
     * @OA\Get(
     *     path="/{entity}",
     *     @OA\Parameter(
     *         name="entity",
     *         in="path",
     *         required=true,
     *         description="Entity name",
     *         @OA\Schema(
     *             type="string",
     *             enum={"user", "capteur", "capteurArchive", "forum", "forumMessage", "organization", "reservation", "room", "status"}
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Request an entity to the API",
     *     )
     * )
     */

    public function getEntity(array $params): void
    {
        $entity = $this->extractEntity();
        $dataResponse = "";
        switch ($entity) {
            case("user"):
                $repo = $this->entityManager->getRepository(User::class);
                $dataResponse = $repo->findBy($params);
                break;
            case("capteur"):
                $repo = $this->entityManager->getRepository(Capteur::class);
                $dataResponse = $repo->findBy($params);
                break;
            case("capteurArchive"):
                $repo = $this->entityManager->getRepository(CapteurArchive::class);
                $dataResponse = $repo->findBy($params);
                break;
            case("forum"):
                $repo = $this->entityManager->getRepository(Forum::class);
                $dataResponse = $repo->findBy($params);
                break;
            case("forumMessage"):
                $repo = $this->entityManager->getRepository(ForumMessage::class);
                $dataResponse = $repo->findBy($params);
                break;
            case("organization"):
                $repo = $this->entityManager->getRepository(Organization::class);
                $dataResponse = $repo->findBy($params);
                break;
            case("reservation"):
                $repo = $this->entityManager->getRepository(Reservation::class);
                $dataResponse = $repo->findBy($params);
                break;
            case("room"):
                    $repo = $this->entityManager->getRepository(Room::class);
                $dataResponse = $repo->findBy($params);
                break;
        }

        $response = new JSONResponse($dataResponse);
        $response->send();
    }

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
     *             enum={"user", "capteur", "capteurArchive", "forum", "forumMessage", "organization", "reservation", "room", "status"}
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Create the entity",
     *     )
     * )
     * @throws ORMException
     */
    public function createEntity(array $params): void
    {
        $errorAttr = "";
        $errorNameEntity = "";
        $dataResponse = "Someting get wrong";
        $entity = $this->extractEntity();
        try {
            switch ($entity) {
                case ("user"):
                    $newEntity = new User();
                    $newEntity->setCreatedAt(new \DateTime('now'));
                    $newEntity->setLastConnection(new \DateTime('now'));
                    foreach ($params as $name => $value) {
                        $setter = 'set' . ucfirst($name);
                        $newEntity->$setter($value);
                    }
                    break;
                case ("capteur"):
                    $newEntity = new Capteur();
                    foreach ($params as $name => $value) {
                        $setter = 'set' . ucfirst($name);
                        $newEntity->$setter($value);
                    }
                    break;
                case ("capteurArchive"):
                    $newEntity = new capteurArchive();
                    foreach ($params as $name => $value) {
                        $setter = 'set' . ucfirst($name);
                        $newEntity->$setter($value);
                    }
                    break;
                case ("forum"):
                    $newEntity = new Forum();
                    foreach ($params as $name => $value) {
                        $setter = 'set' . ucfirst($name);
                        $newEntity->$setter($value);
                    }
                    break;
                case ("forumMessage"):
                    $newEntity = new ForumMessage();
                    foreach ($params as $name => $value) {
                        $setter = 'set' . ucfirst($name);
                        $newEntity->$setter($value);
                    }
                    break;
                case ("organization"):
                    $newEntity = new Organization();
                    foreach ($params as $name => $value) {
                        $setter = 'set' . ucfirst($name);
                        $newEntity->$setter($value);
                    }
                    break;
                case ("reservation"):
                    $newEntity = new Reservation();
                    foreach ($params as $name => $value) {
                        $setter = 'set' . ucfirst($name);
                        $newEntity->$setter($value);
                    }
                    break;
                case ("room"):
                    $newEntity = new Room();
                    foreach ($params as $name => $value) {
                        $setter = 'set' . ucfirst($name);
                        $newEntity->$setter($value);
                    }
                    break;
            }
            $this->entityManager->persist($newEntity);
            $this->entityManager->flush();
            $dataResponse = true;
        } catch (Exception $exception) {
            $error = ["error" => []];
            $error['message'] = sprintf('%s', $exception);
            $response = new JSONResponse($error);
            $response->send();
        }
        $response = new JSONResponse($dataResponse);
        $response->send();
    }

    /**
     * @OA/Update(
     *    path="/{entity}",
     *   @OA\Parameter(
     *        name="entity",
     *       in="path",
     *      required=true,
     *    description="Entity name",
     *  @OA\Schema(
     *     type="string",
     *   enum={"user", "capteur", "capteurArchive", "forum", "forumMessage", "organization", "reservation", "room", "status"}
     * )
     * ),
     * @OA\Response(
     *    response="200",
     *  description="Update the entity",
     * )
     * )
     * @throws ORMException
     */
    public function updateEntity(array $params): void
    {
        $entity = $this->extractEntity();
        $dataResponse = "Someting get wrong";
        try {
            switch ($entity) {
                case ("user"):
                    $repo = $this->entityManager->getRepository(User::class);
                    $entity = $repo->find($params['id']);
                    foreach ($params as $name => $value) {
                        $setter = 'set' . ucfirst($name);
                        $entity->$setter($value);
                    }
                    break;
                case ("capteur"):
                    $repo = $this->entityManager->getRepository(Capteur::class);
                    $entity = $repo->find($params['id']);
                    foreach ($params as $name => $value) {
                        $setter = 'set' . ucfirst($name);
                        $entity->$setter($value);
                    }
                    break;
                case ("capteurArchive"):
                    $repo = $this->entityManager->getRepository(CapteurArchive::class);
                    $entity = $repo->find($params['id']);
                    foreach ($params as $name => $value) {
                        $setter = 'set' . ucfirst($name);
                        $entity->$setter($value);
                    }
                    break;
                case ("forum"):
                    $repo = $this->entityManager->getRepository(Forum::class);
                    $entity = $repo->find($params['id']);
                    foreach ($params as $name => $value) {
                        $setter = 'set' . ucfirst($name);
                        $entity->$setter($value);
                    }
                    break;
                case ("forumMessage"):
                    $repo = $this->entityManager->getRepository(ForumMessage::class);
                    $entity = $repo->find($params['id']);
                    foreach ($params as $name => $value) {
                        $setter = 'set' . ucfirst($name);
                        $entity->$setter($value);
                    }
                    break;
                case ("organization"):
                    $repo = $this->entityManager->getRepository(Organization::class);
                    $entity = $repo->find($params['id']);
                    foreach ($params as $name => $value) {
                        $setter = 'set' . ucfirst($name);
                        $entity->$setter($value);
                    }
                    break;
                case ("reservation"):
                    $repo = $this->entityManager->getRepository(Reservation::class);
                    $entity = $repo->find($params['id']);
                    foreach ($params as $name => $value) {
                        $setter = 'set' . ucfirst($name);
                        $entity->$setter($value);
                    }
                    break;
                case ("room"):
                    $repo = $this->entityManager->getRepository(Room::class);
                    $entity = $repo->find($params['id']);
                    foreach ($params as $name => $value) {
                        $setter = 'set' . ucfirst($name);
                        $entity->$setter($value);
                    }
                    break;
            }
            $this->entityManager->flush();
            $dataResponse = true;
        } catch (Exception $exception) {
            $error = ["error" => []];
            $error['message'] = sprintf('%s', $exception);
            $response = new JSONResponse($error);
            $response->send();
        }
        $response = new JSONResponse($dataResponse);
        $response->send();
    }

    private function extractEntity(): string
    {
        return str_replace("/", "", $_SERVER['REQUEST_URI']);
    }
}