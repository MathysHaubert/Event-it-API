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

    public function check()
    {
        header('Content-Type: application/json; charset=utf-8');
        $response = new JSONResponse(true);
        $response->send();
    }
}