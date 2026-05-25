USE skillswap;

ALTER TABLE skills
    ADD COLUMN IF NOT EXISTS status ENUM('active', 'deleted') DEFAULT 'active' AFTER type,
    ADD COLUMN IF NOT EXISTS deleted_at TIMESTAMP NULL DEFAULT NULL AFTER status;

UPDATE skills
SET status = 'active'
WHERE status IS NULL;

-- Default admin account for existing installs.
-- Email: admin@skillswap.local
-- Password: Admin@123
INSERT INTO users (full_name, username, email, password, role)
SELECT 'SkillSwap Admin', 'admin', 'admin@skillswap.local',
       '$2y$10$2PJinxt6EgQY0MPo6JAmhO..aGBSF/jCvV26YcEnwd6Uxbwe8Ki8.', 'admin'
WHERE NOT EXISTS (
    SELECT 1 FROM users WHERE email = 'admin@skillswap.local' OR username = 'admin'
);
