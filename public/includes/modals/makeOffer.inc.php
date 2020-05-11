<?php
if (!Session::exists('username')) {
    echo "
    <div class=\"ui mini modal makeOffer\">
      <div class=\"ui header\">
        U bent uitgelogd
      </div>
      <div class=\"content\">
        <p>Om te kunnen bieden op producten moet u eerst inloggen of registreren.</p>
      </div>
      <div class=\"actions\">
        <div class=\"ui green ok inverted button\">
          <i class=\"checkmark icon\"></i>
          Okay
        </div>
      </div>
    </div>
    ";
} else {
    echo "  
     <div class=\"ui modal makeOffer\">
        <i class=\"close icon\"></i>
        <div class=\"header\">
            Maak een bod
        </div>
        <div class=\"image content\">
            <div class=\"ui medium image\">
                <img src=\"https://place-hold.it/400x400\">
            </div>
            <div class=\"description\">
                <div class=\"ui header\">Product</div>
    
                <form method=\"post\" id=\"offer-form\">
                    <div class=\"ui input labeled input required\">
                        <label for=\"amount\" class=\"ui label\">€</label>
                        <input type=\"text\" placeholder=\"Uw bod\" name=\"amount\">
                    </div>
                </form>
            </div>
        </div>
        <div class=\"actions\">
            <div class=\"ui input labeled input\">
                <button type=\"submit\" form=\"offer-form\" name=\"offer-submit\" class=\"ui primary labeled icon button\">
                    <i class=\"gavel icon\"></i>
                    Bieden
                </button>
            </div>
        </div>
    </div>
    ";
}
?>