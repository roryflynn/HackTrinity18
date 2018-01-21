#!/bin/sh

if [ -n "$DATABASE_URL" ]
    then
    # https://stackoverflow.com/a/29793382
    echo "Waiting on MySQL"
    while ! mysqladmin ping -h db --silent; do
        # Show some progress
        echo -n '.';
        sleep 1;
    done
    echo "Ready"
    # Give it another second.
    sleep 1;
fi

# wait-for-postgres.sh

# set -e

# host="$1"
# shift
# cmd="$@"

# until psql -d "postgres://ctfd:ctfd@db/ctfd" -c '\q'; do
#   >&2 echo "Postgres is unavailable - sleeping"
#   sleep 1
# done

# >&2 echo "Postgres is up - executing command"

echo "Starting CTFd"
gunicorn --bind 0.0.0.0:8000 -w 1 'CTFd:create_app()' --access-logfile '/opt/CTFd/CTFd/logs/access.log' --error-logfile '/opt/CTFd/CTFd/logs/error.log'
