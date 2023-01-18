#!/bin/bash

# Comprobamos que se haya pasado un parámetro
if [ -z "$1" ]
then
    echo "Error: No se ha pasado ningún parámetro"
    exit 1
fi

# Reproducimos la canción con VLC
nvlc "$1"
