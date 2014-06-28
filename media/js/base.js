 function formatText(index, panel) {
            return index + "";
        }

        jQuery(document).ready(function() {
            jQuery('.anythingSlider').anythingSlider({
                easing: "easeInOutExpo",        // Anything other than "linear" or "swing" requires the easing plugin
                autoPlay: true,                 // This turns off the entire FUNCTIONALY, not just if it starts running or not.
                delay: 300,                    // How long between slide transitions in AutoPlay mode
                startStopped: true,            // If autoPlay is on, this can force it to start stopped
                animationTime: 600,             // How long the slide transition takes
                hashTags: false,                 // Should links change the hashtag in the URL?
                buildNavigation: false,          // If true, builds and list of anchor links to link to each slide
                pauseOnHover: false,             // If true, and autoPlay is enabled, the show will pause on hover
                startText: "",             // Start text
                stopText: "",               // Stop text
                navigationFormatter: formatText       // Details at the top of the file on this use (advanced use)
            });

            jQuery("#slide-jump").click(function(){
                jQuery('.anythingSlider').anythingSlider(6);
            });

        });