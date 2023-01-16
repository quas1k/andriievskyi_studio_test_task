-- Create a new table called pair_prices
CREATE TABLE pair_prices (
    id UUID PRIMARY KEY,
    crypto_currency VARCHAR(255) NOT NULL,
    vs_currency VARCHAR(255) NOT NULL,
    price NUMERIC(8,2) NOT NULL,
    service VARCHAR(255) NOT NULL,
    created_at TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP
);

-- Create index for improve performance when querying for the last record
CREATE INDEX ON pair_prices (crypto_currency, vs_currency, service, created_at DESC);
