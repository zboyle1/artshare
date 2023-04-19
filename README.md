## TO DO

    ## SQL:

        ## keywords

        CREATE VIEW keywords AS
        SELECT submission_id, TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(keywords, ',', numbers.n), ',', -1)) AS keyword
        FROM
        (SELECT 1 n UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4) numbers
        INNER JOIN Submission ON CHAR_LENGTH(keywords) - CHAR_LENGTH(REPLACE(keywords, ',', '')) >= numbers.n - 1;

        ##log in 

        SELECT * FROM Member WHERE username = '$user' AND passwrd = '$pass'

        ##signup

        INSERT INTO Member (member_id, username, passwrd, e_mail, birthday, join_date) VALUES (1000, '$user', '$pass','$email','$dob', curdate());

        ## index

            ## for you

            SELECT s.submission_id
            FROM Submission s
            JOIN (
                SELECT k.submission_id, COUNT(*) AS keyword_count
                FROM keywords k
                JOIN (
                    SELECT submission_id FROM Comments WHERE member_id = 1234
                    UNION ALL
                    SELECT submission_id FROM Favorite WHERE member_id = 1234
                ) temp ON k.submission_id = temp.submission_id
                GROUP BY k.submission_id
            ORDER BY keyword_count DESC
            LIMIT 3
            ) top_submissions ON s.submission_id = top_submissions.submission_id
            ORDER BY s.upload_date DESC
            LIMIT 6

            ## newest

            SELECT submission_id FROM Submission ORDER BY upload_date DESC LIMIT 6

            ## popular

            SELECT submission_id, COUNT(*) as favorite_count
            FROM Favorite
            GROUP BY submission_id
            ORDER BY favorite_count DESC
            LIMIT 6

            ## talked about

            SELECT submission_id
            FROM Comments
            GROUP BY submission_id
            ORDER BY COUNT(*) DESC
            LIMIT 6


        ## getting information for profile

            SELECT member_id, username, birthday, join_date, about, submission_id, title, 
                (SELECT COUNT(*) FROM Favorite WHERE Favorite.submission_id = Submission.submission_id) as favorite_count,
                s1.submission_id as most_favorited_id, s1.title as most_favorited_title
            FROM Member
            LEFT JOIN Submission ON Member.member_id = Submission.member_id
            LEFT JOIN (SELECT s2.submission_id, s2.title, COUNT(*) as favorite_count 
                FROM Submission s2
                INNER JOIN Favorite f2 ON s2.submission_id = f2.submission_id
                WHERE s2.member_id = $userid
                GROUP BY s2.submission_id
                ORDER BY favorite_count DESC
                LIMIT 1) s1 ON Submission.member_id = s1.member_id
            WHERE Member.member_id = $userid;

        ## display commissions youre waiting on

            SELECT commission_id, username AS artist, start_date, price, payment
            FROM Commission
            JOIN Member ON Commission.artist_id = Member.member_id
            WHERE commissioner_id = $userid
            AND finish_date IS NULL
            ORDER BY start_date ASC;

        ## display commission to do list

            SELECT commission_id, username AS commissioner, start_date, price, payment
            FROM Commission
            JOIN Member ON Commission.commissioner_id = Member.member_id
            WHERE artist_id = $userid
            WHERE finish_date IS NULL
            ORDER BY start_date ASC;

        ## display recieved commissions

            SELECT commission_id, username AS artist, finish_date, price, payment
            FROM Commission
            JOIN Member ON Commission.artist_id = Member.member_id
            WHERE commissioner_id = $userid
            AND finish_date IS NOT NULL
            ORDER BY finish_date DESC;
s
        ## display finished commissions

            SELECT commission_id, username AS commissioner, finish_date, price, payment
            FROM Commission
            JOIN Member ON Commission.commissioner_id = Member.member_id
            WHERE artist_id = $userid
            AND finish_date IS NOT NULL
            ORDER BY finish_date DESC;

    ## AJAX: 
            - code to display profile
            - user can edit own profile

        ## submissions
            - submit a piece
            - edit a piece
            - delete submission
            - display submission
            - add a favorite
            - delete a favorite
        
        ## comments
            - leave a comment
            - edit a comment
            - delete a comment
            - display comments

        ## commission
            - start a commission
            - finish a commission

        ## search
            - search based on keyword
            - display search results

        
## TESTING
