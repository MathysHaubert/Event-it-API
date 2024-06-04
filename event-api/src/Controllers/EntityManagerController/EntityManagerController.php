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
use App\Entity\Faq;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\Exception\ORMException;
use OpenApi\Annotations as OA;
use App\Tools\JWT;

class EntityManagerController extends AbstractController
{
    public function __construct()
    {
        parent::__construct();
    }

    const entity = [
        'user' => User::class,
        'capteur' => Capteur::class,
        'CapteurArchive' => CapteurArchive::class,
        'forum' => Forum::class,
        'ForumMessage' => ForumMessage::class,
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
     *             enum={"user", "capteur", "CapteurArchive", "forum", "ForumMessage", "organization", "reservation", "room", "status", "currentUser", "faq"}
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
            case("faq"):
                $repo = $this->entityManager->getRepository(Faq::class);
                $dataResponse = $repo->findBy($params);
                break;
            case("currentUser"):
                $headers = getallheaders();
                $token = $headers['Authorization'];
                $jwt = new JWT();
                $id = $jwt->decode($token)['id'];
                $user = $this->entityManager->getRepository(User::class)->find($id);
                $response = new JSONResponse($user);
                $response->send();
                break;
            case("capteur"):
                $repo = $this->entityManager->getRepository(Capteur::class);
                $dataResponse = $repo->findBy($params);
                break;
            case("CapteurArchive"):
                $repo = $this->entityManager->getRepository(CapteurArchive::class);
                $dataResponse = $repo->findBy($params);
                break;
            case("forum"):
                $repo = $this->entityManager->getRepository(Forum::class);
                $dataResponse = $repo->findBy($params);
                break;
            case("ForumMessage"):
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
            default:
                $dataResponse = "Entity not found";
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
     *             enum={"user", "capteur", "CapteurArchive", "forum", "ForumMessage", "organization", "reservation", "room", "status", "faq"}
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
                        if($name === "organization"){
                            $organization = $this->entityManager->getRepository(Organization::class)->find($value);
                            if($organization === NULL){
                                throw new \Exception("Organization does not exist");
                                break;
                            }
                            $newEntity->setOrganization($organization);
                            continue;
                        }
                        $setter = 'set' . ucfirst($name);
                        $newEntity->$setter($value);
                    }
                    break;
                case("faq"):
                    $newEntity = new Faq();
                    foreach ($params as $name => $value) {
                        $setter = 'set' . ucfirst($name);
                        $newEntity->$setter($value);
                    }
                    break;
                case ("capteur"):
                    $newEntity = new Capteur();
                    $newEntity->setTakenAt(new \DateTime('now'));
                    foreach ($params as $name => $value) {
                        if($name === "room"){
                            $room = $this->entityManager->getRepository(Room::class)->find($value);
                            if($room === NULL){
                                throw new \Exception("Room does not exist");
                                break;
                            }
                            $newEntity->setRoom($room);
                            continue;
                        }
                        $setter = 'set' . ucfirst($name);
                        $newEntity->$setter($value);
                    }
                    break;
                case ("CapteurArchive"):
                    $newEntity = new CapteurArchive();
                    foreach ($params as $name => $value) {
                        if($name === "reservation"){
                            $reservation = $this->entityManager->getRepository(Reservation::class)->find($value);
                            if($reservation === NULL){
                                throw new \Exception("Reservation does not exist");
                                break;
                            }
                            $newEntity->setReservation($reservation);
                            continue;
                        }
                        $setter = 'set' . ucfirst($name);
                        $newEntity->$setter($value);
                    }
                    break;
                case ("forum"):
                    $newEntity = new Forum();
                    $newEntity->setLastModified(new \DateTime('now'));
                    foreach ($params as $name => $value) {
                        $setter = 'set' . ucfirst($name);
                        $newEntity->$setter($value);
                    }
                    break;
                case ("ForumMessage"):
                    $newEntity = new ForumMessage();
                    foreach ($params as $name => $value) {
                        if($name === "forum"){
                            $forum = $this->entityManager->getRepository(Forum::class)->find($value);
                            if($forum === NULL){
                                throw new \Exception("Forum does not exist");
                                break;
                            }
                            $newEntity->setForum($forum);
                            continue;
                        }
                        if($name === "user"){
                            $user = $this->entityManager->getRepository(User::class)->find($value);
                            if($user === NULL){
                                throw new \Exception("User does not exist");
                                break;
                            }
                            $newEntity->setUser($user);
                            continue;
                        }
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
                    $newEntity->setStartAt(new \DateTime($params['startAt']));
                    $newEntity->setEndAt(new \DateTime($params['endAt']));
                    $room = $this->entityManager->getRepository(Room::class)->find($params['room']);
                    if($room === NULL){
                        throw new \Exception("Room does not exist");
                    }
                    $newEntity->setRoom($room);
                    $organization = $this->entityManager->getRepository(Organization::class)->find($params['organization']);
                    if($organization === NULL){
                        throw new \Exception("Organization does not exist");
                    }
                    $newEntity->setOrganization($organization);
                    break;
                case ("room"):
                    $newEntity = new Room();
                    $newEntity->setLocation($params['location']);
                    $newEntity->setIntegratedAt(new \DateTime($params['integratedAt']));
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
     * @OA\Patch(
     *     path="/{entity}",
     *     @OA\Parameter(
     *         name="entity",
     *         in="path",
     *         required=true,
     *         description="Entity name",
     *         @OA\Schema(
     *             type="string",
     *             enum={"user", "capteur", "CapteurArchive", "forum", "ForumMessage", "organization", "reservation", "room", "status", "faq"}
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Create the entity",
     *     )
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
                        if($name === "id") { // not a big fan of this will have to make it work via the url
                            continue;
                        }
                        $setter = 'set' . ucfirst($name);
                        if ($name === "organization") {
                            if (is_array($value) && isset($value['id'])) {
                                $orgRepo = $this->entityManager->getRepository(Organization::class);
                                $organization = $orgRepo->find($value['id']);
                                if ($organization) {
                                    $entity->$setter($organization);
                                }
                            }
                            // Skip setting organization if no valid ID is provided
                            continue;
                        }
                        $entity->$setter($value);
                    }
                    break;
                case ("capteur"):
                    $repo = $this->entityManager->getRepository(Capteur::class);
                    $entity = $repo->find($params['id']);
                    foreach ($params as $name => $value) {
                        if($name === "id"){     //not a big fan of this will have to make it work via the url
                            continue;
                        }
                        $setter = 'set' . ucfirst($name);
                        $entity->$setter($value);
                    }
                    break;
                case ("CapteurArchive"):
                    $repo = $this->entityManager->getRepository(CapteurArchive::class);
                    $entity = $repo->find($params['id']);
                    foreach ($params as $name => $value) {
                        if($name === "id"){     //not a big fan of this will have to make it work via the url
                            continue;
                        }
                        $setter = 'set' . ucfirst($name);
                        $entity->$setter($value);
                    }
                    break;
                case ("forum"):
                    $repo = $this->entityManager->getRepository(Forum::class);
                    $entity = $repo->find($params['id']);
                    foreach ($params as $name => $value) {
                        if($name === "id"){     //not a big fan of this will have to make it work via the url
                            continue;
                        }
                        $setter = 'set' . ucfirst($name);
                        $entity->$setter($value);
                    }
                    break;
                case ("ForumMessage"):
                    $repo = $this->entityManager->getRepository(ForumMessage::class);
                    $entity = $repo->find($params['id']);
                    foreach ($params as $name => $value) {
                        if($name === "id"){     //not a big fan of this will have to make it work via the url
                            continue;
                        }
                        $setter = 'set' . ucfirst($name);
                        $entity->$setter($value);
                    }
                    break;
                case ("organization"):
                    $repo = $this->entityManager->getRepository(Organization::class);
                    $entity = $repo->find($params['id']);
                    foreach ($params as $name => $value) {
                        if($name === "id"){     //not a big fan of this will have to make it work via the url
                            continue;
                        }
                        $setter = 'set' . ucfirst($name);
                        $entity->$setter($value);
                    }
                    break;
                case ("reservation"):
                    $repo = $this->entityManager->getRepository(Reservation::class);
                    $entity = $repo->find($params['id']);
                    foreach ($params as $name => $value) {
                        if($name === "id"){     //not a big fan of this will have to make it work via the url
                            continue;
                        }
                        $setter = 'set' . ucfirst($name);
                        $entity->$setter($value);
                    }
                    break;
                case ("room"):
                    $repo = $this->entityManager->getRepository(Room::class);
                    $entity = $repo->find($params['id']);
                    foreach ($params as $name => $value) {
                        if($name === "id"){     //not a big fan of this will have to make it work via the url
                            continue;
                        }
                        $setter = 'set' . ucfirst($name);
                        $entity->$setter($value);
                    }
                    break;
                case ("faq"):
                    $repo = $this->entityManager->getRepository(Faq::class);
                    $entity = $repo->find($params['id']);
                    foreach ($params as $name => $value) {
                        if($name === "id"){     //not a big fan of this will have to make it work via the url
                            continue;
                        }
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
            /**
     * @OA\Delete(
     *     path="/{entity}",
     *     @OA\Parameter(
     *         name="entity",
     *         in="path",
     *         required=true,
     *         description="Entity name",
     *         @OA\Schema(
     *             type="string",
     *             enum={"user", "capteur", "CapteurArchive", "forum", "ForumMessage", "organization", "reservation", "room", "status","faq"}
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Delete the entity",
     *     )
     * )
     * @throws ORMException
     */
    public function deleteEntity(array $params) {
        $errorAttr = "";
        $errorNameEntity = "";
        $dataResponse = "Someting get wrong";
        $entity = $this->extractEntity();
        echo print_r($params,true);
        echo print_r($entity,true);
        switch($entity){
            case ('faq'):
                $faqEntities = $this->entityManager->getRepository(Faq::class)->findOneBy(["question" => $params['question'],"answer" => $params['answer']]);
                echo print_r($faqEntities);
                $this->entityManager->remove($faqEntities);
                break;
        }
    }
}