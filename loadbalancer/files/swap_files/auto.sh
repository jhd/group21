#!/bin/bash
readarray algos < ./algorithms.txt
case $1 in
    ''|*[!0-9]*) let interval=5 ;;
    *) let interval=$1 ;;
esac
i="0"
while [ "${algos[$i]}" != "" ]
do
	php /var/www/files/swap_files/swap.php ${algos[$i]}
	let "i=i+1"
	sleep $interval
done
