-- 1. Crear el usuario
CREATE USER yio_admin WITH PASSWORD '5860464';

-- 2. Crear la base de datos y asignar el dueño (opcional si ya la tenías)
CREATE DATABASE mail OWNER yio_admin;



-- 4. Crear tabla
CREATE TABLE datos (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100),
    subject VARCHAR(150),
    mensaje TEXT,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 5. Permisos generales
GRANT CONNECT ON DATABASE mail TO yio_admin;
GRANT USAGE ON SCHEMA public TO yio_admin;

-- 6. Permisos sobre tablas y datos actuales
GRANT ALL PRIVILEGES ON ALL TABLES IN SCHEMA public TO yio_admin;

-- 7. Permisos sobre la secuencia generada por SERIAL
GRANT USAGE, SELECT, UPDATE ON ALL SEQUENCES IN SCHEMA public TO yio_admin;

-- 8. Permisos futuros (para nuevas tablas/secuencias que se creen luego)
ALTER DEFAULT PRIVILEGES IN SCHEMA public
GRANT ALL ON TABLES TO yio_admin;

ALTER DEFAULT PRIVILEGES IN SCHEMA public
GRANT USAGE, SELECT, UPDATE ON SEQUENCES TO yio_admin;
