FROM ubuntu:latest
LABEL authors="Mathys"

ENTRYPOINT ["top", "-b"]