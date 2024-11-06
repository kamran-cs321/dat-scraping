<?php

require_once 'vendor/autoload.php';
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient; 
use Symfony\Component\Panther\PantherTestCase;

use Goutte\Client;
?>

<!DOCTYPE html>
<html>
<head>
  <title>Scraping Data</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <form method="post" id="submit-form">
        <input name="keyword" />
        <button type="submit" name="search">search</button>
    </form>
    <?php
    $websites = array(
        "https://marshalfitness.com/search?q=",
        "https://prosportsae.com/search?q=",
        "https://fitnesspowerhouse.com/search?products_data%5Bquery%5D=",
        "https://urbanfitnesscart.com/uae-en/search?prod_ufc%5Bquery%5D=",
        "https://lifetimefitnessstore.com/ae/search?ufs_index%5Bquery%5D="
    );
    
    if (isset($_POST['search'])) {

        // URL of the website you want to scrape
        $keyword = urlencode($_POST['keyword']);
         
         
        foreach($websites as $link){

            $url = $link.''.$keyword;
         
            // Create a Goutte client
            $client = new Client();
        
            // Send a request to the website
            $crawler = $client->request('GET', $url);
       
            if($link == "https://urbanfitnesscart.com/uae-en/search?prod_ufc%5Bquery%5D="){
                
                // echo "<h2>".$link ."</h2><br>";
                echo "<h2>".$url ."</h2>";

                 $htmlString = $client->getResponse()->getContent();
            
            
             echo   $html = $crawler->html();

            echo    $pageWrapperContent = $crawler->filter('.ais-InfiniteHits-list')->html();

                // print_r($pageWrapperContent);

                // Create a new Crawler from the content within the "page-wrapper" div
                $pageWrapperCrawler = new Crawler($pageWrapperContent);

                // print_r($pageWrapperCrawler);


                // Extract prices using the "final-price sale-price" class
                // $prices = $pageWrapperCrawler->filter('.final-price.sale-price')->each(function ($node) {
                //     return trim($node->text());
                // });

                // print_r($html);
                // $prices = $crawler->filter('.final-price.sale-price')->each(function ($node) {
                //     return trim($node->text());
                // });
                print_r($prices);

                // $prices = $crawler->filter('.ais-InfiniteHits-item')->each(function ($node) {
                //   $regularPriceNode = $node->filter('.product-price');

                //     return $node->text();
                // });
                
                // print_r($html);

                ?>
              
        <?php
            }
        
            if($link == "https://fitnesspowerhouse.com/search?products_data%5Bquery%5D="){
                echo "<h2>".$link ."</h2><br>";
                    // echo $url;
                    //  sleep(5);
                    //  $html = $crawler->html();
                    //  $crawler = new Crawler($html);
                    sleep(5);
                    echo "fit power";
                    $html = $crawler->html();

                    // $client = static::createPantherClient();
                    // $crawler = new Crawler($html);
                    // Navigate to the page
                    $client->request('GET', $url);
                    // Get the updated HTML content
                    // $html = $client->getPageSource();

        // Create a Crawler from the updated HTML
        // $crawler = new Crawler($html);

        // Extract prices using the "final-price sale-price" class
        $prices = $crawler->filter('.final-price.sale-price')->each(function ($node) {
            return trim($node->text());
        });

                    // $prices = $crawler->filter('.final-price.sale-price')->each(function ($node) {
                    //     return trim($node->text());
                    // });
                    
                     print_r($prices );

                    // $html = $crawler->getBody()->getContents();
                    // $prices = $crawler->filter('.ais-InfiniteHits-item .final-price')->each(function ($node) {
                    //     // Check if the element with class 'final-price' exists
                    //     $finalPriceNode = $node->filter('.final-price');
                    
                    //     // Extract and return text content if the element exists
                    //     return $finalPriceNode->count() ? $finalPriceNode->text() : null;
                    // });
                    // print_r( $prices);
//                 echo $originalPrices = $crawler->filter('.original-price');
//  print_r($html);
                    // Use Symfony DomCrawler to parse the HTML content
                    // $crawler = new \Symfony\Component\DomCrawler\Crawler($html);

                    echo "<br><br><br>";
                    ?>
                    <table class="table">
                    <thead>
                    <tr>
                        <th>Product Title</th>
                        <th>Sales Price</th>
                        <th>Regular Price</th> 
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>John</td>
                        
                    </tr>
    
                </tbody>
            </table>
    
<?php
            }

            
            if($link == "https://prosportsae.com/search?q="){
                echo "<h2>".$link ."</h2>";
                ?>
            <table class="table table-responsive table-brdered">
                <thead>
                <tr>
                    <th>Product Title</th>
                    <th>AED Sales Price</th>
                    <th>AED Regular Price</th> 
                </tr>
                </thead>
                <tbody>
                
                <?php
                
                $prices = $crawler->filter('.grid__item')->each(function ($node) use ($client) {
                
                    // Regular Price
                    $regularPriceNode = $node->filter('.price-item--regular .money');
                    $regularPrice = $regularPriceNode->count() > 0 ? $regularPriceNode->text() : 'Not available';
                
                    // Sale Price
                    $salePriceNode = $node->filter('.price-item--sale .money');
                    $salePrice = $salePriceNode->count() > 0 ? $salePriceNode->text() : 'Not available';
                
                    // Product Title
                    $productTitleNode = $node->filter('.product-title a');
                    $productTitle = $productTitleNode->count() > 0 ? $productTitleNode->text() : 'Not available';
                
                    // Compare Price
                    $comparePriceNode = $node->filter('s.price-item--regular span.money');
                    $comparePrice = $comparePriceNode->count() > 0 ? $comparePriceNode->text() : 'Not available';
    
                    if( $regularPrice !=  "Not available"){
                        // Print or use the values as needed
                        ?>
                        <tr>
                        <td><?php echo str_replace("Dhs. ", "", $productTitle);?></td>
                        <td><?php echo str_replace("Dhs. ", "", $salePrice); ?></td>
                        <td><?php echo str_replace("Dhs. ", "", $regularPrice);?></td>                        
                    </tr>
                    <?php
                   
                    }
                    
                });
            ?>
                </tbody>
                </table>
                <?php    
                
            }
           
            
            if($link == "https://marshalfitness.com/search?q="){
            
            echo "<h2>".$link ."</h2>";
            ?>

            <table class="table table-responsive table-brdered">
                <thead>
                <tr>
                    <th>Product Title</th>
                    <th>AED Sales Price</th>
                    <th>AED Regular Price</th> 
                    <th>AED Compare Price</th> 

                </tr>
                </thead>
                <tbody>

                <?php
                $prices = $crawler->filter('.card-information__wrapper')->each(function ($node) use ($client) {
                
                    $regularPrice = $node->filter('.price__regular .price-item--regular')->text();
                    $salePrice = $node->filter('.price__sale .price-item--sale')->text();
                    $productTitle = $node->filter('a.card-title > span.text')->text();
                    $comparePrice = $node->filter('.price__compare')->text();
                    
                    if($comparePrice != "" ){

                        ?>
                        <tr>
                        <td><?php echo str_replace("Dhs. ", "", $productTitle);?></td>
                        <td><?php echo str_replace("Dhs. ", "", $salePrice);?></td>
                        <td><?php echo str_replace("Dhs. ", "", $regularPrice);?></td>    
                        <td><?php echo str_replace("Dhs. ", "", $comparePrice);?></td>                        

                    </tr>
                    <?php
                       
                    } 
            

                    return null;
                });

               ?>
                 </tbody>
                </table>
               <?php 

            }
             
             
            if($link == "https://lifetimefitnessstore.com/ae/search?ufs_index%5Bquery%5D="){

                echo "<h2>".$link ."</h2>";

                $prices = $crawler->filter('.ais-InfiniteHits-list')->each(function ($node) {
                    return trim($node->text());
                });
                print_r($prices);

                ?>
    
                <table class="table table-responsive table-brdered">
                    <thead>
                    <tr>
                        <th>Product Title</th>
                        <th>Sales Price</th>
                        <th>Regular Price</th> 
                    </tr>
                    </thead>
                    <tbody>
    
                    <?php
                    // print_r($crawler->html());
                    /*
                    $prices = $crawler->filter('.card-information__wrapper')->each(function ($node) use ($client) {
                    
                    $regularPrice = $node->filter('.price__regular .price-item--regular')->text();
                         
                            ?>
                            <tr>
                            <td><?php echo $productTitle;?></td>
                            <td><?php echo $salePrice;?></td>
                            <td><?php echo $regularPrice;?></td>                        
                        </tr>
                        <?php
                            
                        return null;
                    });
                    */
                   ?>
                     </tbody>
                    </table>
                   <?php 

            }
        }
        
    }
    
    ?>
</body>

</html>
