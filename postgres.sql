--
-- PostgreSQL database dump
--

-- Dumped from database version 9.6.10
-- Dumped by pg_dump version 9.6.10

CREATE TABLE categories (
    id SERIAL PRIMARY KEY,
    name VARCHAR NOT NULL,
    created timestamp NOT NULL
);

CREATE TABLE lists (
    id SERIAL PRIMARY KEY,
    todo VARCHAR NOT NULL,
    category_id smallint,
    user_id smallint,
    assign date NOT NULL,
    status VARCHAR default NULL
);

CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    first_name VARCHAR NOT NULL,
    last_name VARCHAR NOT NULL,
    username VARCHAR NOT NULL,
    email VARCHAR NOT NULL,
    password VARCHAR NOT NULL,
    created timestamp NOT NULL
);

--
-- PostgreSQL database dump complete
--

