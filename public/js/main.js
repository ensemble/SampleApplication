require(["util/date.format", "twitter/tweet.parse"], function() {
    $.getJSON('/twitter', function (data) {
        var i  = 0;
        var ol = $('.tweets');
        
        $.each(data.timeline, function(index, tweet){
            var text = tweet.text.parseURL().parseUsername().parseHashtag();
            var url  = 'https://twitter.com/' + tweet.user.screen_name + '/status/' + tweet.id_str;
            
            var date = new Date(Date.parse(tweet.created_at));
            if (K.ie) {
                date = Date.parse(tweet.created_at.replace(/( \+)/, ' UTC$1'))
            }
            var isoDate  = dateFormat(date, 'yyyy-mm-dd"T"hh:MM:ssoD');
            var textDate = dateFormat(date, 'd mmmm yyyy');
	    
	    textDate.replaceArray(['mei'], ['May']);
            
            $('<li>').append($('<span>').addClass('tweet').html(text))
                     .append($('<a>').attr('href', url).append(
                                $('<time>').attr('datetime', isoDate).text(textDate)
                            ))
                     .appendTo(ol);
            
            if (i > 5) return false;
            i++;
        });
    });
    
    var K = function () {
        var a = navigator.userAgent;
        return {
            ie: a.match(/MSIE\s([^;]*)/)
        }
    }();
});