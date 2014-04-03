#!/bin/bash
case $2 in
    ''|*[!0-9]*) let boundary=100 ;;
    *) let boundary=$2 ;;
esac
currconns=$(echo "show info" | socat unix-connect:/tmp/haproxy stdio | sed -n 's/CurrConns: //p')
if [ "$3" == "1" ]
then
	while [ $currconns -ge $boundary ]
	do
		currconns=$(echo "show info" | socat unix-connect:/tmp/haproxy stdio | sed -n 's/CurrConns: //p')
		sleep 0.1
	done
else
	while [ $currconns -le $boundary ]
	do
		currconns=$(echo "show info" | socat unix-connect:/tmp/haproxy stdio | sed -n 's/CurrConns: //p')
		sleep 0.1
	done
fi
php /var/www/files/swap_files/swap.php $1
