-- Check if amount_per_point column doesn't exist
SET @dbname = DATABASE();
SET @tablename = "point_settings";
SET @columnname = "amount_per_point";
SET @preparedStatement = (SELECT IF(
  (
    SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS
    WHERE
      TABLE_SCHEMA = @dbname
      AND TABLE_NAME = @tablename
      AND COLUMN_NAME = @columnname
  ) > 0,
  "SELECT 1",
  "ALTER TABLE point_settings ADD COLUMN amount_per_point DECIMAL(10,2) DEFAULT 10000.00 AFTER points_to_rupiah"
));
PREPARE alterIfNotExists FROM @preparedStatement;
EXECUTE alterIfNotExists;
DEALLOCATE PREPARE alterIfNotExists;

-- Check if earning_description column doesn't exist
SET @columnname = "earning_description";
SET @preparedStatement = (SELECT IF(
  (
    SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS
    WHERE
      TABLE_SCHEMA = @dbname
      AND TABLE_NAME = @tablename
      AND COLUMN_NAME = @columnname
  ) > 0,
  "SELECT 1",
  "ALTER TABLE point_settings ADD COLUMN earning_description TEXT NULL AFTER description"
));
PREPARE alterIfNotExists FROM @preparedStatement;
EXECUTE alterIfNotExists;
DEALLOCATE PREPARE alterIfNotExists;

-- Update existing records with default values if they don't have values
UPDATE point_settings 
SET amount_per_point = COALESCE(amount_per_point, 10000.00),
    earning_description = COALESCE(earning_description, 'Default: Rp 10.000 = 1 poin')
WHERE id = 1;
