#!/bin/bash
case $2 in
    ''|*[!0-9]*) let boundary=100 ;;
    *) let boundary=$2 ;;
esac
currreqs=$(echo "show stat" | sudo socat unix-connect:/tmp/haproxy stdio|grep http_web,FRONTEND| cut -d ',' -f 47)
if [ "$3" == "1" ]
then
        while [ $currreqs -ge $boundary ]
        do
                currreqs=$(echo "show stat" | sudo socat unix-connect:/tmp/haproxy stdio|grep http_web,FRONTEND| cut -d ',' -f 47)
                sleep 0.1
        done
else
        while [ $currreqs -le $boundary ]
        do
                currreqs=$(echo "show stat" | sudo socat unix-connect:/tmp/haproxy stdio|grep http_web,FRONTEND| cut -d ',' -f 47)
                sleep 0.1
        done
fi
php /var/www/files/swap_files/swap.php $1
