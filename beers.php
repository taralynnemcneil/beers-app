<?php ob_start();

// auth
require('auth.php');

// set title
$pageTitle = 'Beer Listings';
require('header.php');
?>

<h1>Beer Listing</h1>

<!-- Search Form -->
<div class="col-sm-12 text-right">
    <form method="get" action="beers.php" class="form-inline">
        <label for="keywords">Keywords</label>
        <input name="keywords" id="keywords" />
        <select class="form-control form-control-sm" name="search_type" id="search_type">
            <option value="OR">Any Keyword</option>
            <option value="AND">All Keywords</option>
        </select>
        <button class="btn btn-success">Search</button>
    </form>

</div>

<?php

try {
    // connecting to the database
    require('db.php');

    // set up an SQL query
    $sql = "SELECT * FROM beers";
    $keywords_list = null;

    // check for keywords, build the where clause dynamically
    if (!empty($_GET['keywords'])) {
        $keywords = $_GET['keywords'];

        // convert 1 single keyword value into a list of seperate values
        $keywords_list = explode(" ", $keywords);

        // start building the WHERE clause
        $sql .= " WHERE ";
        $counter = 0;

        // set the search type AND/OR
        $search_type = $_GET['search_type'];

        // check the word_list array
        foreach($keywords_list as $word) {

            // add the word or if we are not on the first keyword
            if ($counter > 0) {
                $sql .= " $search_type ";
            }

            // works but breaks with special characters
            // $sql .= " name LIKE '%" . $word . "%'";

            $sql .= " name LIKE ?";
            $keywords_list[$counter] = '%' . $word . '%';

            $counter++;

        }
    }

    // add order by clause sql .= (take the current sql statement and add on to it)
    $sql .= " ORDER BY name";

    // execute the query and store the results
    $cmd = $conn->prepare($sql);
    $cmd->execute($keywords_list);
    $result = $cmd->fetchAll();

    // disconnect
    $conn = null;

    // start the table and add the headings
    echo '<table class="sortable table table-striped"><thead>
        <th><a href="#">Name</a></th>
        <th><a href="#">Alcohol Content</a></th>
        <th><a href="#">Domestic</a></th>
        <th><a href="#">Light</a></th>
        <th><a href="#">Price</a></th>
        <th>Edit</th><th>Delete</th></thead><tbody>';

    // loop through the query result
    foreach ($result as $row) {
        //display - create a new row and 3 columns for each record
        echo '<tr><td>' . $row['name'] . '</td>
		    <td>' . $row['alcohol_content'] . '</td>
		    <td>' . $row['domestic'] . '</td>
		    <td>' . $row['light'] . '</td>
		    <td>' . $row['price'] . '</td>
		    <td><a href="beer.php?beer_id=' . $row['beer_id'] . '" title="Edit">Edit</a></td>
		    <td><a href="delete-beers.php?beer_id=' . $row['beer_id'] . '"
		    onclick="return confirm(\'Are you sure you want to delete this?\');">Delete</a></td></tr>';
    }

    // close table body and the table itself
    echo '</tbody></table>';
    
    // facebook commenting
    echo '<div class="fb-comments" data-href="http://gc200197303.computerstudi.es/" data-width="800" data-numposts="5"></div>';

}
catch (Exception $e) {
    // send ourselves the error
    mail('taralynnemcneil@gmail.com', 'Beer Store App Error', $e);

    // redirect to error page
    header('location:error.php');
}

// footer
require('footer.php');
ob_flush(); ?>

