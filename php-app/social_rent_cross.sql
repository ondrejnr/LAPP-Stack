DROP TABLE IF EXISTS social_rent CASCADE;
CREATE TABLE social_rent (
  id SERIAL PRIMARY KEY,
  building_id INT REFERENCES buildings(id),
  region VARCHAR(100) NOT NULL,
  year INT NOT NULL,
  provider VARCHAR(100),
  address TEXT,
  postcode VARCHAR(10),
  units INT NOT NULL,
  avg_rent NUMERIC(10,2),
  notes TEXT,
  latitude NUMERIC(8,5),
  longitude NUMERIC(8,5),
  status VARCHAR(20),
  last_updated TIMESTAMP DEFAULT now()
);

INSERT INTO social_rent (building_id, region, year, provider, address, postcode, units, avg_rent, notes, latitude, longitude, status, last_updated)
SELECT
  (1 + (random()*199)::int),  -- FK to 200 buildings
  regions[(random()*6+1)::int],
  (2021 + (random()*3)::int),
  providers[(random()*6+1)::int],
  (100+gr)::text || ' Example Rd',
  'PC' || (1000 + (gr%1000))::text,
  (1 + (random()*89)::int),
  round((500+random()*900)::numeric,2),
  notes[(random()*4+1)::int],
  51.48 + (random()*2),
  -2.0 + random(),
  statuses[(random()*2+1)::int],
  now() - (random()*interval '120 days')
FROM generate_series(1,1000) gr,
  (SELECT ARRAY['London','North West','South East','West Midlands','Scotland','Wales','Northern Ireland'] AS regions) r,
  (SELECT ARRAY['Available','Occupied','Needs Repair'] AS statuses) s,
  (SELECT ARRAY['Acme Housing','Northern Homes','Council North','Southern Trust','Welsh Homes','Scotia Assoc.','WM Trust'] AS providers) p,
  (SELECT ARRAY['','Flagship','Tower','Refurbished','Accessible'] AS notes) n;
