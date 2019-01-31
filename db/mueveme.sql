------------------------------
-- Archivo de base de datos --
------------------------------

CREATE TABLE usuarios
(
    id            BIGSERIAL          PRIMARY KEY
  , nombre        VARCHAR(32)        NOT NULL UNIQUE
  , password      VARCHAR(60)        NOT NULL
);
-- Comentario equisde
-- QUE TOP
