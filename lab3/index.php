<!DOCTYPE html>
<html>
    <head>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <?php 
        // Generate a deck of cards 
        // [0, 1, 2, ..., 51]
        // map each number to a card 
        // generate a "hand" of cards
        
        //$deck = array from 0-51, then shuffled (Random order)
        function generateDeck() {
            $cards = array();
            for ($i = 0; $i < 52; $i++) {
                array_push($cards, $i);
            }
            shuffle($cards);
            return $cards; // stored into $deck
        }
        
        // Return a specific number of cards
        // Passes the deck by reference so that the cards are actually popped off in the global
        function generateHand(&$deck) {
            $hand = array();
            $bust = false;
            $sum = 0;
            do {
                // draw card and apply to person's hand
                $cardNum = array_pop($deck);
                $card = mapNumberToCard($cardNum);
                array_push($hand, $card);
                
                // get current sum of hand value
                $sum += $card['num'];
                
                // get next hand value if another card is drawn
                $nextcard = end($deck);
                $nextcardvalue = mapNumberToCard($nextcard)['num'];//echo $nextcardvalue = mapNumberToCard($nextcard)['num'];
            } while ($nextcardvalue + $sum < 43); // if next hand value is 42 or lower, loop.
            return $hand;
        }
        
        function mapNumberToCard($num) {
            $cardValue = ($num % 13) + 1;
            $cardSuit = floor($num / 13);
            $suitStr = "";
            
            switch($cardSuit) {
                case 0:
                    $suitStr = "clubs";
                    break;
                case 1:
                    $suitStr = "diamonds";
                    break;
                case 2:
                    $suitStr = "hearts";
                    break;
                case 3:
                    $suitStr = "spades";
                    break;
            }

            $card = array(
                'num' => $cardValue,
                'suit' => $cardSuit,
                'imgURL' => "./cards/".$suitStr."/".$cardValue.".png"
                );
            
            return $card;
        }
        
        function valueOfCard($num) {
            $tempcardValue = ($num % 13) + 1;
            echo $cardValue;
            echo nl2br ("\n");
            return $tempcardValue;
        }
        
        function displayPerson($person) {
            // show profile pic
            echo "<img src='".$person["imgUrl"]."'>"; 
            
            // iterate through $person's "cards"
            for($i = 0; $i < count($person["cards"]); $i++) {
                $card = $person["cards"][$i];
                
                // translate this to HTML 
                echo "<img src='".$card["imgURL"]."'>";
            }
            
            echo calculateHandValue($person["cards"]);
        }
        
        function calculateHandValue($cards) {
            $sum = 0;
            
            foreach ($cards as $card) {
                $sum += $card["num"];
            }
            
            return $sum;
        }
        
        $deck = generateDeck();
        
        //players and their information
        $byun = array(
            "name" => "Byun",
            "imgUrl" => "./img/byun.jpg",
            "cards" => generateHand($deck)
            );
        $krzy = array(
            "name" => "Krzy",
            "imgUrl" => "./img/krzy.jpg",
            "cards" => generateHand($deck)
            );
        $sathya = array(
            "name" => "Sathya",
            "imgUrl" => "./img/sathya.jpg",
            "cards" => generateHand($deck)
            );
        $avner = array(
            "name" => "Avner",
            "imgUrl" => "./img/avner.jpg",
            "cards" => generateHand($deck)
            );
        
        displayPerson($byun);
        echo  nl2br ("\n"); // this is a line break,
        displayPerson($krzy);
        echo  nl2br ("\n");
        displayPerson($sathya);
        echo  nl2br ("\n");
        displayPerson($avner);
        ?>
    </body>
</html>