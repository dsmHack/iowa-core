#!/bin/sh

git ftp init --user $SFTP_USERNAME --passwd $SFTP_PASSWORD ftp://$SFTP_HOSTNAME:$SFTP_PORT/rethinkiowa.org/public_html/wp-content/themes/iowa-core
