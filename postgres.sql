--
-- PostgreSQL database dump
--

-- Dumped from database version 9.6.10
-- Dumped by pg_dump version 9.6.10

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET default_tablespace = '';

SET default_with_oids = false;

CREATE TABLE public.categories (
    id SERIAL PRIMARY KEY,
    name character varying(12) DEFAULT NULL::character varying,
    created character varying(19) DEFAULT NULL::character varying
);

CREATE TABLE public.lists (
    id SERIAL PRIMARY KEY,
    todo character varying(16) DEFAULT NULL::character varying,
    category_id smallint,
    user_id smallint,
    assign character varying(10) DEFAULT NULL::character varying,
    status character varying(1) DEFAULT NULL::character varying
);

CREATE TABLE public.users (
    id SERIAL PRIMARY KEY,
    first_name character varying(4) DEFAULT NULL::character varying,
    last_name character varying(9) DEFAULT NULL::character varying,
    username character varying(7) DEFAULT NULL::character varying,
    email character varying(21) DEFAULT NULL::character varying,
    password character varying(60) DEFAULT NULL::character varying,
    created character varying(19) DEFAULT NULL::character varying
);


ALTER TABLE public.users OWNER TO rebasedata;

--
-- PostgreSQL database dump complete
--

