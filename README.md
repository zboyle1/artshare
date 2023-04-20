# Artshare
Elijah Tate, Zoe Boyle
Group 13
CSC 4710
March 24

# SQL used

## keywords
```
CREATE VIEW keywords AS
SELECT submission_id, TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(keywords, ',', numbers.n), ',', -1)) AS keyword
FROM (
    SELECT 1 n UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4) AS numbers
INNER JOIN Submission ON CHAR_LENGTH(keywords) - CHAR_LENGTH(REPLACE(keywords, ',', '')) >= numbers.n - 1;
```

## log in 
```
SELECT * FROM Member WHERE username = '$user' AND passwrd = '$pass'
```

## sign up
```
INSERT INTO Member (member_id, username, passwrd, e_mail, birthday, join_date) VALUES (1000, '$user', '$pass','$email','$dob', curdate());
```

## index
### for you
```
SELECT s.submission_id
FROM Submission s
JOIN (
    SELECT k.submission_id, COUNT(*) AS keyword_count
    FROM keywords k
    JOIN (
        SELECT submission_id FROM Comments WHERE member_id = $userid
        UNION ALL
        SELECT submission_id FROM Favorite WHERE member_id = $userid
    ) temp ON k.submission_id = temp.submission_id
    GROUP BY k.submission_id
    ORDER BY keyword_count DESC
    LIMIT 3
) top_submissions ON s.submission_id = top_submissions.submission_id
ORDER BY s.upload_date DESC
LIMIT 6
```

### newest
```
SELECT submission_id FROM Submission ORDER BY upload_date DESC LIMIT 6
```

### popular
```
SELECT submission_id, COUNT(*) as favorite_count
FROM Favorite
GROUP BY submission_id
ORDER BY favorite_count DESC
LIMIT 6
```

### talked about
```
SELECT submission_id
FROM Comments
GROUP BY submission_id
ORDER BY COUNT(*) DESC
LIMIT 6
```

## profile
### user information
```
SELECT * FROM Member WHERE username = '$user'
```

### users submissions
```
SELECT submission_id
FROM Submission
WHERE member_ID = $userid
```

### users favorites
```
SELECT submission_id
FROM Favorite
WHERE member_ID = $userid
```

## commissions
### commissions youre waiting on
```
SELECT commission_id, username AS artist, start_date, price, payment
FROM Commission
JOIN Member ON Commission.artist_id = Member.member_id
WHERE commissioner_id = $userid
AND finish_date IS NULL
ORDER BY start_date ASC;
```

### commission to do list
```
SELECT commission_id, username AS commissioner, start_date, price, payment
FROM Commission
JOIN Member ON Commission.commissioner_id = Member.member_id
WHERE artist_id = $userid
WHERE finish_date IS NULL
ORDER BY start_date ASC;
```

### recieved commissions
```
SELECT commission_id, username AS artist, finish_date, price, payment
FROM Commission
JOIN Member ON Commission.artist_id = Member.member_id
WHERE commissioner_id = $userid
AND finish_date IS NOT NULL
 ORDER BY finish_date DESC;
 ```

### finished commissions
```
SELECT commission_id, username AS commissioner, finish_date, price, payment
FROM Commission
JOIN Member ON Commission.commissioner_id = Member.member_id
WHERE artist_id = $userid
AND finish_date IS NOT NULL
ORDER BY finish_date DESC;
```

## submit
```
INSERT INTO Submission (submission_id, user_ID, title, upload_date, description, keywords)
VALUES ($picid, $userid, $title, curdate(), $desc, $keywords');
```

## page of a submission
### display submission information
```
SELECT s.*, (
    SELECT COUNT(*) FROM Favorite WHERE submission_id = s.submission_id
) AS favorite_count, (
    SELECT COUNT(*) FROM Comments WHERE submission_id = s.submission_id
) AS comment_count
FROM Submission s
WHERE s.submission_id = $picid;
 ```

### find image type
```
SELECT * FROM $type WHERE submission_id = $picid;
```

### allow user to edit submission
```
UPDATE Submission 
SET title = 'New Title', descriptio'New Description', keywords = 'New Keyword1, New Keyword2' 
WHERE submission_id = $picid AND member_id = $userid;
```

### allow user to delete submission
```
DELETE FROM Submission WHERE submission_id = $picid AND member_id = $userid;
```

### determine if user has favorited
```
SELECT submission_id FROM Submission
WHERE submission_id IN (
    SELECT submission_id
    FROM Favorite
    WHERE member_id = $userid
);
```

### add favorite
```
INSERT INTO Favorite (member_id, submission_id) VALUES ($user_id, $submission_id);
```

### remove favorite
```
DELETE FROM Favorite WHERE member_id = $userid AND submission_id = $picid
```

### show all commments
```
SELECT c.*, m.username
FROM Submission s
JOIN Comments c ON s.submission_id = c.submission_id
JOIN Members m ON c.user_id = m.user_id
WHERE s.submission_id = $picid;
```

### user delete comment
```
DELETE FROM Comments WHERE comment_id = $commentid AND member_id = $userid;
```

### user edit comment
```
UPDATE Comments SET comment_body = '$newbody'
WHERE comment_id = $commentid AND member_id = $userid AND submission_id = $picid;
```

### add comment
```
INSERT INTO Comments (member_id, submission_id, datepost, body) VALUES ($userid, $picid, curdate(), '$body');
```

## search
```
SELECT DISTINCT * FROM Submission WHERE title LIKE '%$search_query%' OR description LIKE '%$search_query%' OR keywords LIKE '%$search_query%'
```

# Database structure

- Comments(**comment_id**, *member_id*, *submission_id*, datepost, body)
- Commission(**commission_id**, *commissioner_id*, *artist_id*, startdate, finish_date, price, payment)
- Favorite(***member_id, submission_id***)
- Member(**member_id**, username, password, email, birthday, join_date, about)
- Submission(**submission_id**, *member_id*, title, upload_date, description, keywords)
- Music(***submission_id***, genre, bpm)
- Image(***submission_id***, medium)
- Written(***submission_id***, word_count)