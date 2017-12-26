
jQuery(document).ready(function($) {
console.log("^^^^^^^jQuery(document).ready(function($)^^^^^^^^");

 var fields_json = (function () {
    var fields_json = null;
    $.ajax({
        'type': 'get',      
        'async': false,
        'global': false,
        'url': "http://localhost/drupal8test/toptrumps_fields",
        'dataType': "json",
        'success': function (data) {
            //fields_json = data.fields;
            console.log("######## JSON.stringify DATA fields_json="+JSON.stringify(data));
            fields_json = data;
        }
    });
    console.log("######## fields_json="+JSON.stringify(fields_json));
    return fields_json;
})(); 



 var cards_json = (function () {
    var cards_json = null;
    $.ajax({
        'async': false,
        'type': 'get',
        'global': false,
        //'url': "cards.php",
        //'url': "http://localhost/drupal8test/toptrumps_cards",
        'url': "http://localhost/drupal8test/toptrumps_cards",
        'dataType': "json",
        'success': function (data) {
            //cards_json = data.cards;
            cards_json = data;
        }
    });
    console.log("#######cards_json="+JSON.stringify(cards_json));
    return cards_json;
})(); 

//console.log(fields_json +"^^^^^^^^^^^^^^^"+JSON.stringify(cards_json));


      $(document).ready(function() {
        $('#cardgame').toptrumps({
          'fields' : fields_json,          
          'cards' : cards_json,
          'trick' : 'requeue',
          'difficulty' : 'easy',
          'onInit' : function($instance, settings) {
            var title = 'Top Trumps Cats<br>Start Game';
            $instance.find('.tt-start-button').html(title);
          },
          'onComplete' : function($instance, settings) {
            var message = '';
            if (settings.points.cpu > settings.points.user) {
               message+= '<h2>You have lost!</h2>';
            }
            else if (settings.points.cpu < settings.points.user) {
               message+= '<h2>Congratulations. You win!</h2>';
            }
            else {
               message+= '<h2>Lame. Just a draw.</h2>';
            }

            message+= '<p>Thanks for playing the jQuery TopTrumps Demo.</p>';
            message+= '<p>Checkout the repository at <a href="https://github.com/christianhanne/top_trumps">Github</a>.</p>';
            message+= '<p>Plugin: <a href="http://www.christianhanne.de">Christian Hanne</a></p>';
            message+= '<p>Drawing: <a href="http://www.sophiesievert.de">Sophie Sievert</a></p>';

            $instance.prepend($('<div>').css('text-align', 'center').html(message));
          },
          'renderCard' : function($card, card, fields) {
            $card.find('.tt-card-fields')
              .before('<img src="' +  card.image + '" alt="' + card.name + '" width="300" height="300">');
          }
        }); // END of $('#cardgame').toptrumps({
      }); //$(document).ready(function() {


}); // END of jQuery(document).ready(function($) {


