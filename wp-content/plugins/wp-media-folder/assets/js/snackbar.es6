/**
 * Snackbar main module
 */
let wpmfSnackbarModule;
(function($) {
    wpmfSnackbarModule =  {
        snackbar_ids : [],
        $snackbar_wrapper : null, // Snackbar jQuery wrapper
        snackbar_defaults : {
            onClose : function(){}, // Callback function when snackbar is closed
            is_undoable : false, // Show or not the undo button
            onUndo : function(){}, // Callback function when snackbar is undoed
            icon: '<span class="material-icons-outlined wpmf-snack-icon"> campaign </span>',
            is_closable : true, // Can this snackbar be closed by user
            auto_close : true, // Do the snackbar close automatically
            auto_close_delay : 6000, // Time to wait before closing automatically
            is_progress : false, // Do we show the progress bar
            percentage : null // Percentage of the progress bar
        },

        /**
         * Initialize snackbar module
         */
        initModule : function() {
            wpmfSnackbarModule.$snackbar_wrapper = $(`<div class="wpmf-snackbar-wrapper"></div>`).appendTo('body');
        },


        /**
         * Display a new snackbar
         * @param options
         * @return HTMLElement the snackbar generated
         */
        show : function(options) {
            if (options === undefined) {
                options = {};
            }

            // Set default values
            options = $.extend(
                {},wpmfSnackbarModule.snackbar_defaults,
                options
            );

            // If an id is set save it
            if (typeof options.id === "undefined") {
                options.id = options.content;
            }
            if (options.id !== undefined) {
                wpmfSnackbarModule.snackbar_ids[options.id] = options;
            }

            return wpmfSnackbarModule.renderSnack(options);
        },

        renderSnack: function(notification_options) {
            let notification_class = 'wpmf-snackbar-wrap';
            if (typeof notification_options !== "undefined" && typeof notification_options.error !== "undefined" && notification_options.error) {
                notification_class += ' wpmf-snackbar-error'
            }
            let snack = `<div class="${notification_class}">`;
            let snack_count = 0;
            Object.keys(wpmfSnackbarModule.snackbar_ids).map(function(snack_id, index) {
                snack_count ++;
                let options = wpmfSnackbarModule.snackbar_ids[snack_id];
                // Generate undo html if needed
                let undo = '';
                if(options.is_undoable) {
                    undo = '<a href="#" class="wpmf-snackbar-undo">'+wpmf.l18n.wpmf_undo+'</a>';
                }

                let id = '';
                if(options.id) {
                    id = 'data-id="'+options.id+'"';
                }

                snack += `<div ${id} class="wpmf-snackbar">
                        ${options.icon}
                        <div class="wpmf-snackbar-content">${options.content}</div>
                        ${undo}                        
                    </div>`;
            });

            snack += '<a class="wpmf-snackbar-close" href="#"><i class="material-icons">close</i></a>';
            snack += '</div>';

            // Add element to the DOM
            $('.wpmf-snackbar-wrap').remove();
            if (snack_count > 0) {
                let $snack = $(snack).prependTo(wpmfSnackbarModule.$snackbar_wrapper);

                // Initialize undo function
                $snack.find('.wpmf-snackbar-undo').click(function(e){
                    let snack_id = $(this).closest('.wpmf-snackbar').data('id');
                    e.preventDefault();
                    wpmfSnackbarModule.snackbar_ids[snack_id].onUndo();
                    // Reset the close function as we've done an undo
                    wpmfSnackbarModule.snackbar_ids[snack_id].onClose = function(){};
                    // Finally close the snackbar
                    wpmfSnackbarModule.snackbar_ids[snack_id].close(snack_id);
                });

                Object.keys(wpmfSnackbarModule.snackbar_ids).map(function(snack_id, index) {
                    // Initialize autoclose feature
                    let options = wpmfSnackbarModule.snackbar_ids[snack_id];
                    if(options.auto_close) {
                        setTimeout(function(){
                            wpmfSnackbarModule.close(options.id)
                        }, options.auto_close_delay);
                    }
                });

                // Initialize close button
                $snack.find('.wpmf-snackbar-close').click(function(e){
                    $(this).closest('.wpmf-snackbar-wrap').remove();
                    wpmfSnackbarModule.snackbar_ids = [];
                });
            }
        },

        /**
         * Remove a snackbar and call onClose callback if needed
         * @param snack_id snackbar element
         */
        close : function(snack_id){
            // Remove the id if exists
            if (snack_id !== undefined) {
                delete wpmfSnackbarModule.snackbar_ids[snack_id];
            }

            wpmfSnackbarModule.renderSnack();
        },

        /**
         * Retrieve an existing snackbar from its id
         * @param id
         * @return {null|object}
         */
        getFromId : function(id) {
            if (wpmfSnackbarModule.snackbar_ids[id] === undefined) {
                return null;
            }

            return id;
        },

        /**
         * Set the snackbar progress bar width
         * @param $snack jQuery element representing a snackbar
         * @param percentage int
         */
        setProgress : function($snack, percentage) {
            if ($snack===null) {
                return;
            }

            let $progress = $snack.find('.wpmfliner_progress > div');
            if(percentage !== undefined) {
                $progress.addClass('determinate').removeClass('indeterminate');
                $progress.css('width', percentage+'%');
            } else {
                $progress.addClass('indeterminate').removeClass('determinate');
            }
        }
    };

    // Let's initialize WPMF features
    $(document).ready(function () {
        wpmfSnackbarModule.initModule();
    });
})(jQuery);