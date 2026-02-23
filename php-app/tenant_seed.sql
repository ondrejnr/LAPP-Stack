DROP TABLE IF EXISTS tenants CASCADE;
CREATE TABLE tenants (
  id SERIAL PRIMARY KEY,
  unit_id INT REFERENCES social_rent(id),
  name TEXT,
  date_of_birth DATE,
  move_in DATE,
  move_out DATE,
  is_active BOOLEAN,
  notes TEXT
);

INSERT INTO tenants (unit_id, name, date_of_birth, move_in, move_out, is_active, notes)
SELECT
  (1 + (random()*999)::int),
  'Person ' || gs,
  date '1950-01-01' + (random()*20000)::int,
  now() - (random()*interval '2000 days'),
  CASE WHEN random() > 0.8 THEN now() - (random()*interval '10 days') ELSE null END,
  (random()>0.8),
  CASE WHEN random()>0.7 THEN 'Evicted' ELSE '' END
FROM generate_series(1,300) gs;
