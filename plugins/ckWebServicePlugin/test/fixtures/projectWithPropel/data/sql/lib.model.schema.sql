
-----------------------------------------------------------------------------
-- article
-----------------------------------------------------------------------------

DROP TABLE [article];


CREATE TABLE [article]
(
	[id] INTEGER  NOT NULL PRIMARY KEY,
	[title] VARCHAR(255)  NOT NULL,
	[content] MEDIUMTEXT
);

-----------------------------------------------------------------------------
-- article_comment
-----------------------------------------------------------------------------

DROP TABLE [article_comment];


CREATE TABLE [article_comment]
(
	[id] INTEGER  NOT NULL PRIMARY KEY,
	[article_id] INTEGER  NOT NULL,
	[author] VARCHAR(255)  NOT NULL,
	[content] MEDIUMTEXT
);

-- SQLite does not support foreign keys; this is just for reference
-- FOREIGN KEY ([article_id]) REFERENCES article ([id])

-----------------------------------------------------------------------------
-- author
-----------------------------------------------------------------------------

DROP TABLE [author];


CREATE TABLE [author]
(
	[id] INTEGER  NOT NULL PRIMARY KEY,
	[name] VARCHAR(255)  NOT NULL
);

-----------------------------------------------------------------------------
-- article_author
-----------------------------------------------------------------------------

DROP TABLE [article_author];


CREATE TABLE [article_author]
(
	[article_id] INTEGER  NOT NULL,
	[author_id] INTEGER  NOT NULL,
	PRIMARY KEY ([article_id],[author_id])
);

-- SQLite does not support foreign keys; this is just for reference
-- FOREIGN KEY ([article_id]) REFERENCES article ([id])

-- SQLite does not support foreign keys; this is just for reference
-- FOREIGN KEY ([author_id]) REFERENCES author ([id])
