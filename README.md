Petsite

## TO DO

    ## SQL:

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

            Then, fetch results and store them in an array. call the profile values when you need them

        ## display commissions youre waiting on

            SELECT commission_id, username AS artist, start_date, price, payment
            FROM Commission
            JOIN Member ON Commission.artist_id = Member.member_id
            WHERE commissioner_id = $userid
            AND finish_date IS NULL
            ORDER BY start_date ASC;

            Fetch results, display in a table

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

        ## display finished commissions

            SELECT commission_id, username AS commissioner, finish_date, price, payment
            FROM Commission
            JOIN Member ON Commission.commissioner_id = Member.member_id
            WHERE artist_id = $userid
            AND finish_date IS NOT NULL
            ORDER BY finish_date DESC;


    
    ## PLACES
    _______________________________________________________________________
    | Page        | Started | Front end | Back end | Touch-ups | Finished |
    |-------------|---------|-----------|----------|-----------|----------|
    | index       |    X    |           |          |           |          |
    | login       |    X    |           |          |           |          |
    | signup      |    X    |           |          |           |          |
    | profile     |    X    |           |          |           |          |
    | submit      |         |           |          |           |          |
    | commissions |         |           |          |           |          |
    | search      |         |           |          |           |          |
    |-------------|---------|-----------|----------|-----------|----------|

    ## AJAX: 
            - login and logout
            - sign up
            - code to display profile

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
            - display commissions that youre waiting on
            - display commission todo list
            - display finished commissions list

        ## search
            - search based on keyword
            - display search results

        ## front page
            - display 'for you'
                - this will be a view, which finds submissions based on ones youve liked and commented on
            - display newest
            - display most favorited
            - display most commented

        
        