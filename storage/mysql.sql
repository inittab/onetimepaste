/* WARNING:

File storage takes *about twice* the original file size.

Since v2.0 default column type for "message" (stores messages AND files) is
MEDIUMBLOB (that's a 16MB max. field) and you shouldn't accept files bigger
than 5-6MB files. You can change the column to LONGBLOB (4G max. field), but
you should probably consider using the "textfile" backend if you plan to accept
files bigger than 5-6MB.

*/
CREATE TABLE pastes (
	id char(20) NOT NULL,
	message mediumblob NOT NULL,
	time timestamp NOT NULL,
	PRIMARY KEY(id)
) CHARSET=utf8;

