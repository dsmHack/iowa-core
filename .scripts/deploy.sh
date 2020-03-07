#!/bin/sh

git ftp catchup --user $FTP_USERNAME --passwd $FTP_PASSWORD ftp://$FTP_HOSTNAME:$FTP_PORT/rethinkiowa.org/public_html/wp-content/themes/iowa-core
travis_terminate 0
