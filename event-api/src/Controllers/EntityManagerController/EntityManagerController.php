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

class EntityManagerController extends AbstractController
{
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
     * @OA\Get(
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
     *     @OA\Parameter(
     *          name="params",
     *          in="query",
     *          required=true,
     *          description="parameters to find the entity",
     *          @OA\Schema(
     *              type="string",
     *              enum={"lastname","firstname","email","id","client_id","organization_id","location","integratedAt","post_number","name","userId","statusId","forumId","like","message","resolved","primaryMessage"}
     *          )
     *      ),
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

    public function getEntity(array $params)
    {
        header('Content-Type: application/json; charset=utf-8');
        $response = new JSONResponse($params);
        $response->send();
    }
}