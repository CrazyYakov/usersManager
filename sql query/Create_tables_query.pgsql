CREATE TABLE IF NOT EXISTS DEPARTMENTS (
    id SERIAL PRIMARY KEY,
    name name NOT NULL UNIQUE
);


CREATE TABLE IF NOT EXISTS JOBS (
    id SERIAL PRIMARY KEY,
    name name NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS USERS (
    id SERIAL PRIMARY KEY,
    name NAME NOT NULL,
    salary INT NOT NULL,
    department_id INT REFERENCES DEPARTMENTS (id),
    job_id INT REFERENCES JOBS (id),
    birthday timestamp NOT NULL,
    created_at timestamp not null defauld now()
);