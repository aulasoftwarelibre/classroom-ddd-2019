#!/bin/sh
set -e

echo ">> Waiting for database to start"
WAIT=0
while ! nc -z database 5432; do
  sleep 1
  echo "   database not ready yet"
  WAIT=$(($WAIT + 1))
  if [ "$WAIT" -gt 20 ]; then
    echo "Error: Timeout when waiting for database socket"
    exit 1
  fi
done

echo ">> database socket available, resuming command execution"

"$@"
