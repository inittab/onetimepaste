
CREATE TABLE pastes (
	id char(20) NOT NULL,
	message blob NOT NULL,
	time timestamp NOT NULL,
	PRIMARY KEY(id)
) CHARSET=utf8;

