#!/bin/sh

git config git-ftp.url "$FTP_HOSTNAME:$(echo $FTP_PORT)"
git config git-ftp.user "$FTP_USERNAME"
git config git-ftp.password "$FTP_PASSWORD"
git ftp catchup
