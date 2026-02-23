CREATE TABLE IF NOT EXISTS social_rent (
    id SERIAL PRIMARY KEY,
    region VARCHAR(100) NOT NULL,
    year INT NOT NULL,
    units INT NOT NULL,
    avg_rent NUMERIC(10,2),
    notes TEXT
);

INSERT INTO social_rent (region, year, units, avg_rent, notes) VALUES
('London', 2021, 170, 845.60, 'COVID impact'),
('London', 2022, 171, 860.10, 'Recovering'),
('North West', 2021, 205, 620.10, ''),
('North West', 2022, 199, 630.99, ''),
('South East', 2021, 178, 715.60, ''),
('West Midlands', 2022, 146, 679.30, ''),
('Scotland', 2022, 137, 601.50, ''),
('Wales', 2022, 105, 598.00, '');
