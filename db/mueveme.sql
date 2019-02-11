------------------------------
-- Archivo de base de datos --
------------------------------

DROP TABLE IF EXISTS usuarios CASCADE;

CREATE TABLE usuarios
(
    id            BIGSERIAL          PRIMARY KEY
  , nombre        VARCHAR(32)        NOT NULL UNIQUE
  , password      VARCHAR(60)        NOT NULL
);

DROP TABLE IF EXISTS comentarios CASCADE;

CREATE TABLE comentarios
(
    id          BIGSERIAL     PRIMARY KEY
  , opinion     TEXT
  , usuario_id  BIGINT        REFERENCES usuarios (id)
                              ON DELETE NO ACTION
                              ON UPDATE CASCADE
  , noticia_id  BIGINT        REFERENCES noticias (id)
                              ON DELETE NO ACTION
                              ON UPDATE CASCADE
  , created_at  DATE          NOT NULL DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS categorias CASCADE;

CREATE TABLE categorias
(
    id          BIGSERIAL    PRIMARY KEY
  , categoria   VARCHAR(255) NOT NULL UNIQUE
);

DROP TABLE IF EXISTS noticias CASCADE;

CREATE TABLE noticias
(
    id               BIGSERIAL         PRIMARY KEY
  , titulo           VARCHAR(255)      NOT NULL
  , votos            NUMERIC(9)        NOT NULL DEFAULT 0
  , extracto         TEXT
  , categoria_id     BIGINT            NOT NULL
                                       REFERENCES categorias (id)
                                       ON DELETE NO ACTION
                                       ON UPDATE CASCADE
  , usuario_id       BIGINT            REFERENCES usuarios (id)
                                       ON DELETE NO ACTION
                                       ON UPDATE CASCADE
  , created_at       DATE              DEFAULT CURRENT_TIMESTAMP
);

-- INSERTS

INSERT INTO usuarios (nombre, password)
VALUES ('admin', crypt('admin', gen_salt('bf', 10)));

INSERT INTO noticias (titulo, extracto, usuario_id)
VALUES ('Zugasti, el terror del bandolerismo', 'Si para la historia han
 quedado los nombres y hechos de un gran número de bandoleros, este...', 1);

INSERT INTO comentarios (opinion, usuario_id, noticia_id)
VALUES ('Que mala noticia', 1, 1);
