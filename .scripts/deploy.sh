#!/bin/sh

sudo apt-get install git-ftp
git ftp init --user $FTP_USERNAME --passwd $FTP_PASSWORD ftp://$FTP_HOSTNAME:$FTP_PORT/rethinkiowa.org/public_html/wp-content/themes/iowa-core
