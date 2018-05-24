#!/usr/bin/env bash
if [ "x$1" == "x" ]
then
	echo "Need to insert a commit comment!"
	exit
fi
git add .
git commit -m "$@"
git push origin master
