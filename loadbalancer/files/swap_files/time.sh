#!/bin/bash
case $3 in
    ''|*[!0-9]*) let interval=5 ;;
    *) let interval=$3 ;;
esac
php /var/www/files/swap_files/swap.php $1
sleep $interval
php /var/www/files/swap_files/swap.php $2
