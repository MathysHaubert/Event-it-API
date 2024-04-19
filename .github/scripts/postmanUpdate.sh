#!/bin/bash

API_KEY=$1

COLLECTION_ID=33172307-36d404e3-d455-4e6e-a0de-2b51e3374852

NEW_COLLECTION_FILE=./postmanUpdate/newCollection.json

php ./postmanUpdate/updateCollection > $NEW_COLLECTION_FILE

curl -v -X PUT \
    -H "Content-Type: application/json" \
    -H "X-Api-Key: $API_KEY" \
    -d "@$NEW_COLLECTION_FILE" \
    "https://api.getpostman.com/collections/$COLLECTION_ID"