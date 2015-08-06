$.fn.jshake = function(options) {
    var selector = this;
    var settings = $.extend({'speed': 80, 'margin': 20, 'onComplete': false, 'onStart': false}, options);
    var speed = settings['speed'];
    var margin = settings['margin'];
    var margin_total = parseInt(margin) + parseInt(margin);
    var onComplete = settings['onComplete'];
    var onStart = settings['onStart'];
    if (onStart) {
        eval(onStart);
    }
    $(selector).animate({marginLeft: margin}, speed, function() {
        $(selector).animate({marginLeft: '-' + margin_total}, speed, function() {
            $(selector).animate({marginLeft: '' + margin_total}, speed, function() {
                $(selector).animate({marginLeft: '-' + margin_total}, speed, function() {
                    $(selector).animate({marginLeft: '' + margin_total}, speed, function() {
                        $(selector).animate({marginLeft: '-' + margin_total}, speed, function() {
                            $(selector).animate({marginLeft: '-0'}, speed, function() {
                                if (onComplete) {
                                    eval(onComplete);
                                }
                            });
                        });
                    });
                });
            });
        });
    });
}