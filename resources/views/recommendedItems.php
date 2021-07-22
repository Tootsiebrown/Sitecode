<div>
    <h3 class="recommended">Recommended Items</h3>
</div>


<?php
$user = "Thing2";
$password = "Thing2";
$host = "host.mb:8889";
$database= "cndz_testing_db";
$connection= mysqli_connect ($host, $user, $password);
$db_select = mysqli_select_db($connection, $database);
$result= mysqli_query( $connection, "SELECT id, listing_images.id, title, price, condition FROM listings, listing_images WHERE listings.id = listing_images.id  ORDER BY rand() limit 4" );
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    printf( $row["title"]);
    printf($row["price"]);
    printf($row["condition"]);
    printf($row["id"]);
    $link_listing_sku = ($row["id"]);
    $link_listing_slug = ($row["slug"]);
    $link_address = "auction" . "/" . $link_listing_sku . "/" . $link_listing_slug;
    echo "<a href='$link_address'>Click Me</a>";
    echo "</br>";
}

mysqli_free_result($result);


$result= mysqli_query( $connection, "select
    A.*
from
    table_A A
where
    A.id in (
        select B.id from table_B B where B.tag = 'chair'"
)




?>