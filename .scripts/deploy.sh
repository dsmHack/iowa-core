#!/bin/sh

git ftp push -v --user $FTP_USERNAME --passwd $FTP_PASSWORD ftp://$FTP_HOSTNAME:$FTP_PORT/rethinkiowa.org/public_html/wp-content/themes/iowa-core
