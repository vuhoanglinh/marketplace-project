//-------------------------------------------------
//      youtube playlist jquery plugin
//      Created by dan@geckonm.com
//      www.geckonewmedia.com
//
//      v1.1 - updated to allow fullscreen 
//           - thanks Ashraf for the request
//-------------------------------------------------

jQuery.fn.ytplaylist = function(options) {
 
  // default settings
  var options = jQuery.extend( {
    holderId: 'ytvideo',
    playerHeight: '300',
    playerWidth: '450',
    addThumbs: false,
    thumbSize: 'small',
    showInline: false,
    autoPlay: true,
    showRelated: true,
    allowFullScreen: false
  },options);
 
  return this.each(function() {
                            
        var selector = $(this);
        
        var autoPlay = "";
        var showRelated = "&rel=0";
        var fullScreen = "";
        if(options.autoPlay) autoPlay = "&autoplay=1"; 
        if(options.showRelated) showRelated = "&rel=1"; 
        if(options.allowFullScreen) fullScreen = "&fs=1"; 
        
        //throw a youtube player in
        function play(id)
        {
           var html  = '';
    
           html += '<object height="'+options.playerHeight+'" width="'+options.playerWidth+'">';
           html += '<param name="movie" value="http://www.youtube.com/v/'+id+autoPlay+showRelated+fullScreen+'"> </param>';
           html += '<param name="wmode" value="transparent"> </param>';
           if(options.allowFullScreen) { 
                html += '<param name="allowfullscreen" value="true"> </param>'; 
           }
           html += '<embed src="http://www.youtube.com/v/'+id+autoPlay+showRelated+fullScreen+'"';
           if(options.allowFullScreen) { 
                html += ' allowfullscreen="true" '; 
            }
           html += 'type="application/x-shockwave-flash" wmode="transparent"  height="'+options.playerHeight+'" width="'+options.playerWidth+'"></embed>';
           html += '</object>';
            
           return html;
           
        };
        
        
        //grab a youtube id from a (clean, no querystring) url (thanks to http://jquery-howto.blogspot.com/2009/05/jyoutube-jquery-youtube-thumbnail.html)
        function youtubeid(url) {
            var ytid = url.match("[\\?&]v=([^&#]*)");
            ytid = ytid[1];
            return ytid;
        };
        
        
        //load inital video
        var firstVid = selector.children("li:first-child").addClass("currentvideo").children("a").attr("href");
        $("#"+options.holderId+"").html(play(youtubeid(firstVid)));
        
        //load video on request
        selector.children("li").children("a").click(function() {
            
            if(options.showInline) {
                $("li.currentvideo").removeClass("currentvideo");
                $(this).parent("li").addClass("currentvideo").html(play(youtubeid($(this).attr("href"))));
            }
            else {
                $("#"+options.holderId+"").html(play(youtubeid($(this).attr("href"))));
                $(this).parent().parent("ul").find("li.currentvideo").removeClass("currentvideo");
                $(this).parent("li").addClass("currentvideo");
            }
                                                             
            
            
            return false;
        });
        
        //do we want thumns with that?
        if(options.addThumbs) {
            
            selector.children().each(function(i){
                                              
                var replacedText = $(this).text();
                
                if(options.thumbSize == 'small') {
                    var thumbUrl = "http://img.youtube.com/vi/"+youtubeid($(this).children("a").attr("href"))+"/2.jpg";
                }
                else {
                    var thumbUrl = "http://img.youtube.com/vi/"+youtubeid($(this).children("a").attr("href"))+"/0.jpg";
                }
                
                
                $(this).children("a").empty().html("<img src='"+thumbUrl+"' alt='"+replacedText+"' />"+replacedText).attr("title", replacedText);
                
            }); 
            
        }
            
        
   
  });
 
};﻿/*
    jQuery zAccordion Plugin v2.0.0
    Copyright (c) 2010 - 2011 Nate Armagost, http://www.armagost.com/zaccordion
    Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
    The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/
(function ($) {
    "use strict";
    $.fn.zAccordion = function (method) {
        var defaults = {
            timeout: 6000, /* Time between each slide (in ms). */
            width: null, /* Width of the container. This option is required. */
            slideWidth: null, /* Width of each slide in pixels or width of each slide compared to a 100% container. */
            tabWidth: null, /* Width of each slide's "tab" (when clicked it opens the slide) or width of each tab compared to a 100% container. */
            height: null, /* Height of the container. This option is required. */
            startingSlide: 0, /* Zero-based index of which slide should be displayed. */
            slideClass: null, /* Class prefix of each slide. If left null, no classes will be set. */
            easing: null, /* Easing method. */
            speed: 1200, /* Speed of the slide transition (in ms). */
            auto: true, /* Whether or not the slideshow should play automatically. */
            trigger: "click", /* Event type that will bind to the "tab" (click, mouseover, etc.). */
            pause: true, /* Pause on hover. */
            invert: false, /* Whether or not to invert the slideshow, so the last slide stays in the same position, rather than the first slide. */
            animationStart: function () {}, /* Function called when animation starts. */
            animationComplete: function () {}, /* Function called when animation completes. */
            afterBuild: function () {} /* Function called after the accordion is finished building. */
        }, helpers = {
            displayError: function (e) {
                if (window.console) {
                    console.log("zAccordion: " + e + ".");
                }
            },
            findChildElements: function (t) { /* Function to find the number of child elements. */
                if (t.children().get(0) === undefined) {
                    return false;
                } else {
                    return true;
                }
            },
            getNext: function (s, c) { /* Returns the 0-index of the next slide. */
                var next = c + 1;
                if (next >= s) {
                    next = 0;
                }
                return next;
            },
            fixHeight: function (o) {
                if ((o.height === null) && (o.slideHeight !== undefined)) { /* Removed slideHeight. */
                    o.height = o.slideHeight;
                    return true;
                } else if ((o.height !== null) && (o.slideHeight === undefined)) {
                    return true;
                } else if ((o.height === null) && (o.slideHeight === undefined)) {
                    return false;
                }
            },
            getUnits: function (o) {
                if (o !== null) {
                    if (o.toString().indexOf("%") > -1) {
                        return "%";
                    } else if (o.toString().indexOf("px") > -1) {
                        return "px";
                    } else {
                        return "px";
                    }
                }
            },
            toInteger: function (o) {
                if (o !== null) {
                    return parseInt(o, 10);
                }
            },
            sizeAccordion: function (t, o) { /* Calculate the sizes of the tabs and slides */
                if ((o.width === undefined) && (o.slideWidth === undefined) && (o.tabWidth === undefined)) {
                    /* Nothing is defined. */
                    helpers.displayError("width must be defined");
                    return false;
                } else if ((o.width !== undefined) && (o.slideWidth === undefined) && (o.tabWidth === undefined)) {
                    /* Only width is defined. */
                    /* Check for errors. */
                    if ((o.width > 100) && (o.widthUnits === "%")) { /* Check for a width percentage of over 100. */
                        helpers.displayError("width cannot be over 100%");
                        return false;
                    } else {
                        o.slideWidthUnits = o.widthUnits;
                        o.tabWidthUnits = o.widthUnits;
                        if (o.widthUnits === "%") { /* Percentages. */
                            o.tabWidth = 100 / (t.children().size() + 1); /* Use 100% instead of the defined width. */
                            o.slideWidth = 100 - ((t.children().size() - 1) * o.tabWidth);
                        } else { /* Pixels. */
                            o.tabWidth = o.width / (t.children().size() + 1);
                            o.slideWidth = o.width - ((t.children().size() - 1) * o.tabWidth);
                        }
                        return true;
                    }
                } else if ((o.width === undefined) && (o.slideWidth !== undefined) && (o.tabWidth === undefined)) {
                    /* Only slideWidth is defined. */
                    helpers.displayError("width must be defined");
                    return false;
                } else if ((o.width === undefined) && (o.slideWidth === undefined) && (o.tabWidth !== undefined)) {
                    /* Only tabWidth is defined. */
                    helpers.displayError("width must be defined");
                    return false;
                } else if ((o.width !== undefined) && (o.slideWidth === undefined) && (o.tabWidth !== undefined)) {
                    /* width and tabWidth defined. */
                    /* Check for errors */
                    if (o.widthUnits !== o.tabWidthUnits) {
                        helpers.displayError("Units do not match");
                        return false;
                    } else if ((o.width > 100) && (o.widthUnits === "%")) {
                        helpers.displayError("width cannot be over 100%");
                        return false;
                    } else if ((((t.children().size() * o.tabWidth) > 100) && (o.widthUnits === "%")) || (((t.children().size() * o.tabWidth) > o.width) && (o.widthUnits === "px"))) {
                        helpers.displayError("tabWidth too large for accordion");
                        return false;
                    } else {
                        /* Need to define the remaining slideWidth */
                        o.slideWidthUnits = o.widthUnits; /* Set the units to be consistent */
                        if (o.widthUnits === "%") { /* Percentages */
                            o.slideWidth = 100 - ((t.children().size() - 1) * o.tabWidth); /* Use 100% instead of the defined width */
                        } else { /* Pixels */
                            o.slideWidth = o.width - ((t.children().size() - 1) * o.tabWidth);
                        }
                        return true;
                    }
                } else if ((o.width !== undefined) && (o.slideWidth !== undefined) && (o.tabWidth === undefined)) {
                    /* width and slideWidth defined. */
                    /* Check for errors. */
                    if (o.widthUnits !== o.slideWidthUnits) {
                        helpers.displayError("Units do not match");
                        return false;
                    } else if ((o.width > 100) && (o.widthUnits === "%")) {
                        helpers.displayError("width cannot be over 100%");
                        return false;
                    } else if (o.slideWidth >= o.width) {
                        helpers.displayError("slideWidth cannot be greater than or equal to width");
                        return false;
                    } else if ((((t.children().size() * o.slideWidth) < 100) && (o.widthUnits === "%")) || (((t.children().size() * o.slideWidth) < o.width) && (o.widthUnits === "px"))) { /* Prevents gaps in the accordion. For example, a slider with 4 slides at 150 pixels wide. 4 * 150 = 600. Needs to fill an 800px space. */
                        helpers.displayError("slideWidth too small for accordion");
                        return false;
                    } else {
                        /* Need to define the remaining tabWidth. */
                        o.tabWidthUnits = o.widthUnits; /* Set the units to be consistent. */
                        if (o.widthUnits === "%") { /* Percentages. */
                            o.tabWidth = (100 - o.slideWidth) / (t.children().size() - 1); /* Use 100% instead of the defined width. */
                        } else { /* Pixels. */
                            o.tabWidth = (o.width - o.slideWidth) / (t.children().size() - 1);
                        }
                        return true;
                    }
                } else if ((o.width === undefined) && (o.slideWidth !== undefined) && (o.tabWidth !== undefined)) {
                    /* slideWidth and tabWidth defined. */
                    helpers.displayError("width must be defined");
                    return false;
                } else if ((o.width !== undefined) && (o.slideWidth !== undefined) && (o.tabWidth !== undefined)) {
                    /* width, slideWidth, and tabWidth defined. */
                    helpers.displayError("At maximum two of three attributes (width, slideWidth, and tabWidth) should be defined");
                    return false;
                }
            },
            timer: function (obj) {
                var n = obj.data("next") + 1;
                if (obj.data("pause") && obj.data("inside") && obj.data("auto")) {
                    try {
                        clearTimeout(obj.data("interval"));
                    } catch (e) {}
                } else if (obj.data("pause") && !obj.data("inside") && obj.data("auto")) {
                    try {
                        clearTimeout(obj.data("interval"));
                    } catch (f) {}
                    obj.data("interval", setTimeout(function () {
                        obj.children(obj.children().get(0).tagName + ":nth-child(" + n + ")").trigger(obj.data("trigger"));
                    }, obj.data("timeout")));
                } else if (!obj.data("pause") && obj.data("auto")) {
                    try {
                        clearTimeout(obj.data("interval"));
                    } catch (g) {}
                    obj.data("interval", setTimeout(function () {
                        obj.children(obj.children().get(0).tagName + ":nth-child(" + n + ")").trigger(obj.data("trigger"));
                    }, obj.data("timeout")));
                }
            }
        }, methods = {
            init: function (options) {
                var f, fixattr = ["slideWidth", "tabWidth", "startingSlide", "slideClass", "animationStart", "animationComplete", "afterBuild"];
                for (f = 0; f < fixattr.length; f += 1) {
                    if ($(this).data(fixattr[f].toLowerCase()) !== undefined) {
                        $(this).data(fixattr[f], $(this).data(fixattr[f].toLowerCase()));
                        $(this).removeData(fixattr[f].toLowerCase());
                    }
                }
                /* Add new properties to options. */
                options = $.extend(defaults, options, $(this).data());
                /* Check for a height */
                if (this.length <= 0) {
                    helpers.displayError("selector does not exist");
                    return false;
                } else if (!helpers.fixHeight(options)) {
                    helpers.displayError("height must be defined");
                    return false;
                } else if (!helpers.findChildElements(this)) {
                    helpers.displayError("No child elements available");
                    return false;
                } else if (options.speed > options.timeout) {
                    helpers.displayError("Speed cannot be greater than timeout");
                    return false;
                } else {
                    /* Get the correct units */
                    options.heightUnits = helpers.getUnits(options.height);
                    options.height = helpers.toInteger(options.height);
                    options.widthUnits = helpers.getUnits(options.width);
                    options.width = helpers.toInteger(options.width);
                    options.slideWidthUnits = helpers.getUnits(options.slideWidth);
                    options.slideWidth = helpers.toInteger(options.slideWidth);
                    options.tabWidthUnits = helpers.getUnits(options.tabWidth);
                    options.tabWidth = helpers.toInteger(options.tabWidth);
                    if (options.slideClass !== null) {
                        options.slideOpenClass = options.slideClass + "-open"; /* Class of open slides. */
                        options.slideClosedClass = options.slideClass + "-closed"; /* Class of closed slides. */
                        options.slidePreviousClass = options.slideClass + "-previous"; /* Class of the slide that was previously open before a new one was triggered. */
                    }
                    /* Check for inconsistencies in size. */
                    if (!helpers.sizeAccordion(this, options)) {
                        return false;
                    } else {
                        return this.each(function () {
                            var o = options, obj = $(this), originals = [], /* inside = false, */ animate, tag, childtag, size, previous = -1; /* o: all of the options (defaults, user options, settings) */
                            animate = o.slideWidth - o.tabWidth; /* Number of pixels yet do be displayed on a hidden slide. */
                            tag = obj.get(0).tagName; /* Tag type of the container. */
                            childtag = obj.children().get(0).tagName; /* Tag type of the children. */
                            size = obj.children().size(); /* Number of children. */
                            obj.data($.extend({}, {
                                auto: o.auto,
                                interval: null,
                                timeout: o.timeout,
                                trigger: o.trigger,
                                current: o.startingSlide,
                                previous: previous,
                                next: helpers.getNext(size, o.startingSlide),
                                slideClass: o.slideClass, /* Keeping this around right now only for the sake of the destroy function. */
                                inside: false,
                                pause: o.pause
                            }));
                            if (o.heightUnits === "%") {
                                o.height = (obj.parent().get(0).tagName === "BODY") ? o.height * 0.01 * $(window).height() : o.height * 0.01 * obj.parent().height();
                                o.heightUnits = "px"; /* Need to revert to pixels because CSS 100% height does not cooperate. */
                            }
                            /* Loop through each of the slides and set the layers. */
                            obj.children().each(function (childindex) {
                                var zindex, xpos, y;
                                xpos = o.invert ? xpos = ((size - 1) * o.tabWidth) - (childindex * o.tabWidth) : childindex * o.tabWidth; /* Used for the position of each slide. */
                                originals[childindex] = xpos; /* px position of each open slide. */
                                zindex = o.invert ? ((size - 1) - childindex) * 10 : childindex * 10; /* Increase each slide's z-index by 10 so they sit on top of each other. */
                                if (o.slideClass !== null) {
                                    $(this).addClass(o.slideClass); /* Add the slide class to each of the slides. */
                                }
                                $(this).css({
                                    "top": 0,
                                    "z-index": zindex,
                                    "margin": 0,
                                    "padding": 0,
                                    "float": "left",
                                    "display": "block",
                                    "position": "absolute",
                                    "overflow": "hidden",
                                    "width": o.slideWidth + o.widthUnits,
                                    "height": o.height + o.heightUnits
                                });
                                if (o.invert) {
                                    $(this).css({ "right": xpos + o.widthUnits, "float": "right" });
                                } else {
                                    $(this).css({ "left": xpos + o.widthUnits, "float": "left" });
                                }
                                if (childindex === (o.startingSlide)) {
                                    $(this).css("cursor", "default");
                                    if (o.slideClass !== null) {
                                        $(this).addClass(o.slideOpenClass);
                                    }
                                } else {
                                    $(this).css("cursor", "pointer");
                                    if (o.slideClass !== null) {
                                        $(this).addClass(o.slideClosedClass);
                                    }
                                    if ((childindex > (o.startingSlide)) && (!o.invert)) {
                                        y = childindex + 1;
                                        obj.children(childtag + ":nth-child(" + y + ")").css({
                                            left: originals[y - 1] + animate + o.widthUnits
                                        });
                                    } else if ((childindex < (o.startingSlide)) && (o.invert)) {
                                        y = childindex + 1;
                                        obj.children(childtag + ":nth-child(" + y + ")").css({
                                            right: originals[y - 1] + animate + o.widthUnits
                                        });
                                    }
                                }
                            });
                            /* Modify the CSS of the main container. */
                            obj.css({
                                "display": "block",
                                "height": o.height + o.heightUnits,
                                "width": o.width + o.widthUnits,
                                "padding": 0,
                                "position": "relative",
                                "overflow": "hidden"
                            });
                            /* If the container is a list, get rid of any bullets. */
                            if ((tag === "UL") || (tag === "OL")) {
                                obj.css({
                                    "list-style": "none"
                                });
                            }
                            obj.hover(function () {
                                obj.data("inside", true);
                                /* If pause on hover, clear the timer. */
                                if (obj.data("pause")) {
                                    try {
                                        clearTimeout(obj.data("interval"));
                                    } catch (e) {}
                                }
                            }, function () {
                                obj.data("inside", false);
                                /* Restart the accordion when user moves mouse out of the slides. */
                                if (obj.data("auto") && obj.data("pause")) {
                                    helpers.timer(obj);
                                }
                            });
                            /* Set up the listener to change slides when triggered. */
                            obj.children().bind(o.trigger, function () {
                                /* Don't do anything if the slide is already open. */
                                if ($(this).index() !== obj.data("current")) {
                                    var i, j, p, c; /* p and c are 1-indexes */
                                    p = previous + 1; /* Using the 1-index for nth selector. */
                                    c = obj.data("current") + 1; /* Using the 1-index for nth selector. */
                                    if ((p !== 0) && (o.slideClass !== null)) {
                                        obj.children(childtag + ":nth-child(" + p + ")").removeClass(o.slidePreviousClass); /* Remove class for previous slide if previous slide exists. */
                                    }
                                    obj.children(childtag + ":nth-child(" + c + ")");
                                    if (o.slideClass !== null) {
                                        obj.children(childtag + ":nth-child(" + c + ")").addClass(o.slidePreviousClass);
                                    }
                                    previous = obj.data("current");
                                    obj.data("previous", obj.data("current"));
                                    p = previous;
                                    p += 1;
                                    obj.data("current", $(this).index());
                                    c = obj.data("current");
                                    c += 1;
                                    obj.children().css("cursor", "pointer");
                                    $(this).css("cursor", "default"); /* Add the open class to the slide tab that was just triggered */
                                    if (o.slideClass !== null) {
                                        obj.children().addClass(o.slideClosedClass).removeClass(o.slideOpenClass);
                                        $(this).addClass(o.slideOpenClass).removeClass(o.slideClosedClass); /* Add the open class to the slide tab that was just triggered */
                                    }
                                    obj.data("next", helpers.getNext(size, $(this).index()));
                                    /* If the slide is not open... */
                                    helpers.timer(obj);
                                    o.animationStart();
                                    if (o.invert) {
                                        obj.children(childtag + ":nth-child(" + c + ")").stop().animate({ right: originals[obj.data("current")] + o.widthUnits }, o.speed, o.easing, o.animationComplete);
                                    } else {
                                        obj.children(childtag + ":nth-child(" + c + ")").stop().animate({ left: originals[obj.data("current")] + o.widthUnits }, o.speed, o.easing, o.animationComplete);
                                    }
                                    /* Closing other slides. */
                                    for (i = 0; i < size; i += 1) {
                                        j = i + 1;
                                        if (i < obj.data("current")) {
                                            if (o.invert) {
                                                obj.children(childtag + ":nth-child(" + j + ")").stop().animate({
                                                    right: o.width - (j * o.tabWidth) + o.widthUnits
                                                }, o.speed, o.easing);
                                            } else {
                                                obj.children(childtag + ":nth-child(" + j + ")").stop().animate({
                                                    left: originals[i] + o.widthUnits
                                                }, o.speed, o.easing);
                                            }
                                        }
                                        if (i > obj.data("current")) {
                                            if (o.invert) {
                                                obj.children(childtag + ":nth-child(" + j + ")").stop().animate({
                                                    right: (size - j) * o.tabWidth + o.widthUnits
                                                }, o.speed, o.easing);
                                            } else {
                                                obj.children(childtag + ":nth-child(" + j + ")").stop().animate({
                                                    left: originals[i] + animate + o.widthUnits
                                                }, o.speed, o.easing);
                                            }
                                        }
                                    }
                                    return false; /* This is important. If a visible link is clicked within the slide, it will open the slide instead of redirecting the link. */
                                }
                            });
                            /* Set up the original timer. */
                            if (obj.data("auto")) {
                                helpers.timer(obj);
                            }
                            o.afterBuild();
                        });
                    }
                }
            },
            stop: function () { /* This will stop the accordion unless the slides are clicked, however, it will not resume the autoplay. */
                if ($(this).data("auto")) {
                    clearTimeout($(this).data("interval"));
                    $(this).data("auto", false);
                }
            },
            start: function () { /* This will start the accordion back up if it has been stopped. */
                if (!$(this).data("auto")) {
                    var n = $(this).data("next") + 1;
                    $(this).data("auto", true);
                    $(this).children($(this).children().get(0).tagName + ":nth-child(" + n + ")").trigger($(this).data("trigger"));
                }
            },
            trigger: function (x) {
                if ((x >= $(this).children().size()) || (x < 0)) { /* If the triggered slide is out of range, trigger the first slide. */
                    x = 0;
                }
                x += 1; /* Use nth-child to trigger slide. */
                $(this).children($(this).children().get(0).tagName + ":nth-child(" + x + ")").trigger($(this).data("trigger"));
            },
            destroy: function (o) {
                var removestyle, removeclasses, prefix = $(this).data("slideClass");
                if (o !== undefined) {
                    removestyle = (o.removeStyleAttr !== undefined) ? o.removeStyleAttr : true;
                    removeclasses = (o.removeClasses !== undefined) ? o.removeClasses : false;
                }
                clearTimeout($(this).data("interval"));
                $(this).children().stop().unbind($(this).data("trigger"));
                $(this).unbind("mouseenter mouseleave mouseover mouseout");
                if (removestyle) {
                    $(this).removeAttr("style");
                    $(this).children().removeAttr("style");
                }
                if (removeclasses) {
                    $(this).children().removeClass(prefix);
                    $(this).children().removeClass(prefix + "-open");
                    $(this).children().removeClass(prefix + "-closed");
                    $(this).children().removeClass(prefix + "-previous");
                }
                $(this).removeData();
            }
        };
        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === "object" || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error("zAccordion: " + method + " does not exist.");
        }
    };
}(jQuery));


//-xu huong thoi trang-
$(function() {
    $('.trendsBox').live({
        mouseenter: function() {
            $(this).find('.description_trends').fadeIn();
            $(".description", this).stop().animate({ height: "70px" }, { queue: false, duration: 160 }).addClass('up_trends');
        },
        mouseleave: function() {
            $(this).find('.description_trends').hide();
            $(".description", this).stop().animate({ height: "50px" }, { queue: false, duration: 160 }).removeClass('up_trends');
        }
    });
});
$(document).ready(function() {
    $(".mix_match_view").jCarouselLite({
        btnNext: ".mix_match_next",
        btnPrev: ".mix_match_pre",
        visible: 6,
        scroll: 1
        //auto: 4800,
        //speed: 1000
    });
});
//thoi trang mix va match
/*
$(document).ready(function() {
    $('ul li a.thumbnail').click(function() {
        var src = $(this).attr('href');
        $('.mix_match_Image').css('background', 'url("images/loading_gif.gif") no-repeat center center');
        if (src != $('img.largeImg').attr('src').replace(/\?(.*)/, '')) {
            $('img.largeImg').stop().animate({
                opacity: '0'
            }, function() {
                $(this).attr('src', src + '?' + Math.floor(Math.random() * (10 * 300)));
                $('.mix_match_Image').css('background', 'none');
            }).load(function() {
                $(this).stop().animate({
                    opacity: '1'
                });
            });
        }
        return false;
    });
}); 
*/
$(document).ready(function() {
    $("#featured").zAccordion({
        easing: "swing",
        timeout: 5500,
        trigger: "mouseover",
        speed: 1000,
        slideClass: "slidee",
        auto: false,
        slideWidth: 460,
        width: 788,
        height: 324
    });
});


//Phan Trang Tin Tuc Thoi Trang
function GetTTTT(pagenumber) {
    $.ajax({
        url: '/Files/Themes/Default/UserControls/Home/NewsTinTucThoiTrangAjax.aspx?page=' + pagenumber,
        success: function(data) {
            $('.newsTTTT').html("");
            $('.newsTTTT').html($(data).find('.newsTTTT').html());
        }
    });
}

function GetXHTT(pagenumber) {
    $.ajax({
        url: '/Files/Themes/Default/UserControls/Home/NewsXuHuongThoiTrangAjax.aspx?page=' + pagenumber,
        success: function(data) {
            $('.newsXHTT').html("");
            $('.newsXHTT').html($(data).find('.newsXHTT').html());
        }
    });
}
function GetVideo(pagenumber) {
    $.ajax({
        url: '/Files/Themes/Default/UserControls/Home/NewsVideoAjax.aspx?page=' + pagenumber,
        success: function(data) {
            $('.newsVideo').html("");
            $('.newsVideo').html($(data).find('.newsVideo').html());
            $(document).ready(function() {
                var title = $(".titleVideo").first().attr('title');
                $(".title_video").html(title);
                $(".titleVideo").click(function() {
                    var title = $(this).attr('title');
                    $(".title_video").html(title);
                });
            });
            $(function() {
                $("ul.video_relate").ytplaylist({
                    addThumbs: false,
                    autoPlay: false,
                    holderId: 'view_video',
                    playerHeight: '285',
                    allowFullScreen: true,
                    playerWidth: '470'
                });
            });
        }
    });
}
function GetVideoDetail(pagenumber) {
    $.ajax({
        url: '/Files/Themes/Default/UserControls/News/VideoDetailAjax.aspx?page=' + pagenumber,
        success: function(data) {
            $('.video-fashion').html("");
            $('.video-fashion').html($(data).find('.videofashion').html());
            $(document).ready(function() {
                var title = $(".titleVideo").first().attr('title');
                $(".title_video").html(title);
            });
            $(".titleVideo").click(function() {
                var title = $(this).attr('title');
                $(".title_video").html(title);
            });
            //trang thoi trang video
            $(document).ready(function() {
                $("ul.runVideo").ytplaylist({
                    addThumbs: true,
                    autoPlay: false,
                    holderId: 'videoFashion',
                    playerHeight: '450',
                    allowFullScreen: true,
                    playerWidth: '980'
                });
            });
            //trang video thoi trang
            $(document).ready(function() {
                $(".boxVideo").jCarouselLite({
                    btnNext: ".next-video",
                    btnPrev: ".pre-video",
                    //vertical: true,
                    circular: true,
                    //easing: "easeInOutBack",
                    visible: 4,
                    //scroll: 1,
                    //auto: 4800,
                    speed: 1000
                });
            });
        }
    });
}

$(document).ready(function() {
//    GetTTTT(1);
//    GetXHTT(1);
//    GetVideo(1);
});

$().ready(function() {
    //CustomizeDataPager($(pagerNewsTTT));
    //CustomizeDataPager2($(pagerNewsXHTT));
//    CustomizeDataPager3($(pagerNewsVideo));
});﻿

function CustomizeDataPager(id) {   
    if ($(id).children("li").length == 0) {

        $(id).find('a').each(function(index, value) {
            var newNode;
            if ($(this).text() == "<<") {
                if ($(this).attr('disabled') !== undefined) {
                    newNode = '<li class="pre_nav"> <a  disabled="' + $(this).attr('disabled') + '" href="javaScript:void(0);">' + $(this).text() + '</a></li>'

                } else {
                    newNode = '<li class="pre_nav"> <a href="' + value + '">' + $(this).text() + '</a></li>'
                }

                $(this).replaceWith(newNode);

            }
            else if ($(this).text() == ">>") {
                if ($(this).attr('disabled') !== undefined) {
                    newNode = '<li class="next_nav"> <a  disabled="' + $(this).attr('disabled') + '" href="javaScript:void(0);">' + $(this).text() + '</a></li>'

                } else {
                    newNode = '<li class="next_nav"> <a href="' + value + '">' + $(this).text() + '</a></li>'
                }
                $(this).replaceWith(newNode);
            }
            else {
                newNode = '<li> <a href="' + value + '">' + $(this).text() + '</a></li>'
                $(this).replaceWith(newNode);
            }
        });
        var el = $(id).find('span');
        var curNode = '<li class="active"> <a href="#">' + $(el).text() + '</a></li>';
        $(el).replaceWith(curNode);
    }
}
function CustomizeDataPager2(id) {
    if ($(id).children("li").length == 0) {
        $(id).find('a').each(function(index, value) {
            var newNode;
            if ($(this).text() == "<<") {
                if ($(this).attr('disabled') !== undefined) {
                    newNode = '<li class="pre_nav"> <a  disabled="' + $(this).attr('disabled') + '" href="javaScript:void(0);">' + $(this).text() + '</a></li>'

                } else {
                    newNode = '<li class="pre_nav"> <a href="' + value + '">' + $(this).text() + '</a></li>'
                }
                $(this).replaceWith(newNode);
            }
            else if ($(this).text() == ">>") {
                if ($(this).attr('disabled') !== undefined) {
                    newNode = '<li class="next_nav"> <a  disabled="' + $(this).attr('disabled') + '" href="javaScript:void(0);">' + $(this).text() + '</a></li>'

                } else {
                    newNode = '<li class="next_nav"> <a href="' + value + '">' + $(this).text() + '</a></li>'
                }
                $(this).replaceWith(newNode);
            }
            else {
                newNode = '<li> <a href="' + value + '">' + $(this).text() + '</a></li>'
                $(this).replaceWith(newNode);
            }
        });
        var el = $(id).find('span');
        var curNode = '<li class="active"> <a href="#">' + $(el).text() + '</a></li>';
        $(el).replaceWith(curNode);
    }
}
function CustomizeDataPager3(id) {
    if ($(id).children("li").length == 0) {
        $(id).find('a').each(function(index, value) {
            var newNode;
            if ($(this).text() == "<<") {
                if ($(this).attr('disabled') !== undefined) {
                    newNode = '<li class="pre_nav"> <a  disabled="' + $(this).attr('disabled') + '" href="javaScript:void(0);">' + $(this).text() + '</a></li>'

                } else {
                    newNode = '<li class="pre_nav"> <a href="' + value + '">' + $(this).text() + '</a></li>'
                }
                $(this).replaceWith(newNode);
            }
            else if ($(this).text() == ">>") {
                if ($(this).attr('disabled') !== undefined) {
                    newNode = '<li class="next_nav"> <a  disabled="' + $(this).attr('disabled') + '" href="javaScript:void(0);">' + $(this).text() + '</a></li>'

                } else {
                    newNode = '<li class="next_nav"> <a href="' + value + '">' + $(this).text() + '</a></li>'
                }
                $(this).replaceWith(newNode);
            }
            else {
                newNode = '<li> <a href="' + value + '">' + $(this).text() + '</a></li>'
                $(this).replaceWith(newNode);
            }
        });
        var el = $(id).find('span');
        var curNode = '<li class="active"> <a href="#">' + $(el).text() + '</a></li>';
        $(el).replaceWith(curNode);
    }
}

/**
* jCarouselLite - jQuery plugin to navigate images/any content in a carousel style widget.
* @requires jQuery v1.2 or above
*
* http://gmarwaha.com/jquery/jcarousellite/
*
* Copyright (c) 2007 Ganeshji Marwaha (gmarwaha.com)
* Dual licensed under the MIT and GPL licenses:
* http://www.opensource.org/licenses/mit-license.php
* http://www.gnu.org/licenses/gpl.html
*
* Version: 1.0.1
* Note: Requires jquery 1.2 or above from version 1.0.1
*/

/**
* Creates a carousel-style navigation widget for images/any-content from a simple HTML markup.
*
* The HTML markup that is used to build the carousel can be as simple as...
*
*  <div class="carousel">
*      <ul>
*          <li><img src="image/1.jpg" alt="1"></li>
*          <li><img src="image/2.jpg" alt="2"></li>
*          <li><img src="image/3.jpg" alt="3"></li>
*      </ul>
*  </div>
*
* As you can see, this snippet is nothing but a simple div containing an unordered list of images.
* You don't need any special "class" attribute, or a special "css" file for this plugin.
* I am using a class attribute just for the sake of explanation here.
*
* To navigate the elements of the carousel, you need some kind of navigation buttons.
* For example, you will need a "previous" button to go backward, and a "next" button to go forward.
* This need not be part of the carousel "div" itself. It can be any element in your page.
* Lets assume that the following elements in your document can be used as next, and prev buttons...
*
* <button class="prev">&lt;&lt;</button>
* <button class="next">&gt;&gt;</button>
*
* Now, all you need to do is call the carousel component on the div element that represents it, and pass in the
* navigation buttons as options.
*
* $(".carousel").jCarouselLite({
*      btnNext: ".next",
*      btnPrev: ".prev"
* });
*
* That's it, you would have now converted your raw div, into a magnificient carousel.
*
* There are quite a few other options that you can use to customize it though.
* Each will be explained with an example below.
*
* @param an options object - You can specify all the options shown below as an options object param.
*
* @option btnPrev, btnNext : string - no defaults
* @example
* $(".carousel").jCarouselLite({
*      btnNext: ".next",
*      btnPrev: ".prev"
* });
* @desc Creates a basic carousel. Clicking "btnPrev" navigates backwards and "btnNext" navigates forward.
*
* @option btnGo - array - no defaults
* @example
* $(".carousel").jCarouselLite({
*      btnNext: ".next",
*      btnPrev: ".prev",
*      btnGo: [".0", ".1", ".2"]
* });
* @desc If you don't want next and previous buttons for navigation, instead you prefer custom navigation based on
* the item number within the carousel, you can use this option. Just supply an array of selectors for each element
* in the carousel. The index of the array represents the index of the element. What i mean is, if the
* first element in the array is ".0", it means that when the element represented by ".0" is clicked, the carousel
* will slide to the first element and so on and so forth. This feature is very powerful. For example, i made a tabbed
* interface out of it by making my navigation elements styled like tabs in css. As the carousel is capable of holding
* any content, not just images, you can have a very simple tabbed navigation in minutes without using any other plugin.
* The best part is that, the tab will "slide" based on the provided effect. :-)
*
* @option mouseWheel : boolean - default is false
* @example
* $(".carousel").jCarouselLite({
*      mouseWheel: true
* });
* @desc The carousel can also be navigated using the mouse wheel interface of a scroll mouse instead of using buttons.
* To get this feature working, you have to do 2 things. First, you have to include the mouse-wheel plugin from brandon.
* Second, you will have to set the option "mouseWheel" to true. That's it, now you will be able to navigate your carousel
* using the mouse wheel. Using buttons and mouseWheel or not mutually exclusive. You can still have buttons for navigation
* as well. They complement each other. To use both together, just supply the options required for both as shown below.
* @example
* $(".carousel").jCarouselLite({
*      btnNext: ".next",
*      btnPrev: ".prev",
*      mouseWheel: true
* });
*
* @option auto : number - default is null, meaning autoscroll is disabled by default
* @example
* $(".carousel").jCarouselLite({
*      auto: 800,
*      speed: 500
* });
* @desc You can make your carousel auto-navigate itself by specfying a millisecond value in this option.
* The value you specify is the amount of time between 2 slides. The default is null, and that disables auto scrolling.
* Specify this value and magically your carousel will start auto scrolling.
*
* @option speed : number - 200 is default
* @example
* $(".carousel").jCarouselLite({
*      btnNext: ".next",
*      btnPrev: ".prev",
*      speed: 800
* });
* @desc Specifying a speed will slow-down or speed-up the sliding speed of your carousel. Try it out with
* different speeds like 800, 600, 1500 etc. Providing 0, will remove the slide effect.
*
* @option easing : string - no easing effects by default.
* @example
* $(".carousel").jCarouselLite({
*      btnNext: ".next",
*      btnPrev: ".prev",
*      easing: "bounceout"
* });
* @desc You can specify any easing effect. Note: You need easing plugin for that. Once specified,
* the carousel will slide based on the provided easing effect.
*
* @option vertical : boolean - default is false
* @example
* $(".carousel").jCarouselLite({
*      btnNext: ".next",
*      btnPrev: ".prev",
*      vertical: true
* });
* @desc Determines the direction of the carousel. true, means the carousel will display vertically. The next and
* prev buttons will slide the items vertically as well. The default is false, which means that the carousel will
* display horizontally. The next and prev items will slide the items from left-right in this case.
*
* @option circular : boolean - default is true
* @example
* $(".carousel").jCarouselLite({
*      btnNext: ".next",
*      btnPrev: ".prev",
*      circular: false
* });
* @desc Setting it to true enables circular navigation. This means, if you click "next" after you reach the last
* element, you will automatically slide to the first element and vice versa. If you set circular to false, then
* if you click on the "next" button after you reach the last element, you will stay in the last element itself
* and similarly for "previous" button and first element.
*
* @option visible : number - default is 3
* @example
* $(".carousel").jCarouselLite({
*      btnNext: ".next",
*      btnPrev: ".prev",
*      visible: 4
* });
* @desc This specifies the number of items visible at all times within the carousel. The default is 3.
* You are even free to experiment with real numbers. Eg: "3.5" will have 3 items fully visible and the
* last item half visible. This gives you the effect of showing the user that there are more images to the right.
*
* @option start : number - default is 0
* @example
* $(".carousel").jCarouselLite({
*      btnNext: ".next",
*      btnPrev: ".prev",
*      start: 2
* });
* @desc You can specify from which item the carousel should start. Remember, the first item in the carousel
* has a start of 0, and so on.
*
* @option scrool : number - default is 1
* @example
* $(".carousel").jCarouselLite({
*      btnNext: ".next",
*      btnPrev: ".prev",
*      scroll: 2
* });
* @desc The number of items that should scroll/slide when you click the next/prev navigation buttons. By
* default, only one item is scrolled, but you may set it to any number. Eg: setting it to "2" will scroll
* 2 items when you click the next or previous buttons.
*
* @option beforeStart, afterEnd : function - callbacks
* @example
* $(".carousel").jCarouselLite({
*      btnNext: ".next",
*      btnPrev: ".prev",
*      beforeStart: function(a) {
*          alert("Before animation starts:" + a);
*      },
*      afterEnd: function(a) {
*          alert("After animation ends:" + a);
*      }
* });
* @desc If you wanted to do some logic in your page before the slide starts and after the slide ends, you can
* register these 2 callbacks. The functions will be passed an argument that represents an array of elements that
* are visible at the time of callback.
*
*
* @cat Plugins/Image Gallery
* @author Ganeshji Marwaha/ganeshread@gmail.com
*/

(function($) {                                          // Compliant with jquery.noConflict()
    $.fn.jCarouselLite = function(o) {
        o = $.extend({
            btnPrev: null,
            btnNext: null,
            btnGo: null,
            mouseWheel: false,
            auto: null,

            speed: 200,
            easing: null,

            vertical: false,
            circular: true,
            visible: 3,
            start: 0,
            scroll: 1,

            beforeStart: null,
            afterEnd: null
        }, o || {});

        return this.each(function() {                           // Returns the element collection. Chainable.

            var running = false, animCss = o.vertical ? "top" : "left", sizeCss = o.vertical ? "height" : "width";
            var div = $(this), ul = $("ul", div), tLi = $("li", ul), tl = tLi.size(), v = o.visible;

            if (o.circular) {
                ul.prepend(tLi.slice(tl - v - 1 + 1).clone())
              .append(tLi.slice(0, v).clone());
                o.start += v;
            }

            var li = $("li", ul), itemLength = li.size(), curr = o.start;
            div.css("visibility", "visible");

            li.css({ overflow: "hidden", float: o.vertical ? "none" : "left" });
            ul.css({ margin: "0", padding: "0", position: "relative", "list-style-type": "none", "z-index": "1" });
            div.css({ overflow: "hidden", position: "relative", "z-index": "2", left: "0px" });
            // try cache to fix .offsetWidth null or not object
            try {
                var liSize = o.vertical ? height(li) : width(li);   // Full li size(incl margin)-Used for animation
                var ulSize = liSize * itemLength;                   // size of full ul(total length, not just for the visible items)
                var divSize = liSize * v;                           // size of entire div(total length for just the visible items)

                li.css({ width: li.width(), height: li.height() });
                ul.css(sizeCss, ulSize + "px").css(animCss, -(curr * liSize));

                div.css(sizeCss, divSize + "px");                     // Width of the DIV. length of visible images
            } catch (e) { }
            if (o.btnPrev)
                $(o.btnPrev).click(function() {
                    return go(curr - o.scroll);
                });

            if (o.btnNext)
                $(o.btnNext).click(function() {
                    return go(curr + o.scroll);
                });

            if (o.btnGo)
                $.each(o.btnGo, function(i, val) {
                    $(val).click(function() {
                        return go(o.circular ? o.visible + i : i);
                    });
                });

            if (o.mouseWheel && div.mousewheel)
                div.mousewheel(function(e, d) {
                    return d > 0 ? go(curr - o.scroll) : go(curr + o.scroll);
                });

            if (o.auto)
                setInterval(function() {
                    go(curr + o.scroll);
                }, o.auto + o.speed);

            function vis() {
                return li.slice(curr).slice(0, v);
            };

            function go(to) {
                if (!running) {

                    if (o.beforeStart)
                        o.beforeStart.call(this, vis());

                    if (o.circular) {            // If circular we are in first or last, then goto the other end
                        if (to <= o.start - v - 1) {           // If first, then goto last
                            ul.css(animCss, -((itemLength - (v * 2)) * liSize) + "px");
                            // If "scroll" > 1, then the "to" might not be equal to the condition; it can be lesser depending on the number of elements.
                            curr = to == o.start - v - 1 ? itemLength - (v * 2) - 1 : itemLength - (v * 2) - o.scroll;
                        } else if (to >= itemLength - v + 1) { // If last, then goto first
                            ul.css(animCss, -((v) * liSize) + "px");
                            // If "scroll" > 1, then the "to" might not be equal to the condition; it can be greater depending on the number of elements.
                            curr = to == itemLength - v + 1 ? v + 1 : v + o.scroll;
                        } else curr = to;
                    } else {                    // If non-circular and to points to first or last, we just return.
                        if (to < 0 || to > itemLength - v) return;
                        else curr = to;
                    }                           // If neither overrides it, the curr will still be "to" and we can proceed.

                    running = true;

                    ul.animate(
                    animCss == "left" ? { left: -(curr * liSize)} : { top: -(curr * liSize) }, o.speed, o.easing,
                    function() {
                        if (o.afterEnd)
                            o.afterEnd.call(this, vis());
                        running = false;
                    }
                );
                    // Disable buttons when the carousel reaches the last/first, and enable when not
                    if (!o.circular) {
                        $(o.btnPrev + "," + o.btnNext).removeClass("disabled");
                        $((curr - o.scroll < 0 && o.btnPrev)
                        ||
                       (curr + o.scroll > itemLength - v && o.btnNext)
                        ||
                       []
                     ).addClass("disabled");
                    }

                }
                return false;
            };
        });
    };

    function css(el, prop) {
        return parseInt($.css(el[0], prop)) || 0;
    };
    function width(el) {
        return el[0].offsetWidth + css(el, 'marginLeft') + css(el, 'marginRight');
    };
    function height(el) {
        return el[0].offsetHeight + css(el, 'marginTop') + css(el, 'marginBottom');
    };

})(jQuery);