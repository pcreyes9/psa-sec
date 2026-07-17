UPDATE attendances
SET overtime_hours =
CASE
    WHEN TIME(time_out) <= '18:00:00' THEN 0
    ELSE TIMESTAMPDIFF(
        MINUTE,
        CONCAT(attendance_date, ' 17:00:00'),
        time_out
    ) / 60
END;
